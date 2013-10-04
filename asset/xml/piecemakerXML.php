<?php 
	require_once('../../../../../wp-load.php' );
	$twentype=get_option('themeshock_pm_tweenType');
	$autoplay=get_option('themeshock_pm_autoplay');
	$img_sliders=get_option('themeshock_img_slider');
?>
<?php 
	header("Content-type: text/xml");
	echo '<?xml version="1.0" encoding="utf-8" ?>
	<Piecemaker>
		<Settings>
		<imageWidth>900</imageWidth>
		<imageHeight>346</imageHeight>
		<segments>7</segments>
			<tweenTime>1.2</tweenTime>
			<tweenDelay>0.1</tweenDelay>
			<tweenType>'.$twentype.'</tweenType>
			<zDistance>0</zDistance>
			<expand>20</expand>
			<innerColor>0x111111</innerColor>
			<textBackground>0x0064C8</textBackground>
			<shadowDarkness>100</shadowDarkness>
			<textDistance>25</textDistance>
			<autoplay>'.$autoplay.'</autoplay>
			<playshow>1</playshow>
		</Settings>
		'.
		$img_sliders
		.'
	</Piecemaker>';
?>

