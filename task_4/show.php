<?php
    $pathFull = './images/fullsize/';
    $text = 'Salvador Dali Museum';
    $font = 'dali.ttf';
    // $ass = $_GET['image'];
    // print_r($ass);
    list($w, $h, $type, $attr) = getimagesize($pathFull . $_GET["pic"]); 
    switch ($type) {
        case 2:
            header('Content-Type: image/jpeg');
            $im = imagecreatefromjpeg($pathFull . $_GET["pic"]);
            $white = imagecolorallocate($im, 255, 255, 255);
            imagettftext($im, 70, 45, $w/3, $h/1.5, $white, $font, $text);
            imagejpeg($im);
            imagedestroy($im);
            break;
        case 3:
            header('Content-Type: image/png');
            $im = imagecreatefrompng($pathFull . $_GET["pic"]);
            $white = imagecolorallocate($im, 255, 255, 255);
            imagettftext($im, 70, 45, $w/3, $h/1.5, $white, $font, $text);
            imagepng($im);
            imagedestroy($im);
            break;
    }
?>