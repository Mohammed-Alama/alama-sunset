<?php
?>

<article id="post<?php the_ID()?>" <?php post_class('sunset-format-gallery'); ?>>
    <?php if(sunset_get_attachment()): $attachments = sunset_get_attachment(4);?>
        <div id="post-gallery-<?php the_ID();?>" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php $i = 0; foreach ($attachments as $attachment):$active =  ($i == 0 ? 'active' : '') ?>
                <li data-target="#post-gallery-<?php the_ID();?>" data-slide-to="<?php echo $i;?>" class="<?php echo $active;?>"></li>
                <?php $i++;endforeach;?>
            </ol>
            <div class="carousel-inner">
                <?php $i = 0; foreach ($attachments as $attachment):$active =  ($i == 0 ? 'active' : '') ?>
                    <div class="carousel-item <?php echo $active; ?> ">
                        <img class="standard-featured  d-block w-100" src="<?php echo wp_get_attachment_url($attachment->ID);?>" alt="">
                    </div>
                <?php $i++;endforeach;?>
            </div>
            <a class="carousel-control-prev" href="#post-gallery-<?php the_ID();?>" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#post-gallery-<?php the_ID();?>" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    <?php endif; ?>
    <header class="entry-header text-center">
        <?php the_title('<h1 class="entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">','</a></h1>'); ?>
        <div class="entry-meta">
            <?php echo sunset_posted_meta();?>
        </div>
    </header>
    <div class="entry-content">


        <div class="entry-excerpt">
            <?php the_excerpt();?>
        </div>
    </div>

    <footer class="entry-footer">
        <?php echo sunset_posted_footer();?>
    </footer>
</article>


