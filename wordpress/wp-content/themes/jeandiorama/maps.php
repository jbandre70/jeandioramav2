
<?php
/**
 * Template name: maps
 */

get_header();
$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');

?>
<main id="main">
    <section class="container" id="top">
        <div class="column is-full header-page">
            <h1 class="header-page">Complete Dioramas list from Jean Diorama</h1>
        </div>
        <div class="columns is-multiline">
            <div class="map" id="map" style="" data-maps='<?php
            $a = [];
            $args = [
                'category_name' => 'dioramas',
                'posts_per_page' => -1,
            ];

            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
                    $fieldsmap = get_field('gmapes');
                    if ($fieldsmap && get_field('lattitude') !== '') {
                        $a[] = [
                            'title' => get_the_title(),
                            'link' => get_the_permalink(),
                            'lat' => $fieldsmap === false ? get_field('lattitude') : $fieldsmap['lat'],
                            'lng' => $fieldsmap === false ? get_field('longitude') : $fieldsmap['lng'],
                            'img' => $image,
                        ];
                    }
                }
                echo json_encode($a) . '\'>';
            }
            wp_reset_postdata();
            ?>
            </div>


            <script>

            </script>
    </section>
    <?php
    get_footer();
    ?>
</main>
<?php
//get_footer();
?>
