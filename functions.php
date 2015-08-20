<?php

/* DONT REMOVE THIS LINE */
require_once ( get_stylesheet_directory() . '/functions/child_theme.php');	// Initial child theme setup and constants
/* You can add all custom php codes below
 * Some example codes you can use: 
 * http://theme.firmasite.com/tag/child-php/ 
 */


/* 
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
 * How to add bootstrap skins
 * This example adds "Pink" style to Theme Styles and removes "Default" bootstrap style
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */ 
 
/* 
 * This function adds our custom bootstrap styles to option list
 */  
add_filter( 'firmasite_theme_styles', "firmasite_childtheme_example_style" );
function firmasite_childtheme_example_style($array) {
	
	// Remove "default" named bootstrap style
	unset($array["default"]);
	
	// You can add multiple custom theme style
	$newthemes = array(
		"cupid" => __( 'Cupid', 'example' ),
	);
	
	// If you want to remove default styles comes with parent theme, use:
	// return $newthemes;
	return $newthemes + $array;
}
/* 
 * This function adds our custom bootstrap styles' location url to theme settings
 */
add_filter( 'firmasite_theme_styles_url', "firmasite_childtheme_example_style_url");
function firmasite_childtheme_example_style_url($array) {

	// You can add multiple custom theme style
	$newthemes = array(
		"cupid" => get_stylesheet_directory_uri() . '/assets/themes/cupid',
	);

	return $newthemes + $array;
}
/* 
 * This function makes our custom bootstrap style selected when switched to this theme
 * You can use this example for changing other settings too. Be careful when changing those settings.
 */
/*
add_action( 'after_switch_theme',  'firmasite_childtheme_change_style' );
function firmasite_childtheme_change_style() {
	// bug report / support: http://unsalkorkmaz.com/
	// We got theme settings
	$settings = get_option( 'firmasite_settings' );
	
	// We are setting selected style as one of our custom bootstrap style
	$settings["style"] = "cupid";
	
	// Now we are saving settings
	update_option( 'firmasite_settings', $settings );
}
*/























