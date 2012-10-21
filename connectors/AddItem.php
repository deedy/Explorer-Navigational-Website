<?php

$url=htmlentities($_POST['itemurl']);
 $ext = end(explode(".",strtolower(basename($url))));
// echo $url."<br>";
$parent=".".htmlentities($_POST['parent'])."/";
$name=htmlentities($_POST['itemname']);

if (strlen($name)==0) {
	$name=substr($url,strripos($url,"/")+1);
	$name=substr($name,0,-strlen($ext)-1);
}
//$ext=substr($url,strripos($url, "."));
// echo $parent."<br>";

if($url){
$file = fopen($url,"rb");
if($file){
$directory = $parent; // Directory to upload files to.
$newfile = fopen($directory.$name.".".$ext, "wb"); // creating new file on local server
if($newfile){
while(!feof($file)){
// Write the url file to the directory.
fwrite($newfile,fread($file,1024 * 8),1024 * 8); // write the file to the new directory at a rate of 8kb/sec. until we reach the end.
}
echo 'File uploaded successfully! You can access the file here:'."\n";
echo ''.$directory.$name.".".$ext.'';
echo "<script type=\"text/javascript\">";
echo "alert(\"File uploaded successfully! You can access the file here:".$directory.$name.".".$ext."\");";
echo "window.history.back(-1);";
  echo "</script>";

} else { echo 'Could not establish new file ('.$directory.$name.".".$ext.') on local server. Be sure to CHMOD your directory to 777.'; }
} else { echo 'Could not locate the file: '.$url.''; }
} else { echo 'Invalid URL entered. Please try again.'; }



?>
