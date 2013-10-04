<?php
/*
* @package WordPress
* @subpackage ThemeGenerator
*/
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
	<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php	return; }
	if ( have_comments() ) : ?>
  <hr/>
	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=wts_comment'); ?>
	</ol>
	<div class="clear"></div>
  <div class="alignleft"><?php previous_comments_link() ?></div>
  <div class="alignright"><?php next_comments_link() ?></div>
<?php	else : endif; if ( comments_open() ) : comment_form(); endif;?>