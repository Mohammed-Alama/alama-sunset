<?php
?>

<article id="post<?php the_ID()?>" <?php post_class('sunset-format-video'); ?>>
    <header class="entry-header text-center">
        <div class="embed-responsive embed-responsive-16by9">
        <?php echo sunset_get_embedded_media($post,array('video','iframe'));?>
        </div>
        <?php the_title('<h1 class="entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">','</a></h1>'); ?>
        <div class="entry-meta">
            <?php echo sunset_posted_meta();?>
        </div>
    </header>
    <div class="entry-content">
        <div class="entry-excerpt">
            <?php the_excerpt();?>
        </div>
        <div class="button-container text-center">
            <a href="<?php the_permalink();?>" class="btn btn-sunset"><?php _e('Read More','sunset')?></a>
        </div>
    </div>

    <footer class="entry-footer">
        <?php echo sunset_posted_footer();?>
    </footer>
</article>


