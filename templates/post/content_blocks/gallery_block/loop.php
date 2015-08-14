<?php     
global $firmasite_content_blocks;
$header = get_sub_field("header");
?>
    <div id="block_id<?php echo $firmasite_content_blocks["block_id"];?>" class="content_blocks gallery_block">
    	<?php if(!empty($header) && !(isset($firmasite_content_blocks["blocks"][$firmasite_content_blocks["parent"]]["collection_type"]) && "row" != $firmasite_content_blocks["blocks"][$firmasite_content_blocks["parent"]]["collection_type"])){ ?>
        <h3 class="header"><?php echo $header; ?></h3>
        <?php } ?>
        <?php $images = get_sub_field('gallery_images'); 
              $image_count = count($images);?>
        <?php if( $images ): 
			if (isset($firmasite_content_blocks["gallery_block"])) {
				if (isset($firmasite_content_blocks["gallery_block"]["count"])) {
					$firmasite_content_blocks["gallery_block"]["count"]++;
				} else {
					$firmasite_content_blocks["gallery_block"]["count"] = 1;
				}
			} else {
           		$firmasite_content_blocks["gallery_block"] = array();
				$firmasite_content_blocks["gallery_block"]["count"] = 1;
			}
        ?>
                <div class="firmasite-showcase carousel <?php if ($image_count > 1) echo " slide"; ?>" id="firmasite-gallery_block-<?php echo $firmasite_content_blocks["gallery_block"]["count"];?>" <?php if ($image_count > 1) echo 'data-rel="carousel"'; ?> data-interval="6000">
                    <?php if ($image_count > 1){ ?>
                          <ol class="carousel-indicators">                
                               <?php 
                               $i = 0;
                               $firmasite_gallery_block_slide_active = "active";
                               foreach ($images as $image) {  ?>
                                    <li data-target="#firmasite-gallery_block-<?php echo $firmasite_content_blocks["gallery_block"]["count"];?>" data-slide-to="<?php echo $i; ?>" class="<?php echo $firmasite_gallery_block_slide_active; ?>"></li>
                               <?php
                               $i++;
                               $firmasite_gallery_block_slide_active = "";
                               }?>
                          </ol>
                    <?php } ?>
                    <div class="<?php if ($image_count > 1) echo 'carousel-inner'; ?>">
                        <?php
                        $firmasite_gallery_block_slide_start = true;
                        $firmasite_gallery_block_slide_active = " active";
                        foreach( $images as $image ){
                            ?>
                            <div class="item post-<?php echo $firmasite_content_blocks["real_source"];  echo $firmasite_gallery_block_slide_active; $firmasite_gallery_block_slide_active = ""; ?>"> 
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                                <div class="carousel-caption">
                                    <?php if($image['caption']) { ?><h3 class='gallery-title hero-title'><?php echo $image['caption']; ?></h3><?php } ?>
                                    <?php if($image['description']) { ?><br /><p class="gallery-caption hero-content"><?php echo $image['description']; ?></p><?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if ($image_count > 1) { ?>
                    <a data-slide="prev" href="#firmasite-gallery_block-<?php echo $firmasite_content_blocks["gallery_block"]["count"];?>" class="left carousel-control"><span class="icon-prev"></span></a>
                    <a data-slide="next" href="#firmasite-gallery_block-<?php echo $firmasite_content_blocks["gallery_block"]["count"];?>" class="right carousel-control"><span class="icon-next"></span></a>
                    <?php } ?>
                </div>
        <?php endif; ?>
    </div>

