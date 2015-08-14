<?php     
global $firmasite_content_blocks;
$header = get_sub_field("header");
?>
<div id="block_id<?php echo $firmasite_content_blocks["block_id"];?>" class="content_blocks contact_form_block">
    <?php if(!empty($header) && !(isset($firmasite_content_blocks["blocks"][$firmasite_content_blocks["parent"]]["collection_type"]) && "row" != $firmasite_content_blocks["blocks"][$firmasite_content_blocks["parent"]]["collection_type"])){ ?>
    <h3 class="header"><?php echo $header; ?></h3>
    <?php } ?>
    <?php
	
	$field = get_sub_field_object('contact_form_inputs');
	$selected_inputs = get_sub_field('contact_form_inputs');
	$user = get_sub_field('who_will_get_sent_message');
	if(isset($user["ID"])) {
		$userid = $user["ID"];
	} else {
		$users_query = new WP_User_Query( array (
			'role'           => 'Administrator',
			'orderby'        => 'id',
		) );
		$results = $users_query->get_results();	
		foreach($results as $user){
			$userid = $user->ID;
		}
	}
	
	if(!empty($selected_inputs)){?>
        <div class="firmasite_acf_contact">
            <form name="firmasite_acf_contact_form" id="contact_me<?php echo $userid; ?>" class="" role="form">
                <input type="text" name="name" class="hidden" value="" />
                <?php if(in_array("name",$selected_inputs)) { ?>
                <div class="form-group">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="icon-user"></i></span>
                       <input type="text" name="yourname" class="form-control" value="" placeholder="<?php _e("Your Name", 'firmasite-base');?>" />
 		               <input type="hidden" name="selected_inputs[]" class="hidden" value="yourname" />
                    </div>
                </div>
                <?php } ?>
                <?php if(in_array("email",$selected_inputs)) { ?>
                <div class="form-group">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="icon-envelope"></i></span>
                       <input type="email" name="mail" value="" class="form-control" placeholder="<?php _e("Your E-Mail", 'firmasite-base');?>" />
 		               <input type="hidden" name="selected_inputs[]" class="hidden" value="email" />
                    </div>
                </div>
                <?php } ?>
                <?php if(in_array("phone",$selected_inputs)) { ?>
                <div class="form-group">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="icon-phone"></i></span>
                       <input type="tel" name="phone" class="form-control" value="" placeholder="<?php _e("Your Phone", 'firmasite-base');?>" />
 		               <input type="hidden" name="selected_inputs[]" class="hidden" value="phone" />
                    </div>
                </div>
                <?php } ?>
                <?php if(in_array("message",$selected_inputs)) { ?>
                <div class="form-group">
	                <textarea name="message<?php echo $userid; ?>" rows="5" class="form-control" placeholder="<?php _e("Your Message", 'firmasite-base');?>"></textarea>
					<input type="hidden" name="selected_inputs[]" class="hidden" value="message" />
                </div>
                <?php } ?>
                <input type="hidden" name="contact_url" class="hidden" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
                <input type="hidden" name="userid" class="hidden" value="<?php echo $userid; ?>" />
                <div id="node<?php echo $userid; ?>" class="fade"></div>
                <div id="success<?php echo $userid; ?>" class="hidden alert alert-success"><a class='close' data-dismiss='alert' href='#'>&times;</a><?php _e("Thank you for leaving a message", 'firmasite-base');?></div>
                <button class="btn btn-primary" type="submit"><i class="icon-share-alt"></i> <?php _e("Submit", 'firmasite-base');?></button>
            </form>
        </div>
		<script type="text/javascript">
        (function($) {
			$(document).on("click", ".firmasite_acf_contact .close", function(){
				$(window).trigger("resize");
			});
            $(document).ready(function() {
              $("#contact_me<?php echo $userid; ?>").submit(function() {
                var str = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "/wp-admin/admin-ajax.php",
                    data: "action=firmasite_acf_contact_form&"+str,
                    success: function(msg) {
                    $("#node<?php echo $userid; ?>").ajaxComplete(function(event, request, settings){
                        if(msg == "sent") {
                            $(".firmasite_acf_contact #node<?php echo $userid; ?>").hide();
                            $(".firmasite_acf_contact #success<?php echo $userid; ?>").removeClass("hidden").fadeIn("slow");
                            $(".firmasite_acf_contact").find("input,textarea").not(".hidden").val("");
                            $(window).trigger("resize");
                        }
                        else {
                            result = msg;
                            $(".firmasite_acf_contact #node<?php echo $userid; ?>").html(result).addClass("in");
                            $(window).trigger("resize");
                        }
                    })
                    }
                });
                return false;
                });
            });
        })(jQuery);
        </script>
        <?php
	}
	
	 //the_sub_field("text_block"); ?>
</div>
