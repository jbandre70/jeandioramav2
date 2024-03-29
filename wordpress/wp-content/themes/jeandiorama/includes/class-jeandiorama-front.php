<?php

declare(strict_types=1);

namespace Jeandiorama;

class JeandioramaSetup
{
    public function __construct()
    {
        add_action('after_setup_theme', $this->setupThemeDefaults(...));

        add_action('admin_init', $this->removeAdminMenuItems(...));
        add_action('admin_init', $this->removeDiscussionFeatures(...));
        add_action('admin_bar_menu', $this->removeAdminToolbarMenuItems(...));
        add_action('wp_dashboard_setup', $this->removeDashboardWidgets(...));

        add_action('init', $this->addCorsHttpHeader(...));

        add_action('acf/init', $this->addSiteOptions(...));

        add_filter('use_block_editor_for_post', '__return_false');
        add_filter('use_block_editor_for_post_type', '__return_false');
        add_filter('use_widgets_block_editor', '__return_false');
        add_action('wp_enqueue_scripts', $this->dequeueGutenbergStyles(...));

        add_action('wp_enqueue_scripts', $this->registerScriptsAndStyles(...));

        add_filter('wpseo_json_ld_output', '__return_false');

        add_filter('upload_mimes', $this->allowNewFormats(...));
/*        add_filter('wp_get_attachment_url', $this->forceHttpsUrlImages(...), 10, 2);*/

        add_action('admin_bar_menu', $this->addAdminBarActions(...), 99);

        add_action('admin_init', $this->flushMemcached(...));
    }

    public function setupThemeDefaults(): void
    {
        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');

        register_nav_menus([
            'jeandiorama' => __('Menu Header', 'jeandiorama'),
            'footer_menu' => __('Menu Footer', 'jeandiorama'),
        ]);

        add_image_size('jeandiorama_main_image', 1440, 720, true);
    }

    public function registerScriptsAndStyles(): void
    {
        $manifestPath = get_theme_file_path('assets/.vite/manifest.json');

        $manifest = json_decode(file_get_contents($manifestPath), true);
        wp_enqueue_script(
            'jeandiorama',
            get_theme_file_uri('assets/' . $manifest['resources/scripts/app.js']['file']),
            '',
            '',
            true
        );
        wp_enqueue_style(
            'jeandiorama',
            get_theme_file_uri('assets/' . $manifest['resources/scripts/app.js']['css'][0])
        );

        //Dequeue jQuery in front
        wp_dequeue_script('jquery');
    }

    public function removeAdminMenuItems(): void
    {
        remove_menu_page('edit-comments.php');
        remove_menu_page('edit.php');
        remove_menu_page('index.php');
    }

    public function removeAdminToolbarMenuItems(\WP_Admin_Bar $menu): void
    {
        $menu->remove_node('comments');
        $menu->remove_node('customize');
        $menu->remove_node('dashboard');
        $menu->remove_node('edit');
        $menu->remove_node('menus');
        $menu->remove_node('new-content');
        $menu->remove_node('search');
        $menu->remove_node('themes');
        $menu->remove_node('updates');
        $menu->remove_node('view-site');
        $menu->remove_node('view');
        $menu->remove_node('widgets');
        $menu->remove_node('wp-logo');
    }

    public function removeDashboardWidgets(): void
    {
        remove_meta_box('dashboard_activity', 'dashboard', 'normal');
        remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
        remove_meta_box('dashboard_primary', 'dashboard', 'side');
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    }

    public function removeDiscussionFeatures(): void
    {
        $postTypesToRemoveMetaBoxes = apply_filters('huttopia/active_post_types', []);
        foreach ($postTypesToRemoveMetaBoxes as $postType) {
            remove_meta_box('commentstatusdiv', $postType, 'normal');
            remove_meta_box('commentsdiv', $postType, 'normal');
        }
    }

    public function allowNewFormats(array $mimes): array
    {
        $mimes['svg'] = 'image/svg+xml';

        return $mimes;
    }

    public function dequeueGutenbergStyles(): void
    {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('global-styles');
        wp_dequeue_style('classic-theme-styles');
    }
    public function addAdminBarActions(\WP_Admin_Bar $wpAdminBar): void
    {
        if (current_user_can('administrator') === false) {
            return;
        }

        $wpAdminBar->add_menu(
            array(
                'id'     => 'huttopia',
                'parent' => function_exists('rocket_clean_domain') ? 'wp-rocket' : null,
                'href'   => add_query_arg('memcached', 'flush'),
                'title'  => __('Memcached flush &#x1F332;', 'huttopia'),
            )
        );
    }
    public function addSiteOptions(): void
    {
        $optionPageArgs = [
            'page_title' => __('Options générales', 'jeandiorama'),
            'menu_title' => __('Options', 'jeandiorama'),
            'menu_slug' => 'jeandiorama-options',
            'capability' => 'edit_posts',
            'icon_url' => 'dashicons-layout',
            'redirect' => false
        ];

        acf_add_options_page($optionPageArgs);

        $mainOptionsSlug = acf_maybe_get($optionPageArgs, 'menu_slug');
        $subPagesArgs = [
            [
                'page_title' => __('SEO', 'huttopia'),
                'menu_title' => __('SEO', 'huttopia'),
                'parent_slug' => $mainOptionsSlug,
            ],
            [
                'page_title' => __('Réseaux sociaux', 'huttopia'),
                'menu_title' => __('Réseaux sociaux', 'huttopia'),
                'parent_slug' => $mainOptionsSlug,
            ],
            [
                'page_title' => __('Contact', 'huttopia'),
                'menu_title' => __('Contact', 'huttopia'),
                'parent_slug' => $mainOptionsSlug,
            ]
        ];

        foreach ($subPagesArgs as $subPageArgs) {
            acf_add_options_page($subPageArgs);
        }
    }

    public function addCorsHttpHeader():void
    {
        header("Access-Control-Allow-Origin: *");
    }

    public function registerRestRoutes(): void
    {
        register_rest_route(
            'dioramas/v1',
            '/pid/dioramapage', [
            'methods' => 'GET',
            'callback' =>  $this->getQueryDioramas(...),
        ]);

        register_rest_route(
            'dioramas/v1',
            '/pid/dioramahome/(?P<page>\d+)', [
            'methods' => 'GET',
            'callback' => $this->getQueryDioramasHome(...),
            'args' => [
                'page' => [
                    'required' => true
                ]
            ]
        ]);

        register_rest_route( 'photos/v1', '/pid/(?P<page>\d+)', [
            'methods' => 'GET',
            'callback' => $this->getQueryPhotos(...),
            'args' => [
                'page' => [
                    'required' => true
                ]
            ]
        ]);

        register_rest_route( 'dioramas/v1', '/pid/blogpost', [
            'methods' => 'GET',
            'callback' => $this->getQueryPhotos(...),
        ]);

        register_rest_field(
            ['post', 'page'],
            'fimg_url',
            [
                'get_callback' => $this->get_rest_featured_image(...),
                'update_callback' => null,
                'schema' => null
            ]
        );
    }

    public function get_rest_featured_image($object, $field_name, $request): string | bool
    {
        if ($object['featured_media']) {
            $img = wp_get_attachment_image_src($object['featured_media'], 'medium_large');
            return $img[0];
        }

        return false;
    }

    public function getBlogPostQuery(WP_REST_Request $request = null): array
    {
        $args = [
            'posts_per_page' => 1,
            'cat' => 15,
            'date_query' => [
                [
                    'column' => 'post_date',
                    'after' => '- 2 days'
                ]
            ]
        ];
        $query = new WP_Query($args);
        if (empty($query->posts)) {
            return new WP_Error('no_posts', __('No post found'), ['status' => 404]);
        }

        $posts = $query->posts;
        $controller = new WP_REST_Posts_Controller('post');

        foreach ($posts as $post) {
            $response = $controller->prepare_item_for_response($post, $request);
            $data[] = $controller->prepare_response_for_collection($response);
        }
        $response = new WP_REST_Response($data, 200);

        return $response;
    }
    public function getQueryPhotos(\WP_REST_Request $request = null): array
    {
        $page = $request['page'];
        $args = [
            'posts_per_page' => 12,
            'paged' => $page,
            'orderby' => 'rand',
            'order' => 'desc',
            'post_type' => 'photostv',
        ];
        $query = new WP_Query($args);

        if (empty($query->posts)) {
            return new WP_Error('no_posts', __('No post found'), ['status' => 404]);
        }

        $max_pages = $query->max_num_pages;
        $total = $query->found_posts;
        $posts = $query->posts;
        $controller = new WP_REST_Posts_Controller('post');

        foreach ($posts as $post) {
            $response = $controller->prepare_item_for_response($post, $request);
            $data[] = $controller->prepare_response_for_collection($response);
        }

        $response = new WP_REST_Response($data, 200);
        $response->header('X-WP-Total', $total);
        $response->header('X-WP-TotalPages', $max_pages);
        return $response;
    }
    public function getQueryDioramas(\WP_REST_Request $request = null): array
    {
        $args = [
            'posts_per_page' => 100,
            'meta_key' => 'completed_on',
            'orderby' => 'meta_value',
            'order' => 'desc',
            'cat' => '14'
        ];
        $query = new WP_Query($args);
        echo $GLOBALS['wp_query']->request;

        if (empty($query->posts)) {
            return new WP_Error('no_posts', __('No post found'), ['status' => 404]);
        }

        $max_pages = $query->max_num_pages;
        $total = $query->found_posts;
        $posts = $query->posts;
        $controller = new WP_REST_Posts_Controller('post');

        foreach ($posts as $post) {
            $response = $controller->prepare_item_for_response($post, $request);
            $data[] = $controller->prepare_response_for_collection($response);
        }

        $response = new WP_REST_Response($data, 200);
        $response->header('X-WP-Total', $total);
        $response->header('X-WP-TotalPages', $max_pages);

        return $response;
    }

    public function getQueryDioramasHome(\WP_REST_Request $request = null): array
    {
        $page = $request['page'];
        $args = [
            'posts_per_page' => 6,
            'paged' => $page,
            'meta_key' => 'completed_on',
            'orderby' => 'meta_value',
            'order' => 'desc',
            'cat' => 14,
            'post_type' => 'post'
        ];
        $query = new WP_Query($args);

        if (empty($query->posts)) {
            return new WP_Error('no_posts', __('No post found'), ['status' => 404]);
        }

        $max_pages = $query->max_num_pages;
        $total = $query->found_posts;
        $posts = $query->posts;
        $controller = new WP_REST_Posts_Controller('post');

        foreach ($posts as $post) {
            $response = $controller->prepare_item_for_response($post, $request);
            $data[] = $controller->prepare_response_for_collection($response);
        }
        $response = new WP_REST_Response($data, 200);
        $response->header('X-WP-Total', $total);
        $response->header('X-WP-TotalPages', $max_pages);

        return $response;
    }

/*    public function forceHttpsUrlImages(string $url, int $postId): string
    {
        //Skip file attachments
        if (wp_attachment_is_image($postId) === false) {
            return $url;
        }

        return str_replace('http://', 'https://', $url);
    }*/



    public function flushMemcached(): void
    {
        if (current_user_can('administrator') === false) {
            return;
        }

        $maybeFlush = acf_maybe_get_GET('memcached');
        if ($maybeFlush !== 'flush') {
            return;
        }

        if (class_exists('Memcached', false) === false) {
            return;
        }

        global $wp_object_cache;
        $wp_object_cache->flush();
    }
}
