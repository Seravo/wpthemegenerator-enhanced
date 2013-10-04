<?php
// Echo the image - timestamp appended to prevent caching
echo '<img src="'.get_template_directory_uri().'/captcha/images/image.php?' . time() . '" width="132" height="46" alt="Captcha image" />';

?>