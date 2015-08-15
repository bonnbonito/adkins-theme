<?php global $firmasite_settings; 

if (has_nav_menu('main_menu')){
	remove_action("logo_side_open","firmasite_plugin_social_menu");
	remove_action( 'logo_side_after', "firmasite_premium_menu_logo_side_menu");
}
?>
<header id="masthead" class="site-header header-style-3" role="banner">
  <div id="masthead-inner" class="<?php echo $firmasite_settings["layout_container_class"]; ?>">
  
   <?php do_action( 'open_header' ); ?>
   
   <div class="row">

	<div class="mainmenu-split col-xs-12 col-md-5">
        <div id="logo">         
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'description' ); ?>" rel="home" id="logo-link" class="logo" data-section="body">
                <?php if (isset($firmasite_settings["logo"]) && !empty($firmasite_settings["logo"])) {?>
                <img src="<?php echo $firmasite_settings["logo"];?>" alt="<?php bloginfo( 'name' ); ?>" id="logo-img" />
                 <?php } else {?>
                <span class="label label-<?php echo $firmasite_settings["color-logo-text"];?> logo-text"><?php bloginfo( 'name' ); ?></span>
                <?php }?>
            </a>
           <?php if (get_bloginfo( 'description' )) {?>
           <?php } ?>
        </div>
    </div>
	<div class="mainmenu-split col-xs-12 col-md-7">

		<div id="navbar-splitter" class="clearfix"></div>
    <?php if (has_nav_menu('main_menu')) : 
           switch ($firmasite_settings["menu-style"]) {
                case "simple":
           ?>
                  <div class="hidden-md hidden-lg">
                      <a class="navbar-toggle collapsed btn btn-default btn-sm" data-toggle="collapse" data-target=".main-menu-collapse">
                        <span class="icon-reorder"></span>
                        <b class="caret"></b>
                      </a>
                  </div>                 
					<?php do_action("firmasite_premium_logo_side_open"); ?>
                    <ul class="firmasite-premium-menu nav nav-pills pull-right">
                        <?php do_action("firmasite_premium_menu_open"); ?>
                        
                        <?php do_action("firmasite_premium_menu_close"); ?>
                    </ul>  
                    <?php do_action("firmasite_premium_logo_side_close"); ?>
                  <nav id="mainmenu" class="collapse navbar-collapse main-menu-collapse" role="navigation">
                    <?php  wp_nav_menu(array('theme_location' => 'main_menu', 'menu_class' => 'nav nav-pills')); ?>
                  </nav>
           <?php
                break;
               
                case "default":
                case "alternative":
                default:
           ?>
            <nav id="mainmenu" role="navigation" class="site-navigation main-navigation navbar <?php if ((isset($firmasite_settings["alternative"]) && !empty($firmasite_settings["alternative"])) || "alternative" == $firmasite_settings["menu-style"]){ echo " navbar-inverse";} else { echo " "; } ?>">          
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed withripple" data-toggle="collapse" data-target=".main-menu-collapse">
                    <span class="sr-only"><?php _e("Toggle navigation", 'firmasite-base' );?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
              </div>                
			<?php do_action("firmasite_premium_logo_side_open"); ?>
            <?php do_action("firmasite_premium_logo_side_close"); ?>
              <div id="nav-main" class="collapse navbar-collapse main-menu-collapse" role="navigation">

                <?php  wp_nav_menu(array('theme_location' => 'main_menu', 'menu_class' => 'nav navbar-nav')); ?>

                               
              </div>
            </nav>    <!-- .site-navigation .main-navigation --> 
           <?php 
                break;
           }
    endif; ?>
    </div>
   </div>
   
    <?php do_action( 'close_header' ); ?>
    
  </div>
</header><!-- #masthead .site-header -->