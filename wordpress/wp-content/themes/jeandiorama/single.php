<?php
get_header();
?>
<main id="main">
    <main id="main">
        <div>
            <div>
                <section class="illustration">
                    <diorama-slide class="slider-lame" allowfullscreen="">
                        <div class="slides">
                            <?php
                                $images = get_field('galerie');
                                if ($images) {
                                    foreach ($images as $image) {
                            ?>
                                        <img alt="<?php echo $image['alt']; ?>"
                                             src="<?php echo $image['sizes']['jeandiorama_main_image']; ?>"
                                             loading="lazy"
                                        >
                            <?php
                                    }
                                }
                            ?>
                        </div>
                        <svg class="prev">
                            <use class="previous"
                                 href="<?php echo get_template_directory_uri(); ?>/assets/img/slide.svg#icon-arrow-left"></use>
                        </svg>
                        <svg class="next">
                            <use class="next"
                                 href="<?php echo get_template_directory_uri(); ?>/assets/img/slide.svg#icon-arrow-right"></use>
                        </svg>
                        <div class="pinterest">
                            <a href="https://www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"
                               data-pin-round="true"> </a>
                        </div>
                        <div class="thumbnails-wrapper">
                            <div class="thumbnails" style="transform: translateX(0px);">
                                <?php
                                $images = get_field('galerie');
                                $size = 'full';
                                if ($images) {
                                    foreach ($images as $image) {
                                        ?>
                                        <img alt="<?php echo $image['alt']; ?>"
                                             src="<?php echo $image['sizes']['medium']; ?>"
                                             loading="lazy"
                                        >
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </diorama-slide>
                </section>
                <section class="texte">
                    <div class="columns">
                        <div class="column is-two-thirds"><h2 class="titre"><?php the_title(); ?></h2></div>
                        <div class="column  ">
                            <div class="data">Completed on
                                : <?php echo substr(get_field('completed_on'), 0, 4) . ' ' . substr(get_field('completed_on'), 4, 2) . ' ' . substr(get_field('completed_on'), 6, 2); ?></div>
                        </div>
                        <div class="column has-text-centered <?php echo empty(get_field('vendu')) ? '' : 'sold'; ?>">
                            <div class="neutral"></div>
                        </div>
                    </div>
                    <div class="columns v2">
                        <div class="column is-one-third size">
                            <?php if (empty(get_field('size_of_the_scene')) === false) { ?>
                                Size of the scene : <?php the_field('size_of_the_scene'); ?><br>
                            <?php }
                            if (empty(get_field('size_of_the_frame')) === false) { ?>
                                Size of the frame  : <?php the_field('size_of_the_frame'); ?>
                            <?php } ?>
                        </div>
                        <div class="column desc">
                            <h2>About</h2>
                            <p class="dioramaText">
                                <?php echo strip_tags(get_the_content(), '<br>'); ?>
                            </p>
                            <?php if (get_field('youtube')) { ?>
                                <div class="video-responsive">
                                    <iframe width="560" height="315"
                                            src="https://www.youtube.com/embed/<?php the_field('youtube'); ?>"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <?php
    get_footer();
    ?>
