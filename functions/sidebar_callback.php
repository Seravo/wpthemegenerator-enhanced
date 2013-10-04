<?php 
	if (isset($_POST['sidepos'])){
		ob_start();
		get_header();
		ob_get_clean();		
		$pos=$_POST['sidepos'];
		$width=(int)$_POST['width'];
		$style=($width===0)?'':'style="width:'.$width.'px;"';
		$position=substr($pos,0,-(strlen($pos)-strpos($pos,'_')));
		echo ($position==="Bottom")?'<div class="clear"></div>':'';
		?>
        <div class="sidebar_<?php echo  ($position==="Bottom")?'down':strtolower($position);  ?>"  data-pos="<?php echo $pos; ?>" <?php echo $style;?> >
            <?php
				widget_style($pos,'023');
			?>
        </div>
        <?php
		exit;
	}else{
		// ob_flush();		
		ob_start("ob_gzhandler");
		get_header();
	}
?>