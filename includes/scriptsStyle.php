<?php 

function animalPlugin_frontend_styles () {
    wp_enqueue_style('animalPlugin_css', plugins_url('../assets/css/animalPlugin.css', __FILE__));

    wp_enqueue_script('animalPluginjs', plugins_url('../assets/js/animalPlugin.js', __FILE__), array('jquery'), 1.0, true);

    Wp_localize_script('animalPluginjs', 'admin_url', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'animalPlugin_frontend_styles');