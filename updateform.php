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

$conn = mysqli_connect('localhost','root','') // your own password
    or die('Could not connect: ' . mysqli_error($conn));

mysqli_select_db($conn, 'AccountingSystem');

mysqli_query($conn,'set names utf8');


$sql = "select * from Accounting where id =$id";
$obj = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($obj);
?>


<form action="update.php?">
	<!--用隐藏式来获取id-->
	<input type="hidden" name="id" value = "<?php echo $id;?>" />
	<table border = 0 cellpadding="10" cellspacing="0">
		<tr><td>编号：</td><td><?php echo $row["id"];?></td></tr>
		<tr><td>收入/支出：</td><td><input type="text" name = "inOrOut" value= '<?php echo $row['inOrOut'];?>' /></td><td>can only choose from "IN" or "OUT"</td></tr>
		<tr><td>金额：</td><td><input type='text' name = 'amount' value='<?php echo $row['amount'];?>'/></td></tr>
		<tr><td>种类：</td><td><input type="text" name="categories" value="<?php echo $row["categories"];?>" /></td><td>can only choose from "grocery","bill","rent","entertainment","other"</td></tr>
		<tr><td>时间：</td><td><input type="text" name="createTime" value="<?php echo $row["createTime"];?>" /></td></tr>
		<tr><td>描述：</td><td><input type="text" name="description" value="<?php echo $row["description"];?>" /><br />
		<tr><td colspan="2" align="center"><input type="submit" name="" value="submit" /></td></tr>
	</table>
</form>


