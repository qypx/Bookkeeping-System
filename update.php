<?php

echo '<style>
body{
	background:url(https://thumbs.gfycat.com/EmbellishedPlaintiveIndianringneckparakeet-size_restricted.gif) no-repeat;
	background-size:cover;
}
</style>';

function _get($str){ 
$val = !empty($_GET[$str]) ? $_GET[$str] : null; 
return $val; 
} 

$id = _get('id');
$inout = _get('inOrOut');
$amount = _get('amount');
$categories = _get('categories');
$createTime = _get('createTime');
$description = _get('description');

$conn = mysqli_connect('localhost','root','') // your own password
    or die('Could not connect: ' . mysqli_error($conn));

mysqli_select_db($conn, 'AccountingSystem');

mysqli_query($conn,'set names utf8');


// form UPDATE statement
$sql = "update Accounting set inOrOut='$inout',amount='$amount',categories='$categories',createTime='$createTime',description= '$description' where id = $id";



// run the UPDATE statement
$result = mysqli_query($conn, $sql);
if($result && mysqli_affected_rows($conn))
	echo "update successfully <a href = 'chaxunxitong.php'><br>返回</a>";
else{ 
	echo "修改失败";
	echo "<br>";
	die('Query failed: '.mysqli_error($conn));
}
   
mysqli_close($conn);
?>
