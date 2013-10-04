<form action="<?php echo home_url(); ?>" method="get" name="s" id="searchform">
	<input name="s" class="s"  type="text" value="<?php echo __('Search...','tstranslate');?>" onclick="this.value='';"/>
	<input type="hidden" value="" name="themedemo" />
	<input type="submit" value="" id="searchsubmit" name="btn_search"/>
</form>      