<?php
global $firmasite_showcase, $post, $firmasite_settings;

	if ( has_post_thumbnail()){ 
		$cover = "";
		$large_image_url = "";
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
		if ($large_image_url[1] > (get_option( 'large_size_w' ) / 1.3 )) { 
			$cover = "background-size:cover;";
		}  
	?>  
     <div class="firmasite-showcase-content jumbotron hero-background clearfix" style="background-image:url(<?php echo $large_image_url[0]; ?>); background-repeat:no-repeat; background-position:center right 15%; <?php  echo $cover;?>">
	<?php } else {  ?>  
     <div class="firmasite-showcase-content jumbotron clearfix">                                       
	<?php }  ?>  
        <div class="caption">
            <h2 class="hero-title"><?php the_title_attribute(); ?></h2>
             <div class="hero-content hidden-xs">
	            <?php ob_start(); 
                if (isset($firmasite_settings["showcase-calltoaction"]) && !empty($firmasite_settings["showcase-calltoaction"])) {
                    echo $firmasite_settings["showcase-calltoaction"];
                } else {
                    _e( 'Continue reading <span class="meta-nav">&rarr;</span>', 'firmasite-base' ); 
                }
                $more_button = ob_get_contents();
                ob_end_clean(); 
				
                if ( !preg_match('/<!--more(.*?)?-->/', $post->post_content) ){
                    the_excerpt(); 
				} else {
                    the_content( '' );
                } ?>
             </div>
             <a class="hero-link btn btn-primary" href="<?php the_permalink(); ?>">
                <?php echo $more_button; ?>
             </a>
        </div>
    </div> 
<?php
