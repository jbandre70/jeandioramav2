<?php

declare(strict_types=1);

namespace Jeandiorama;

class JeandioramaContentTypes
{
    public function __construct()
    {
        add_action('init', $this->registerCustomPostTypes(...));

        add_filter('huttopia/active_post_types', $this->listHuttopiaActivePostTypes(...));
        add_filter('huttopia/custom_post_type_with_front', $this->listHuttopiaCustomPostTypesWithFront(...));
    }

    public function registerCustomPostTypes(): void
    {
        $constructorInfo = [
            'post_type_slug' => 'photos_masonry',
            'taxonomies' => [],
            'label_plural' => __('Photo Masonry', 'huttopia'),
            'label_singular' => __('Photos Masonry', 'huttopia'),
            'icon' => 'dashicons-admin-home',
        ];

        $postTypeArgs = $this->generatePostTypeArgs(
            $constructorInfo,
            [
                'supports' => [
                    'title',
                    'thumbnail',
                    'custom-fields',
                    'revision',
                ],
            ]
        );

        register_post_type(
            acf_maybe_get($constructorInfo, 'post_type_slug'),
            $postTypeArgs
        );
    }

    public function generateLabelsforContentType(string $singular, string $plural): array
    {
        $lowerCaseSingular = strtolower($singular);
        $lowerCasePlural = strtolower($plural);
        $labels = [
            'name' => $plural,
            'singular_name' => $singular,
            'add_new' => sprintf(__('Ajouter un(e) %s', 'jeandiorama'), $lowerCaseSingular),
            'add_new_item' => sprintf(__('Ajouter un(e) nouveau(elle) %s', 'jeandiorama'), $lowerCaseSingular),
            'edit_item' => sprintf(__('Modifier %s', 'jeandiorama'), $lowerCaseSingular),
            'new_item' => sprintf(__('Nouveau(elle) %s', 'jeandiorama'), $lowerCaseSingular),
            'view_item' => sprintf(__('Visualiser %s', 'jeandiorama'), $lowerCaseSingular),
            'search_items' => sprintf(__('Rechercher dans %s', 'jeandiorama'), $lowerCasePlural),
            'not_found' => sprintf(__('Aucun(e) %s trouvé(e)', 'jeandiorama'), $lowerCaseSingular),
            'not_found_in_trash' => sprintf(__('Aucun(e) %s trouvé(e) dans la corbeille', 'jeandiorama'), $lowerCaseSingular),
            'parent_item_colon' => sprintf(__('Texte parent %s', 'jeandiorama'), $singular),
            'all_items' => sprintf(__('Tous les %s', 'jeandiorama'), $lowerCasePlural),
        ];

        return $labels;
    }

    public function generatePostTypeArgs(array $constructorInfo, array $postTypeArgs = []): array
    {
        $postTypeSlug = acf_maybe_get($constructorInfo, 'post_type_slug');
        $postTypeTaxonomies = acf_maybe_get($constructorInfo, 'taxonomies');
        $labelPlural = acf_maybe_get($constructorInfo, 'label_plural');
        $labelSingular = acf_maybe_get($constructorInfo, 'label_singular');
        $postTypeIcon = acf_maybe_get($constructorInfo, 'icon');

        $defaultArgs = [
            'name' => $postTypeSlug,
            'label' => $labelPlural,
            'description' => '',
            'hierarchical' => false,
            'supports' => [
                'title',
                'custom-fields',
                'revision',
            ],
            'taxonomies' => $postTypeTaxonomies,
            'public' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'can_export' => true,
            'delete_with_user' => null,
            'labels' => $this->generateLabelsforContentType($labelSingular, $labelPlural),
            'menu_position' => null,
            'menu_icon' => $postTypeIcon,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'has_archive' => '',
            'rewrite' => true,
            'capability_type' => 'post',
            'capabilities' => [],
            'map_meta_cap' => null,
            'show_in_rest' => false,
            'rest_base' => '',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
        ];

        $postTypeArgs = wp_parse_args($postTypeArgs, $defaultArgs);

        return $postTypeArgs;
    }

    public function listHuttopiaActivePostTypes(): array
    {
        $activePostTypes = [
            'page',
            'article',
        ];

        return $activePostTypes;
    }

    public function listHuttopiaCustomPostTypesWithFront(): array
    {
        $customPostTypesWithFront = ['hebergement', 'site'];

        return $customPostTypesWithFront;
    }
}
