<?php
   /**
    * Plugin Name:       woocommerceAnimalPlugin
    * Plugin URI:
    * Description:       Plugin Backend test Prixz 
    * Version:           1.0
    * Author:            Jordy
    * Author URI:           
    * */

    /*
    * Get data bases
    */
    require_once plugin_dir_path(__FILE__) . 'includes/connectBd.php';
    /*
    * functions to print hmtl
    */
    require_once plugin_dir_path(__FILE__) . 'includes/printHml.php';
    /*
    * Add css and javascript at plugin
    */
    require_once plugin_dir_path(__FILE__) . 'includes/scriptsStyle.php';
    /*
    * Management backend 
    */
    require_once plugin_dir_path(__FILE__) . 'includes/managementBackend.php';

    /* 
    * Short code
    */
    require_once plugin_dir_path(__FILE__) . 'includes/animalPlugin.php';
    
?>