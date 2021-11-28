<?php

function UploadImage($file,$temp,$sysid){



$target_dir = "images/"; //path
$target_file = $target_dir.$sysid."_".basename($file["name"]); //file
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



if($imageFileType === "jpg" || $imageFileType === "png" || $imageFileType === "jpeg" || $imageFileType === "pdf") {



if (move_uploaded_file($temp, $target_file))
return false;



else
{
return false;
}
}
else
{
return false;
}
return false;
}
?>