<?php
function formatSizeUnits($strbytes)
    {
    		$bytes = (int)$strbytes;
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}


// (A) FILE CHECK
$result = "";
if (!isset($_FILES['upfile']['tmp_name'])) {
  $result = "Нет загруженных файлов";
}

if (exif_imagetype($_FILES['upfile']['tmp_name']) != IMAGETYPE_WEBP) /*&& 
    (exif_imagetype($_FILES['upfile']['tmp_name']) != IMAGETYPE_JPEG) &&
    (exif_imagetype($_FILES['upfile']['tmp_name']) != IMAGETYPE_PNG) &&
    (exif_imagetype($_FILES['upfile']['tmp_name']) != IMAGETYPE_BMP) &&
    (exif_imagetype($_FILES['upfile']['tmp_name']) != IMAGETYPE_GIF)*/ 

 {
    echo '- у этого файла неправильный формат';
	die();
}

// (B) IS THIS A VALID IMAGE?
if ($result=="") {
  /* $allowed = ["bmp", "gif", "jpg", "jpeg", "png", "webp"]; */
  $allowed = ["webp"];
  $ext = strtolower(pathinfo($_FILES["upfile"]["name"], PATHINFO_EXTENSION));
  if (!in_array($ext, $allowed)) {
    /*$result = "$ext у этого файла неправильный формат - " . $_FILES["upfile"]["name"];*/
	echo " - у этого файла неправильный формат";
	die();
  }
}

// (C) MOVE UPLOADED FILE OUT OF TEMP FOLDER
$hash = uniqid('webp2jpg_');
if (!file_exists(__DIR__.'/uploads/'.$hash)) {
    mkdir(__DIR__.'/uploads/'.$hash, 0777, true);
}

if ($result=="") {
	$source = $_FILES["upfile"]["tmp_name"];
	$destination = $_FILES["upfile"]["name"];

	move_uploaded_file($source, __DIR__.'/uploads/'.$hash.'/'.$destination);
}


// (D) SERVER RESPONSE
$fileformat = pathinfo($_FILES['upfile']['name'], PATHINFO_EXTENSION);


switch ($fileformat) {
  case "webp":
    $im = imagecreatefromwebp(__DIR__.'/uploads/'.$hash.'/'.$_FILES["upfile"]["name"]);
    break;
  /* case "jpeg":
    $im = imagecreatefromjpeg(__DIR__.'/uploads/'.$hash.'/'.$_FILES["upfile"]["name"]);
    break;
  case "png":
    $source = imagecreatefrompng(__DIR__.'/uploads/'.$hash.'/'.$_FILES["upfile"]["name"]);
    $image = imagecreatetruecolor(imagesx($source), imagesy($source));
    $white = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $white);
    imagecopy($image, $source, 0, 0, 0, 0, imagesx($image), imagesy($image));
    imagejpeg($image, $im, $quality);
    imagedestroy($image);
    imagedestroy($source);
    
    $white = imagecreatefrompng(__DIR__.'/uploads/'.$hash.'/'.$_FILES["upfile"]["name"]);
    $im = imagecolorallocate($white,  255, 255, 255);
    break;
  case "gif":
    $im = imagecreatefromgif(__DIR__.'/uploads/'.$hash.'/'.$_FILES["upfile"]["name"]);
    break;
  case "bmp":
    $im = imagecreatefrombmp(__DIR__.'/uploads/'.$hash.'/'.$_FILES["upfile"]["name"]);
    break; */
  default:  
    echo "Неправильный формат!";
    break;
} 

if ($im) {

 	echo "";
	// Сконвертировать его в jpeg-файл со 100%-качеством
	imagejpeg($im, __DIR__.'/uploads/'.$hash.'/'.pathinfo($_FILES['upfile']['name'], PATHINFO_FILENAME).'.jpg', 100);
	$newsize = filesize(__DIR__.'/uploads/'.$hash.'/'.pathinfo($_FILES['upfile']['name'], PATHINFO_FILENAME).'.jpg');
	$sizevalue = formatSizeUnits($newsize);
	echo $result=="" ? "
	<span class='fileslist__status fileslist__status_success'>Готово!</span>
	 <span class='fileslist__resize'>$sizevalue</span>" : $result ;

	imagedestroy($im);

	echo "<a class='filelist__button' download href='".'/uploads/'.$hash.'/'.pathinfo($_FILES['upfile']['name'], PATHINFO_FILENAME).".jpg'>Скачать файл</a>";

}
else {
	echo "Ошибка! Что-то пошло не так...";
  echo "<br/>";
}




