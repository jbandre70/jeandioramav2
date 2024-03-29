<?php
/**
 * Template name: About
 */

get_header();
$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
?>
<main id="main">
    <section class="purplepage">
        <div class="columns">
            <div class="column is-three-quarters bio">
                <div><h1><?php the_title(); ?></h1>
                    <div><?php the_content(); ?>
                    </div>
                    <div></div>
                </div>
            </div>
            <div class="column form">
                <div class="columns is-multiline is-mobile bordertop">
                    <div class="column is-12"><h2 class="contact">Contact</h2>
                        <!--<div id="confirmation"></div>
                        <form class="react-form" id="contact"  method="post" action="<?php /*echo admin_url( 'admin-ajax.php' ); */?>" >
                            <div class="field"><label for="formName">Name:</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input is-danger"
                                           type="text" id="formName"
                                           name="formName" required=""
                                           value="">
                                    <input class="honey"
                                           name="formHoney"
                                           id="formHoney">
                                    <span class="error" id="nameError"></span>
                                    <span class="icon is-small is-left"></span>
                                    <span class="icon is-small is-right" id="nameC">
                                        <i class=""></i></span>
                                </div>
                            </div>
                            <div class="field"><label for="formEmail">Email:</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input
                                            class="input is-danger"
                                           type="email" id="formEmail"
                                           name="formEmail" required=""
                                           value=""
                                    >
                                    <input type="hidden" name="honeypot" id="honeypot">
                                    <span class="error" id="emailError">

                                    </span>
                                    <span class="icon is-small is-left"></span>
                                    <span class="icon is-small is-right" id="emailC">
                                        <i class=""></i></span>
                                </div>
                            </div>
                            <div class="field"><label for="formMessage">Message:</label>
                                <div class="control has-icons-left has-icons-right">
                                    <textarea class="textarea"
                                      id="formMessage"
                                      name="formMessage"
                                      required=""
                                    >
                                    </textarea>
                                    <span class="error" id="messageError"></span>
                                    <span class="icon is-small is-right" id="messageC"><i class=""></i></span>
                                </div>
                            </div>
                            <div class="field is-grouped">
                                <div class="control">
                                    <input id="formButton" class="button is-link" type="submit" placeholder="Send" value="SEND">
                                </div>
                            </div>
                        </form>-->
                        <a href="mailto:jbadiorama@gmail.com">jbadiorama@gmail.com</a>
                        <div class="comments"></div>
                    </div>
                    <div class="column is-12 links"><h2>LINKS</h2>
                        <div>
                            <?php
                            $args = [
                                'category_name' => 'links',
                                'posts_per_page' => -1,
                            ];

                            $query = new WP_Query($args);
                            if ($query->have_posts()) {
                                while ($query->have_posts()) {
                                    $query->the_post();
                                    ?>
                                    <div>
                                        <a href="<?php the_field('link'); ?>" target="blank"><?php the_title(); ?></a>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo 'Aucun article trouvé.';
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php
get_footer();
?>
