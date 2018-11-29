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

//获取添加的数据信息

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


// form the INSERT statement from the user's input
$sql = "insert into Accounting values('$id','$inout','$amount','$categories','$createTime','$description')";

// run the INSERT statement
if(!mysqli_query($conn,$sql))
	die ('Error: '.mysqli_error($conn));

// print friendly message
echo "1 record added <a href = 'chaxunxitong.php'><br>返回</a>";

// 关闭连接
mysqli_close($conn);
?>
