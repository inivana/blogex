<?php
  $width = intval($_GET['width']);
  $height = intval($_GET['height']);

  if(!(is_int($width) AND is_int($height)))
  {
    exit($height);
  }
  
  $width = 1440;
  $height = 900;
  
  $image = new IMagick('media/images/menu.png');
  
  $geo = $image->getImageGeometry();
  
  $image->scaleimage(round($width * $geo['width'] / 1920),
                     round($height * $geo['height'] / 1080));

  $image->setImageFormat('png');
  header('Content-Type: image/png');
  exit($image);
?>