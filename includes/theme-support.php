<?php
/*

@package sunsettheme

	========================
	THEME SUPPORT FUNCTIONS
	========================
*/

$options = get_option('post_formats');
$formats = array('aside','gallery','link','image','quote','status','video','audio','chat');
$output = array();
foreach ($formats as $format) {
    $output[] = (@$options[$format] == 1 ? $format : '');
}

if(!empty($options)){
    add_theme_support('post-formats', $output );
}

$custom_header = get_option('custom_header');

if(@$custom_header == 1){
  add_theme_support('custom-header');
}

$custom_background = get_option('custom_background');

if(@$custom_background == 1){
    add_theme_support('custom-background');
}

$contact_form = get_option('contact_form');

if(@$custom_background == 1){
    //add cpt contact
    add_theme_support('custom-background');
}

add_theme_support('post-thumbnails');

//Activate Nav Menue Option

function sunset_register_nav_menu(){
    register_nav_menu('primary','Primary Navigation Menu');
}

add_action('after_setup_theme','sunset_register_nav_menu');



function sunset_posted_meta(){

    $posted_on = human_time_diff(get_the_time('U'),current_time('timestamp'));
    $categories = get_the_category();
    $separator = ', ';
    $output = '';
    $i = 1;
    if (!empty($categories)):
        foreach ($categories as $category):
            if ($i>1): $output .= $separator;endif;
            $output .= '<a href=" '.esc_url(get_category_link($category->term_id)).'" title="'.esc_attr('View all posts in&s', $category->name).'" >'.esc_html($category->name).'</a>';
            $i++;
        endforeach;
    endif;
    return '<span class="posted-on">Posted <a href="'
        .esc_url(get_permalink()).
        '">'
        .$posted_on.
        '</a> ago </span>/ <span class="posted-in">'
        .$output.
        '</span>';
}

function sunset_posted_footer(){
    $comments_num = get_comments_number();
    if (comments_open()){
        if ($comments_num == 0 ){
            $comments  = __('No Comments','sunset');
        }elseif ($comments_num > 1){
            $comments = $comments_num . __('Comments','sunset');
        }
        else{
            $comments = __('1 Comment','sunset');
        }
        $comments = '<a class="comments-link"  href="' . get_comments_link() . '">' . $comments . '  <span class="sunset-icon sunset-comment"></span></a>';
        //gets Comment link
    }else{
        $comments = __('Comments ara Closed','sunset');
    }
    return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">'.get_the_tag_list('<div class="tags-list"><span class="sunset-icon sunset-tag"></span>',' ','</div>') .'</div><div class="col-xs-12 col-sm-6 text-right">'.$comments .'</div></div></div>';
}

function sunset_get_attachment($num = 1){
    $output = '';
    if(has_post_thumbnail() && $num == 1):
        $output = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
    else:
        $attachments = get_posts(array(
            'post_type'=>'attachment',
            'posts_per_page'=>$num,
            'post_parent'=>get_the_ID()
            )
        );
        if ($attachments && $num == 1):
            foreach ($attachments as $attachment):
                $output = wp_get_attachment_url($attachment->ID);
            endforeach;
         elseif( $attachments && $num > 1 ):
            $output = $attachments;
        endif;
        wp_reset_postdata();
    endif;
    return $output;
}

function sunset_get_embedded_media($post,$type = array()){
    $content = do_shortcode(apply_filters('the_content', $post->post_content));
    $embed = get_media_embedded_in_content($content, $type);
    if(in_array('audio',$type)):
        $embed =  str_replace('visual=true', 'visual=false', $embed[0]);
    else:
        $embed = $embed[0];
    endif;
    return $embed;
}

function sunset_grab_url(){
    if (! preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/i',get_the_content(),$links)){
        return false;
    }else{
        return esc_url_raw(($links[1]));
    }

}