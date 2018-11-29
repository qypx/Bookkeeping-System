<?php

echo '<style>
body{
	background:url(https://thumbs.gfycat.com/EmbellishedPlaintiveIndianringneckparakeet-size_restricted.gif) no-repeat;
	background-size:cover;
}
</style>';


$conn = mysqli_connect('localhost','root','') // your own password
    or die('Could not connect: ' . mysqli_error($conn));

mysqli_select_db($conn, 'AccountingSystem');

mysqli_query($conn,'set names utf8');


// form DELETE statement
function _get($str){ 
$val = !empty($_GET[$str]) ? $_GET[$str] : null; 
return $val; 
} 

$id = _get('id');
$sql = "delete from Accounting where id = $id";

// run the DELETE statement
$result = mysqli_query($conn, $sql);
if($result && mysqli_affected_rows($conn))
	echo "delete successfully <a href = 'chaxunxitong.php'><br>返回</a>";
else
	echo "删除失败";

mysqli_close($conn);
?>
