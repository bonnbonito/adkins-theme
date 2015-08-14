<?php     
global $firmasite_content_blocks;
$header = get_sub_field("header");
?>
<div id="block_id<?php echo $firmasite_content_blocks["block_id"];?>" class="content_blocks contents_link_block">
    <?php if(!empty($header) && !(isset($firmasite_content_blocks["blocks"][$firmasite_content_blocks["parent"]]["collection_type"]) && "row" != $firmasite_content_blocks["blocks"][$firmasite_content_blocks["parent"]]["collection_type"])){ ?>
    <h3 class="header"><?php echo $header; ?></h3>
    <?php } ?>
    <?php 
	$posts = get_sub_field('contents_to_link');
    $options = get_sub_field('options');

	global $wp_query;
	$temp = $wp_query;
	
 if($posts) {
	$wp_query = new WP_Query(array(
		'post_type' => apply_filters( 'firmasite_pre_get_posts_ekle', array( 'post', 'page' )),
		'post__in' => $posts,
		'posts_per_page' => -1,
		'ignore_sticky_posts' => 1,
		'orderby' => 'post__in',
	));

	if($wp_query->have_posts()):
	switch($options){
		case "loop-list":
		case "loop-excerpt":
		case "loop-tile":
			global $firmasite_settings;
			$loop_style_temp = $firmasite_settings["loop-style"];
			$firmasite_settings["loop-style"] = $options;
			while($wp_query->have_posts()) : $wp_query->the_post();
				global $more;
				$more = 0;
				get_template_part( 'templates/loop', $post->post_type );
			endwhile; 
			$firmasite_settings["loop-style"] = $loop_style_temp;
			break;
		case "mini_menu":
			echo '<ul class="list-group">';
			while($wp_query->have_posts()) : $wp_query->the_post();
				global $post;
				?>
					<li class="list-group-item">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
				<?php
			endwhile; 
			echo "</ul>";
			break;
		case "showcase":
			global $post;
			global $more;
			$more = 0;
			global $firmasite_settings;
			if(isset($firmasite_settings["shortcode_showcase"])){
				$firmasite_settings["shortcode_showcase"]++;
			} else {
				$firmasite_settings["shortcode_showcase"] = 1;
			}
			?>
				<div class="firmasite-showcase carousel <?php if ($wp_query->post_count > 1) echo " slide"; ?>" id="firmasite-showcase-<?php echo $firmasite_settings["shortcode_showcase"];?>" <?php if ($wp_query->post_count > 1) echo 'data-rel="carousel"'; ?> data-interval="6000">
					<?php if ($wp_query->post_count > 1){ ?>
						  <ol class="carousel-indicators">                
							   <?php 
							   $i = 0;
							   $firmasite_showcase_slide_active = "active";
							   foreach ($wp_query->posts as $firmasite_showcase_post) {  ?>
									<li data-target="#firmasite-showcase-<?php echo $firmasite_settings["shortcode_showcase"];?>" data-slide-to="<?php echo $i; ?>" class="<?php echo $firmasite_showcase_slide_active; ?>"></li>
							   <?php
							   $i++;
							   $firmasite_showcase_slide_active = "";
							   }?>
						  </ol>
					<?php } ?>
					<div class="<?php if ($wp_query->post_count > 1) echo 'carousel-inner'; ?>">
						<?php
						$firmasite_showcase_slide_start = true;
						$firmasite_showcase_slide_active = " active";
						while ( $wp_query->have_posts() ) {
							$wp_query->the_post();
							global $post;
							?>
							<div class="item post-<?php echo $firmasite_content_blocks["real_source"];  echo $firmasite_showcase_slide_active; $firmasite_showcase_slide_active = ""; ?>"> 
								<?php get_template_part( 'templates/showcase', $post->post_type );?>
							</div>
						<?php } ?>
					</div>
					<?php if ($wp_query->post_count > 1) { ?>
					<a data-slide="prev" href="#firmasite-showcase-<?php echo $firmasite_settings["shortcode_showcase"];?>" class="left carousel-control"><span class="icon-prev"></span></a>
					<a data-slide="next" href="#firmasite-showcase-<?php echo $firmasite_settings["shortcode_showcase"];?>" class="right carousel-control"><span class="icon-next"></span></a>
					<?php } ?>
				</div>
			<?php
			break;
	}

	$wp_query = $temp;
    wp_reset_query(); // reset the query
    endif;
 }	?>
    <div class="clearfix"></div>
 </div>
