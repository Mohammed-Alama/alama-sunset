<?php

/*
	
@package sunsettheme
	
	========================
		ADMIN PAGE
	========================
    Position for Pages
    2-Dashboard
    4-Separator
    5-Posts
    10-Media
    15-Links
    20-Pages
    25-Comments
    59-Separator
    60-Appearance
    65-Plugins
    70-Users
    75-Tools
    80-Settings
    99-Separator

    ///

    get_template_directory_uri() ==> Absolute Path === for files disappear in front end
    get_template_directory() ==> Local Path === for files in backend

*/

function sunset_add_admin_page(){
    //Generate Sunset Admin Page
    add_menu_page('Sunset Theme Options','Sunset','manage_options','alama_sunset','sunset_theme_create_page',get_template_directory_uri().'/images/sunset-icon.png','110');
    //Generate Sunset Admin Sub Pages

    add_submenu_page('alama_sunset','Sunset Sidebar Options','Sidebar','manage_options','alama_sunset','sunset_theme_create_page');

    add_submenu_page('alama_sunset','Sunset Theme Options', ' Theme Options','manage_options','alama_sunset_theme','sunset_theme_support_page');

    add_submenu_page('alama_sunset','Sunset Contact Options','Contact Form','manage_options','alama_sunset_contact_form','sunset_contact_form_page');

    add_submenu_page('alama_sunset','Sunset CSS Options','Custom CSS','manage_options','alama_sunset_css','sunset_theme_settings_page');



//    Activate custom settings
    add_action('admin_init','sunset_custom_settings');
}
add_action('admin_menu','sunset_add_admin_page');
function sunset_theme_create_page(){
    require_once (get_template_directory().'/includes/templates/sunset-admin.php');
}
function sunset_theme_support_page(){
    require_once (get_template_directory().'/includes/templates/sunset-theme-support.php');
}
function sunset_contact_form_page(){
    require_once (get_template_directory().'/includes/templates/sunset-contact-form.php');
}
function sunset_theme_settings_page(){
    require_once (get_template_directory().'/includes/templates/sunset-custom-css.php');
}


function sunset_custom_settings(){
    //Sidebar Options
    register_setting('sunset-settings-group','profile_picture');
    register_setting('sunset-settings-group','first_name');
    register_setting('sunset-settings-group','last_name');
    register_setting('sunset-settings-group','user_desc');
    register_setting('sunset-settings-group','twitter_handler','sunset_sanitize_twitter_handler');
    register_setting('sunset-settings-group','facebook_handler');
    register_setting('sunset-settings-group','gplus_handler');

    add_settings_section('sunset-sidebar-options','Sidebar Options','sunset_sidebar_options','alama_sunset');

    add_settings_field('sidebar-profile-picture','Picture','sunset_sidebar_profile_picture','alama_sunset','sunset-sidebar-options');
    add_settings_field('sidebar-name','Full Name','sunset_sidebar_name','alama_sunset','sunset-sidebar-options');
    add_settings_field('sidebar-desc','Description','sunset_sidebar_desc','alama_sunset','sunset-sidebar-options');
    add_settings_field('sidebar-twitter','Twitter handler','sunset_sidebar_twitter','alama_sunset','sunset-sidebar-options');
    add_settings_field('sidebar_facebook','Facebook Handler','sunset_sidebar_facebook','alama_sunset' ,'sunset-sidebar-options');
    add_settings_field('sidebar_gplus','GooglePlus Handler','sunset_sidebar_gplus','alama_sunset','sunset-sidebar-options');

    //Theme Support Options
    register_setting('sunset-theme-support','post_formats');
    register_setting('sunset-theme-support','custom_header');
    register_setting('sunset-theme-support','custom_background');

    add_settings_section('sunset-theme-options','Theme Options','sunset_theme_options','alama_sunset_theme');

    add_settings_field('post-formats','Post Formats','sunset_post_formats','alama_sunset_theme','sunset-theme-options');
    add_settings_field('custom-header','Custom Header','sunset_custom_header','alama_sunset_theme','sunset-theme-options');
    add_settings_field('custom-background','Custom Background','sunset_custom_background','alama_sunset_theme','sunset-theme-options');

    //Contact Form Options
    register_setting('sunset-contact-options','contact_form');

    add_settings_section('sunset-contact-section','Contact Form','sunset_contact_section','alama_sunset_contact_form');

    add_settings_field('activate-form','Activate Contact Form ','sunset_activate_contact','alama_sunset_contact_form','sunset-contact-section');

    //Custom CSS Options
    register_setting('sunset-custom-css-options','sunset_css','sunset_sanitize_custom_css');

    add_settings_section('sunset-custom-css-section','Custom CSS','sunset_custom_css_section','alama_sunset_css');

    add_settings_field('custom-css','Insert your Custom CSS','sunset_custom_css_callback','alama_sunset_css','sunset-custom-css-section');


}

//Sidebar Options Functions
function sunset_sidebar_options(){
    echo 'Customize your Sidebar Information';
}

function  sunset_sidebar_profile_picture(){
    $profile_picture = esc_attr(get_option('profile_picture'));

    if (empty($profile_picture)){
        echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button" /><input id="profile-picture" type="hidden" name="profile_picture" value="" />';
    }else{
        echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button" /><input id="profile-picture" type="hidden" name="profile_picture" value="'.$profile_picture.'" /> <input type="button" class="button button-secondary" value="Remove Profile Picture" id="remove-picture" />';
    }


}
//Generate input field for first_name option
function sunset_sidebar_name(){
    $firstName = esc_attr(get_option('first_name'));
    $lastName = esc_attr(get_option('last_name'));
    echo '<input type="text" name="first_name" placeholder="First Name" value="'.$firstName.'" /> 
          <input type="text" name="last_name" placeholder="Last Name" value="'.$lastName.'" />';
}
function sunset_sidebar_desc(){
    $desc = esc_attr(get_option('user_desc'));
    echo '<input type="text" name="user_desc" placeholder="Description" value="'.$desc.'" /><p class="description">Write Somethings Smart : )</p>';
}
function sunset_sidebar_twitter(){
    $twitter = esc_attr(get_option('twitter_handler'));
    echo '<input type="text" name="twitter_handler" placeholder="Twitter Handler" value="'.$twitter.'" /> <p class="description">Input Twitter username without @ character.</p>';
}
function sunset_sanitize_twitter_handler($input){
    $output = sanitize_text_field($input);
    $output = str_replace('@','',$output);
    return $output;
}
function sunset_sidebar_facebook(){
    $facebook = esc_attr(get_option('facebook_handler'));
    echo '<input type="text" name="facebook_handler" placeholder="Facebook Handler" value="'.$facebook.'" />';
}
function sunset_sidebar_gplus(){
    $gplus =  esc_attr(get_option('gplus_handler'));
    echo '<input type="text" name="gplus_handler" placeholder="GooglePlus Handler" value="'.$gplus.'" />';
}

function sunset_theme_options(){
    echo  'Activate and Deactivate specific Theme Support Options';
}
function sunset_post_formats(){
    $options = get_option('post_formats');

    $formats = array('aside','gallery','link','image','quote','status','video','audio','chat');
    $output = '';
    foreach ($formats as $format){
        $checked = (@$options[$format] == 1 ? 'checked': '' );
        $output.='<label><input type="checkbox" id="'.$format.'"  name="post_formats['.$format.']" value="1" '.$checked.' > '.$format.'</label><br>';
    }
    echo $output;
}
function sunset_custom_header(){
    $custom_header = get_option('custom_header');
    $checked = (@$custom_header  == 1 ? 'checked': '' );
    echo '<label><input type="checkbox" id="custom_header"  name="custom_header" value="1" '.$checked.' >Activate Custom Header</label><br>';

}
function sunset_custom_background(){
    $custom_background = get_option('custom_background');
    $checked = (@$custom_background == 1 ? 'checked': '' );
    echo '<label><input type="checkbox" id="custom_background"  name="custom_background" value="1" '.$checked.' >Activate Custom Background</label>';
}
//Contact Form Page
function sunset_contact_section(){
    echo 'Activate and Deactivate Built-in Contact Form ';
}
function sunset_activate_contact(){
    $contact_form = get_option('contact_form');
    $checked = (@$contact_form == 1 ? 'checked': '' );
    echo '<label><input type="checkbox" id="contact_form"  name="contact_form" value="1" '.$checked.' ></label>';
}
//Custom CSS Page

function sunset_custom_css_section(){
    echo 'Customize Sunset Theme with your own CSS';
}

function sunset_custom_css_callback(){
    $css = get_option('sunset_css');
    $css = (empty($css)?'/*Sunset Theme Custom CSS*/':$css);
    echo '<div id="customCSS">'.$css.'</div><textarea id="sunset_css" name="sunset_css" style="display:none;visibility: hidden;">'.$css.'</textarea>';
}

function sunset_sanitize_custom_css($input){
    $output = esc_textarea($input);
    return $output;
}
