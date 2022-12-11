<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <style>
        .image_class{
            border-radius: 5px;
        }
        .container{
            max-width: 1100px;
            max-height: 500px;
            margin: 0 auto;
            display:flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
        }
        .image_link:hover{
            transform: scale(1.05, 1.05);
            background: #E89020;
            /* box-shadow: inset 0 0 0 2px #DC582A; */
            transition: all .3s ease-in-out;
        }
        .image_link{
            padding: 20px;
            display: center;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            border: 5px solid #FEFBF0;
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
            transition: all .5s ease-in-out;
        }
        h1 {
            font-family: sans-serif;
            font-size: 42pt;
            color: #DC582A;
        }
    </style>
</head>

<body>
    <h1 align="center"> Salvador Dali Museum </h1>
    <?php
        /**
         * Get list of files in current directory
         */
        function getArray($dir) {
            $raw = scandir($dir);
            $files = array_diff($raw, array('.', '..'));
            return $files;
        }
        
        /**
         * Supporting function for image cut, does resize
         */
        function resampleImage($image, $width, $height) {
            $target = imagecreatetruecolor(300, 300);
                if ( 1 > $width / $height) {
                    imagecopyresampled($target, 
                                       $image, 
                                       (300 - (300 * $width / $height)) / 2,
                                       0, 
                                       0, 
                                       0, 
                                       300 * $width / $height, 
                                       300, 
                                       $width, 
                                       $height);
                } else {
                    imagecopyresampled($target,
                                       $image,
                                       0,
                                       (300 - (300 * $height / $width)) / 2,
                                       0,
                                       0,
                                       300,
                                       300 * $height / $width,
                                       $width,
                                       $height);
                }
            return $target;
        }

        /**
         * General function for image cut
         */
        function cutImage($fileName, $pathFull, $pathCut) {

            list($w, $h, $type, $attr) = getimagesize($pathFull . $fileName);
            switch ($type) {
                case 2: // PNG
                    $img = @imagecreatefromjpeg($pathFull.$fileName);
                    $target = resampleImage($img, $w, $h);
                    imagejpeg($target, $pathCut . $fileName);
                    imagedestroy($img);
                    imagedestroy($target);
                case 3: // JPEG
                    $img = @imagecreatefromjpeg($pathFull.$fileName);
                    $target = resampleImage($img, $w, $h);
                    imagejpeg($target, $pathCut . $fileName);
                    imagedestroy($img);
                    imagedestroy($target);
            }
        }

        /**
         * Check paths and existence of cut and fullsize images
         */
        function checkPaths($arrayCut, $arrayFull, $pathCut, $pathFull) {
            foreach($arrayCut as $imageCut) {
                if (!file_exists($pathFull.str_replace('cut_', '', $imageCut)) 
                    && file_exists('./images/cut/' . $imageCut)) {
                        unlink('./images/cut/' . $imageCut);
                }
            }
            unset($imageCut);

            // Also check upload time
            foreach ($arrayFull as $imageFull) {
                if (file_exists($pathFull . $imageFull)) {
                    if (file_exists($pathCut . $imageFull)) {
                        if (filectime($pathFull . $imageFull) < filectime($pathCut . $imageFull)) {
                        } else {
                            cutImage($imageFull, $pathFull, $pathCut);
                        }
                    } else {
                        cutImage($imageFull, $pathFull, $pathCut);
                    }
                }
            }
            unset($imageFull);
        }


        if (!is_dir(__DIR__ . '/images/fullsize')) {
            mkdir(__DIR__ . '/images/fullsize');  
        }
        if (!is_dir(__DIR__ . '/images/fullsize/')) {
            echo 'Gallery is empty';
            exit();
        }

        $dirFull = __DIR__ . '/images/fullsize';
        $dirCut =  __DIR__ . '/images/cut';

        $pathCut = './images/cut/cut_';
        $pathFull = './images/fullsize/';

        $arrayCut = getArray($dirCut);
        $arrayFull = getArray($dirFull);
        checkPaths($arrayCut, $arrayFull, $pathCut, $pathFull);
        
        echo '<div class="container">';
        foreach($arrayFull as $image){
            echo '<a href="show.php?pic=' . $image . '" target="_blank" class="image_link">';
            echo '<img src="'. $pathCut . $image . '" alt="Pic" class="image_class"/>';
            echo '</a>';
        }
        echo '</div>';

    ?>
</body>
</html>