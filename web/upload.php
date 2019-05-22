<?php
  $filename=uniqid('f_').'.'.$_GET['filetype'];
  $fileData=file_get_contents('php://input');
  if (!file_exists('imagesEvents')) {
    mkdir('imagesEvents', 0777, true);
  }
  $fhandle=fopen("imagesEvents/".$filename, 'wb');
  fwrite($fhandle, $fileData);
  fclose($fhandle);
  echo($filename);
?>