<?php

get_header();
$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
?>
<main id="main">
    <section class="vignette" id="top">
        <div class="column is-two-third header-page">
            <h1 class="header-page">Complete Dioramas list from Jean Diorama</h1>
        </div>
        <div class="columns is-multiline liste is-centered">
            <?php
            $args = [
                'category_name' => 'dioramas',
                'posts_per_page' => -1,
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
                            <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a></Link>
                            <div>
                                <?php the_excerpt(); ?>
                                <ob-link href="<?php echo base64_encode(get_the_permalink()); ?>"> [+]</ob-link>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo 'Aucun article trouvé.';
            }
            wp_reset_postdata();
            ?>

    </section>

    <div class="more"><a href="#top">Top of the page</a></div>
    </div>
</main>
<?php
get_footer();
?>
