<?php
/*

@package sunsettheme

	========================
	    CUSTOM POST TYPES
	========================
*/

$contact_form = get_option('contact_form');

if(@$contact_form == 1){
    add_action('init','sunset_contact_cpt');
//   if you want add column to cpt use this filter
//    add_filter('manage_mycptname_posts_columns','callback_function_that_add_columns') ;
    add_filter('manage_sunset-contact_posts_columns','sunset_set_contact_columns') ;
    add_action('manage_sunset-contact_posts_custom_column','sunset_contact_custom_column',10,2);
//    add_action('add_meta_boxes','sunset_contact_add_meta_box');
    add_action('save_post','sunset_save_contact_email_data');

}

//Contact CPT
function sunset_contact_cpt(){
    $labels = array(
        'name'           =>'Massages',
        'singular_name'  =>'Message',
        'menu_name'      =>'Massages',
        'name_admin_bar' =>'Message'
    );
    $args = array(
        'labels'            => $labels,
        'show_ui'           => true,
        'capability_type'   =>'post',
        'hierarchical'      =>false,
        'menu_position'     =>26,
        'menu_icon'         =>'dashicons-email-alt',
        'register_meta_box_cb' =>'sunset_contact_add_meta_box',
        'supports'          =>array('title','editor','author')
    );

    register_post_type('sunset-contact' ,$args);
}


//add column to sunset-contact list

function sunset_set_contact_columns($input){
    $newColumns = array();
    $newColumns['title'] = 'Full Name';
    $newColumns['message'] = 'Message';
    $newColumns['email'] = 'Email';
    $newColumns['date']= 'Date';

    return $newColumns;
}

function sunset_contact_custom_column($column , $post_id){
    switch ($column){
        case 'message':
            echo get_the_excerpt();
            break;
        case 'email':
            $email= get_post_meta($post_id,'_contact_email_value_key',true);
            echo '<a href="mailto:'.$email.'">'.$email;
            break;
    }
}



/*Contact Meta Boxes*/

function sunset_contact_add_meta_box(){
    add_meta_box('contact_email',esc_html__('Email Address'),'sunset_contact_email_callback','sunset-contact');
}

function sunset_contact_email_callback($post){
    wp_nonce_field('sunset_save_contact_email_data','sunset_contact_email_meta_box_nonce');

    $value = get_post_meta($post->ID,'_contact_email_value_key',true);

    echo '<label for="sunset_contact_email_field">Email Address</label>';
    echo '<input type="email" id="sunset_contact_email_field" name="sunset_contact_email_field" size="25" value="'.esc_attr__($value).'" />';
}

function sunset_save_contact_email_data($post_id){
    if ( ! isset($_POST['sunset_contact_email_meta_box_nonce'] ) ){
        return;
    }
    if (! wp_verify_nonce($_POST['sunset_contact_email_meta_box_nonce'],'sunset_save_contact_email_data') ){
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        //this for disable autosave fot email metabox
        return;
    }
    if (!current_user_can('edit_post',$post_id)){
        return;
    }
    if (! isset($_POST['sunset_contact_email_field'])){
        return;
    }

    $email = sanitize_text_field($_POST['sunset_contact_email_field']);
    update_post_meta($post_id,'_contact_email_value_key',$email);
}






































