<?php
include('includes/class-jeandiorama-admin.php');
include('includes/class-jeandiorama-front.php');
include('includes/class-jeandiorama-contenttypes.php');

use Jeandiorama\JeandioramaAdmin;
use Jeandiorama\JeandioramaSetup;
use Jeandiorama\JeandioramaContentTypes;

if (is_admin()) {
   new JeandioramaAdmin();
}

new JeandioramaSetup();
new JeandioramaContentTypes();

//To redo

add_action('wp_ajax_nopriv_formSubmission', 'formSubmission');
add_action('wp_ajax_mail_formSubmission', 'formSubmission');
function formSubmission()
{

    $name = $_POST['formName'];
    $email = $_POST['formEmail'];
    $message = $_POST['formMessage'];
    var_dump($_REQUEST);
    var_dump('aaaaa');

    wp_mail('jbadiorama@gmail.com', 'mail du site jeandiorama', "$name , $email $message");

    return 'email sent';
    die();
}
