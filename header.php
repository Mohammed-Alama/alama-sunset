<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="description" content="<?php bloginfo('description')?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if (is_singular() && pings_open(get_queried_object()) ) : ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url');?>">
    <?php endif;?>
    <?php wp_head(); ?>
    <title><?php bloginfo('name') ; wp_title(); ?></title>

</head>
<body <?php body_class();?> >

<div class="container">
        <div class="col-xs-12">

            <header class="header-container background-image text-center" style="background-image: url(<?php header_image();?>)">

            <div class="header-content">
                    <h1 class="site-title sunset-icon">
                        <span style="display: none"><?php bloginfo('name'); ?></span>

                        <span class="sunset-logo"></span>
                    </h1>
                    <h2 class="site-description"><?php bloginfo('description'); ?></h2>
            </div><!-- .header-content -->
                <div class="nav-container">
                    <nav class="navbar navbar-deafult navbar-sunset">
                        <?php
                        wp_nav_menu(array(
                                'theme_location'=>'primary',
                                'container'=>false,
                                'menu_class'=>'nav navbar-nav',
                                'walker' => new Sunset_Walker_Nav_Primary()
                        ));
                        ?>
                    </nav>
                </div><!-- .nav-container -->
            </header><!-- .header-container -->

        </div><!--.col-xs-12 -->
</div><!-- .container-fluid-->
