<!DOCTYPE html>

<html <?php language_attributes(); ?> >

<head>
    <title>Jordan Barber - <?php the_title(); ?></title>
    <meta http-equiv="X-UA-compatible" content="IE=edge" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon-precomposed.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css?family=Exo:400,400i,800" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class( $class ); ?> >

<?php include_once("svg/svg-defs.svg"); ?>

<header>
    <div class="main-wrap">
        <a class="logo" href="/"><img width="54" height="56" src="/wp-content/themes/jordan/img/logo.png" /></a>
        <nav>
            <?php if (is_front_page() ): ?>
                <li><a href="" onclick="customScroll(event, about, 50 );">About</a></li>
                <li><a class="work-trigger" href="">Work</a></li>
                <li><a href="" onclick="customScroll(event, contact, 45);">Contact</a></li>
                <!-- <li><a href="">Web Things<i class="fa fa-caret-down"></i></a>
                    <ul>
                        <li><a href="/filmic">KinoFiles</a></li>
                    </ul>
                </li> -->
            <?php else: ?>
                <li><a class="work-trigger" href="">Work</a></li>
                <li><a href="/">Head Back Home</a></li>
            <?php endif; ?>
        </nav>
        <a class="mobile-trigger work-trigger" href="#">Work</a>
    </div>
</header>

<div id="full-overlay">
    <div id="work-loader"></div>
    <i class="fa fa-close close-work"></i>
    <div id="case-study-container">
    </div>
</div>