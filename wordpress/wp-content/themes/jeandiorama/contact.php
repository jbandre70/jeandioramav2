<?php /**
 * Template name: Contact
*/
get_header(); ?>
<main id="main">
    <section class="purplepage">
        <div class="columns">
            <div class="column is-three-quarters bio">
                <h1>JEAN DIORAMA - Contact</h1>
                <div class="confirmation">
                </div>
                <div class="contact">
                    <form id="contact" action="<?php echo admin_url('admin-ajax.php'); ?>">

                        <label for="name">Your name <br>
                            <input type="text" name="formName" id="" required>
                        </label>
                        <label for="name">Your email <br>
                            <input type="email" name="formEmail" id="" required>
                        </label>
                        <input type="text" name="honey" class="honey">
                        <label for="message">Your message <br>
                            <textarea name="formMessage" id="" cols="30" rows="10" required></textarea>
                        </label>
                        <input type="hidden" name="action" value="formSubmission">
                        <button
                            type="submit"
                            value="Send"
                            id="formButton"
                            data-postid="<?php echo get_the_ID(); ?>"
                            data-nonce="<?php echo wp_create_nonce('jeandiorama'); ?>"
                            data-action="jeandiorama_send_mail"
                            data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>"
                        >
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
?>
