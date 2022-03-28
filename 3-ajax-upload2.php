<?php
// (A) FILE CHECK
$result = "";
if (!isset($_FILES['upfile2']['tmp_name'])) {
  $result = "Нет загруженных файлов";
}

if (exif_imagetype($_FILES['upfile2']['tmp_name']) != IMAGETYPE_JPEG) {
  echo 'Это не изображение формата jpg / jpeg!';
	die();
}

// (B) IS THIS A VALID IMAGE?
if ($result=="") {
  $allowed = ["jpg", "jpeg"];
  $ext = strtolower(pathinfo($_FILES["upfile2"]["name"], PATHINFO_EXTENSION));
  if (!in_array($ext, $allowed)) {
    /*$result = "$ext у этого файла неправильный формат - " . $_FILES["upfile"]["name"];*/
	echo " - у этого файла неправильный формат";
	die();
  }
}

// (C) MOVE UPLOADED FILE OUT OF TEMP FOLDER
if ($result=="") {
	$source = $_FILES["upfile2"]["tmp_name"];
	$destination = $_FILES["upfile2"]["name"];
	move_uploaded_file($source, __DIR__.'/uploads/'.$destination);
}


// (D) SERVER RESPONSE
echo $result=="" ? "OK <br/>" : $result ;


$im_jpg = imagecreatefromjpeg(__DIR__.'/uploads/'.$_FILES["upfile2"]["name"]);
if ($im_jpg) {

 	echo "<br/>";
	// Сконвертировать его в jpeg-файл со 100%-качеством
	imagewebp($im_jpg, __DIR__.'/uploads/'.basename($_FILES["upfile2"]["name"],".".$ext).'.webp', 85);
	imagedestroy($im_jpg);

	echo "<a download href='".'/uploads/'.basename($_FILES["upfile2"]["name"],".".$ext).".webp'>".basename($_FILES["upfile2"]["name"],".".$ext).".webp"."</a>";

}
else {
	echo "Ошибка! Что-то пошло не так...";
  echo "<br/>";
}


