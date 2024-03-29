<?php
/**
 * Template name: Homepage
 */

get_header();
$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
?>
<main id="main">
    <div
        class="is-hidden-desktop accrochemobile"
        style="background-image: url(<?php echo $image[0]; ?>);"
    >
        <h1>Jean Diorama</h1>
    </div>
    <div>
        <div class="is-hidden-touch ">
            <div class="header-home home" style="background-image: url(<?php echo $image[0]; ?>);">
                <div>
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="container newsbox">
            <div class="newsboxInline" id="suite-0">
            <?php
                $args = [
                    'category_name' => 'news',
                    'posts_per_page' => 1,
                ];

                $query = new WP_Query($args);
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
                        echo '<h2>' . get_the_title() . '</h2>';
                        the_content();
                    }
                }
                wp_reset_postdata();
            ?>
            </div>
        </div>
    </div>

    <section class="dioramas-home">
        <section class="vignette" id="top">
            <div class="column is-one-third header-page">
                <h1 class="header-page">Recent dioramas</h1>
            </div>
            <div class="columns is-multiline liste is-centered">
                <?php
                    $args = [
                        'category_name' => 'dioramas',
                        'posts_per_page' => 10,
                        'meta_key' => 'completed_on',
                        'orderby' => 'meta_value'
                    ];

                    $query = new WP_Query($args);
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            ?>
                            <div class="column is-3">
                                <div class="item_d">
                                    <ob-link href="<?php echo base64_encode(get_the_permalink()); ?>">
                                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
                                        <img
                                            src="<?php echo $image[0]; ?>"
                                            alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>"
                                            loading="lazy"
                                        >
                                    </ob-link>
                                </div>
                                <div class="item_d">
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2></Link>
                                    <div>
                                        <?php the_excerpt(); ?>
                                        <ob-link href="<?php echo base64_encode(get_the_permalink()); ?>"> [+]</ob-link>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    wp_reset_postdata();
                ?>

        </section>
    </section>
    <div class="more"><a href="#top">Top of the page</a></div>
    </div>
</main>
<?php
    get_footer();
?>
