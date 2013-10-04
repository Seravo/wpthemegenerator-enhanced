<?php
/*
Template Name: Contact Form
*/
// Make the page validate
//@ini_set('session.use_trans_sid', '0');

// Include the random string file
require 'captcha/rand.php';

@session_start();

// Set the session contents
if (isset($_POST['captcha'])){
	if(strtolower($_POST['captcha'])!=strtolower($_SESSION['captcha_id'])){
		$_SESSION['captcha_id'] = $str;
	}
}
else{
	$_SESSION['captcha_id'] = $str;
}

add_action('wp_print_footer_scripts', 'tg_script_contact_execute', 20);
//If the form is submitted
if(isset($_POST['submitted'])) {
	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = __('You forgot to enter your name.', 'tstranslate');
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		//Check to make sure that the =subject field is not empty
		if(trim($_POST['subject']) == '') {
			$subjectError = __('You forgot to enter the subject.', 'tstranslate');
			$hasError = true;
		} else {
			$nameSub = trim($_POST['subject']);
		}
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === ''){
			$emailError = __('You forgot to enter your email address.', 'tstranslate');
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))){
			$emailError = __('You entered an invalid email address.', 'tstranslate');
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
		//Check to make sure sure that a valid captcha is submitted
		if(trim($_POST['captcha']) === ''){
			$captchaError = __('You didn&acute;t type the captcha.', 'tstranslate');
			$hasError = true;
		} else if (strtolower($_SESSION['captcha_id']) != strtolower($_POST['captcha'])){
			$captchaError = __('You entered an invalid captcha.', 'tstranslate');
			$hasError = true;
		} else {
			$_SESSION['captcha_id'] = $str;
		}
		//Check to make sure comments were entered
		if(trim($_POST['comments']) === ''){
			$commentError = __('You forgot to enter your comments.', 'tstranslate');
			$hasError = true;
		} else {
			if(function_exists('stripslashes')){
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
		//If there is no error, send the email
		if(!isset($hasError)){
			$emailTo = get_option('themeshock_contact_mail');
			$name = trim($_POST['contactName']);
			$subject = trim($_POST['subject']);
			$sendCopy = trim($_POST['sendCopy']);
			$body = "Name: $name \n\nEmail: $email \n\nMessage: $comments";
			$headers = "From: $name <$email>" . "\r\n" . 'Reply-To: ' . $email;
			wp_mail($emailTo, $subject, $body, $headers);	
			$emailSent = true;
		}
	}
} 

get_header();
wts_tool_panel('end-layout-3');	wts_tool_panel('layout-4');
?>
<style>
	.errorFormat{
		border:1px #B94A48 solid;
		-webkit-box-shadow: 0 0 6px #F8B9B7;
		-moz-box-shadow: 0 0 6px #F8B9B7;
		-ms-box-shadow: 0 0 6px #F8B9B7;
		-o-box-shadow: 0 0 6px #F8B9B7;
	}
</style>
<div class="wrapper_content">
  	<div class="lay_base content_pattern"></div>
  	<div class="bar_separate footer_separate"></div>
  	<div class="lay_base content_shadow"></div>
		<div id="content">
			<?php 
		  		 get_template_part('sb1');
		  	?>
			<div class="main_content">
	    		<div class="blog_boxes <?php echo wts_main_boxes();?>">
	        	<div class="container_posts_pieces">
	          	<div class="post_corner post_top_left"><div class="post_token_left"></div></div>
	          	<div class="post_topbottom post_top_center"></div>
	          	<div class="post_corner post_top_right"><div class="post_token_right"></div></div>
	          	<div class="post_sides post_middle_left"></div>
	          	<div class="post_center post_content">  
				<div class="contact_form">
					<h1 class="text-left form_title"><?php the_title(); ?></h1>
					<?php if ( $_SERVER['HTTP_HOST']==='www.wpthemegenerator.com'):?>
						<p class="info_tg">	This is a sample contact form that shows how the contact form will look in our themes, if you have questions please use this <a href="http://www.wpthemegenerator.com/contact/">contact form</a></p>		        
					<?php
					endif;      
				 	if(isset($emailSent) && $emailSent == true) {?>
	      			<div class="thanks">
				        <h1 class="text_left info_tg" style="padding:0 21px;"><?php echo __('Thanks','tstranslate'); $name;?></h1>
				        <p class="info_tg"><?php echo __('Your email was successfully sent. I will be in touch soon.','tstranslate');?></p>
				    </div>
				    <?php } else {
						if (have_posts()) : while (have_posts()) : the_post(); 
							if(isset($hasError) || isset($captchaError)) { ?>
				      			<p class="info_tg error" style="display:none;"><?php echo __('There was an error submitting the form.','tstranslate');?><p>
				        <?php } ?>
					    <form method="post" action="<?php the_permalink();?>" id="contactForm" class="contactForm">
					        <div id="contact_us" align="center">
					            <div class="nameInput">
					            	<input name="contactName" type="text" class="requiredField form_box_2" id="contactName" data-h5-errorid="nameError" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" size="30" placeholder="Name..." required/>
					            	<span class="error" id="nameError" style="display:none;position: absolute;right: -3px;top: 30px;">This Field Is Required.</span>
					            </div>
					            <?php if($nameError != '') {?>
					                <span class="error"><?php echo $nameError;?></span>
					            <?php } ?>
					            <div class="emailInput">
					            	<input type="email" name="email" id="email" data-h5-errorid="emailError" pattern="([a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email form_box_2" size="30" placeholder="Email..." required/>
					            	<span class="error" id="emailError" style="display:none;position:absolute;right:-3px;top:30px;">Pls, Insert A Correct Email.</span>
					            </div>
					            <?php if($emailError != ''){?>
					                <span class="error" id="emailError" style="display:none;"><?php echo $emailError;?></span>
					            <?php }?>
					            <div class="subjectInput">
					            	<input type="text" name="subject" id="subject" data-h5-errorid="subjectError" value="<?php if(isset($_POST['subject']))  echo $_POST['subject'];?>" class="requiredField subject form_box_4" size="30" placeholder="Subject..." required/>
					            	<span class="error" id="subjectError" style="display:none;position:absolute;right:-3px;top:30px;">This Field Is Required.</span>
					            </div>
					            <?php if($subjectError != ''){?>
					                <span class="error"><?php echo $subjectError;?></span>
					            <?php }?>
					            <div class="textInput" <?php echo (get_option('themeshock_main_address')!='')?'':'style="width:98%;"' ?>>
					            	<textarea name="comments" id="commentsText" rows="10" cols="80" data-h5-errorid="textError" class="requiredField" placeholder="Type your message here..." required><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
					            	<span class="error" id="textError" style="display:none;position:absolute;right:-3px;bottom:12px;">Insert Your Comment or Suggestion.</span>
					            </div>
					        	<div id="map_canvas" class="iframe" style="border: 2px #CECECE solid;display:<?php echo (get_option('themeshock_main_address')!='')?'inline-block':'none' ?>;background: #797979;border-radius: 4px;box-shadow: 0 7px 7px -7px #797979;width:300px; height:290px;"></div>
					        	<div class="clear"></div>
					            <?php if($commentError != '') {?>
					                <span class="error"><?php echo $commentError;?></span>
					            <?php }?>
					            <!-- <strong>Captcha</strong> -->
					            <label for="captcha"><?php __('Enter the characters as seen on the image below (case sensitive):','tstranslate');?></label>
					            <div id="captchaimage">
					                <img src="<?php echo get_template_directory_uri(); ?>/captcha/images/image.php?<?php echo time(); ?>" width="132" height="46" alt="Captcha image" />
					            </div>
					            <div class="captcha_reload"><span class="tgicon-refresh reload_captcha" title="Click me! To Reload Captcha"></span></div>
					            <div class="captchaInput" style="display:inline-block">
					            	<input type="text" maxlength="6" name="captcha" id="captcha" data-h5-errorid="captchaError" required/>
					            	<span class="error" id="captchaError" style="display:none;position:absolute;right:-95px;top:34px;">Required.</span>
					            </div>
					            <?php if($captchaError != '') {?>
					                <span class="error"><?php echo $captchaError;?></span>
					                <script>
					                	jQuery(function(){
					                		jQuery('#captcha').addClass('errorFormat');
					                		jQuery('#captcha').parent().append('<span class="invCaptcha">Invalid Captcha.</span>');
					                		jQuery('#captcha').click(function(){
					                			jQuery('.invCaptcha').hide();
					                		})
					                	});
					                </script>
					            <?php }?>
					            <!-- <label for="checking" class="screen"><?php echo __('If you want to submit this form, do not enter anything in this field','tstranslate');?></label> --><!-- 
					            <div class="clear"></div> -->
					            <!-- <input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /> -->
					            <input type="submit" name="submit" id="submit" class="sended" value="<?php echo __('Send','tstranslate');?>"/>
					            <input type="hidden" name="submitted" id="submitted" value="true" />
					        </div>
					    </form>
	      			<?php endwhile;  endif; }?>
    			</div><!-- end contact form -->
		   		</div>
		        <div class="post_sides post_middle_right"></div>
		        <div class="post_corner post_bottom_left"></div>
		        <div class="post_topbottom post_bottom_center"></div>
		        <div class="post_corner post_bottom_right"></div>
		        </div><!-- end container_posts_pieces -->
		        <div class="post_token_bottom"></div>
      		</div><!-- end blog_boxes -->
  		</div><!--end main content-->
		<?php
		  	 get_template_part('sb2');
		?>    
  	<div class="clear"></div>
	</div><!-- content -->
</div><!-- end wrapper content -->
<?php get_footer();?>