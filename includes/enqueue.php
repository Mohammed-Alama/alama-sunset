<?php

function sunset_load_admin_scripts($hook){
//    echo $hook;
    if($hook=='toplevel_page_alama_sunset'){
        wp_register_style('sunset_admin' ,get_template_directory_uri().'/css/sunset.admin.css',array(),microtime(),'all');
        wp_enqueue_style('sunset_admin');

        wp_enqueue_media();

        wp_register_script('sunset-admin-script',get_template_directory_uri() .'/js/sunset.admin.js',array('jquery'),microtime(),true);
        wp_enqueue_script('sunset-admin-script');
    }elseif($hook == 'sunset_page_alama_sunset_css'){
        wp_enqueue_style('ace',get_template_directory_uri().'/css/sunset.ace.css',array(),microtime(),'all');
        wp_enqueue_script('ace',get_template_directory_uri().'/js/ace/ace.js',array('jquery'),'1.2.1',true);
        wp_enqueue_script('sunset-custom-css-script',get_template_directory_uri().'/js/sunset.custom-css.js',array('jquery'),microtime(),true);
    }else{
    return;
    }

}

add_action('admin_enqueue_scripts','sunset_load_admin_scripts');

function sunset_load_scripts(){

    wp_enqueue_style('bootstrap',get_template_directory_uri().'/css/bootstrap.min.css',array(),'4.3.1','all');
    wp_enqueue_style('sunset',get_template_directory_uri().'/css/sunset.css',array(),microtime(),'all');
    wp_enqueue_style('raleway','https://fonts.googleapis.com/css?family=Raleway:200,300,500&display=swap');
    wp_deregister_script('jquery');
    wp_register_script('jquery',get_template_directory_uri().'/js/jquery.js',array(),'3.4.1',true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap',get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),'4.3.1',true);

}

add_action('wp_enqueue_scripts','sunset_load_scripts');