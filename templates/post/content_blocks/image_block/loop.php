<?php
global $firmasite_content_blocks;
$header = get_sub_field("header");
?>
<?php if(get_sub_field('image')){ ?>
    <div id="block_id<?php echo $firmasite_content_blocks["block_id"];?>" class="content_blocks image_block">
        <?php if(!empty($header) && !(isset($firmasite_content_blocks["blocks"][$firmasite_content_blocks["parent"]]["collection_type"]) && "row" != $firmasite_content_blocks["blocks"][$firmasite_content_blocks["parent"]]["collection_type"])){ ?>
        <h3 class="header"><?php echo $header; ?></h3>
        <?php } ?>
        <?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'full'); ?>
        <img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_sub_field('image')) ?>" class="aligncenter" />
    </div>
<?php } ?>
