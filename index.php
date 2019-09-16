<?php get_header(); ?>
<div id="primary" class="content-area">
    <div id="main" class="site-main" role="main">
        <div class="container">
            <?php
                if (have_posts()):

                    while (have_posts()):the_post();

                    get_template_part('template-parts/content',get_post_format());

                    endwhile;

                endif;

            ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>