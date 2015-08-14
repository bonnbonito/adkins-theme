<?php     
global $firmasite_content_blocks;
$header = get_sub_field("header");
?>
<div id="block_id<?php echo $firmasite_content_blocks["block_id"];?>" class="content_blocks text_block">
    <?php if(!empty($header) && !(isset($firmasite_content_blocks["blocks"][$firmasite_content_blocks["parent"]]["collection_type"]) && "row" != $firmasite_content_blocks["blocks"][$firmasite_content_blocks["parent"]]["collection_type"]) ){ ?>
    <h3 class="header"><?php echo $header; ?></h3>
    <?php } ?>
    <?php the_sub_field("text_block"); ?>
</div>
