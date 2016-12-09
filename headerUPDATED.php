<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php wp_title(''); ?></title>
<!-- <?php showCredits(); ?>-->
<?php $get_settings = get_option('custom_theme_options'); ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if($get_settings['favicon-image'] != '') { ?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $get_settings['favicon-image'];?>" />
<?php } ?>
<?php wp_head(); ?>
</head>
<body>
<?php if(is_front_page()){ ?>
<div id="loaderMask"><span id="percentage">0%</span><div id="loaderBarFrame"><div id="loaderBarTrack"><div id="loaderBar"></div></div></div></div>
<?php } ?>
<div id="navigation">
    <div id="menuClose">
     <i class="dashicons dashicons-no-alt"></i>
    </div>
    <?php wp_nav_menu( array('menu' => 'Main Navigation' )); ?>
</div>

<div id="header">
  <div id="navMenu">
      <div id="menuOpen">
          <a href="javascript:;"><i class="dashicons dashicons-menu"></i> |  &nbsp; MENU</a>
      </div>
  </div>

  <div id="headerLogo">
      <?php if($get_settings['site-logo-url'] != '') { ?>
      <a href="<?php bloginfo('wpurl');?>"><img src="<?php echo $get_settings['site-logo-url'];?>" alt="<?php wp_title(''); ?>"/></a>
      <?php } ?>
  </div>
</div>

<div id="content">
