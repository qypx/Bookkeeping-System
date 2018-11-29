<html>
    <head>
        <meta charset="UTF-8">
        <title>查询系统</title>
    </head>
    <!--
    <body bgcolor="#ECFFFF"> 

    	
    </body>
-->
</html>
    	



<?php


 echo '<style>
 body{
    background: url(https://img.zcool.cn/community/0144335686440332f8759f04eae086.jpg@2o.jpg) no-repeat;
    background-size:cover;
}
</style>';

header ( "Content-type:text/html;charset=utf-8" ); 
print '<h1> 记账系统 </h1>';



$conn = mysqli_connect('localhost','root','')// your own password
    or die('Could not connect: ' . mysqli_error($conn));
    
mysqli_select_db($conn, 'AccountingSystem');

print '<p> connect successfully </p>';

mysqli_query($conn,'set names utf8');







// perform SQL query
$query = 'SELECT id, inOrOut, FORMAT(amount,2) AS amount, categories, createTime, description
FROM Accounting';

//发送sql语句
$result = mysqli_query($conn,$query) or die('Query failed: '.mysqli_error($conn));
    


//$result = $conn -> query( $query ); 
//$row = $result -> fetch_row(); //取一行数据 
//while($row = $result -> fetch_row()){
//	echo "row: ".$row[0]." in/out: ".$row[1]." amount: ".$row[2]."<br />";
//}
//echo $row[0]; //输出第一个字段的值 


/*
while($row = $result -> fetch_row()){
 echo '<tr>';
        echo '<td>'.$row[0].'</td>';
        echo '<td>'.$row[1].'</td>';
        echo '<td>'.$row[2].'</td>';
        echo '<td></td>';
    echo '</tr>';
}
*/

/*
print "<table>\n";
print "<td> row </td>\n";
print "<td> in/out </td>\n";
print "<td> amount </td>\n";
print "<td> categories </td>\n";
print "<td> create time </td>\n";
print "<td> description </td>\n";
while($line = $result->fetch_row()){
	print "\t<tr>\n";
	foreach ($line as $col_value) {
		print "\t\t<td>$col_value</td>\n";
	}
	print "\t</tr>\n";
}
print "</table>\n";
*/

?>

<html>
<style type="text/css">
div 
{


height:700px;
overflow: scroll;
}

</style>

<div  style="overflow-y: auto; overflow-x: hidden;">
<?php
echo "<center>";
echo "<table border = 1 cellspacing = '0' cellpadding = '10'>";
echo "<th>编号</th><th>收入/支出</th><th>金额(AUD)</th><th>种类</th><th>时间</th><th>描述</th><th>操作</th>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
            echo '<td>'.$row['id'].'</td>';
            echo '<td>'.$row['inOrOut'].'</td>';
            echo '<td>'.$row['amount'].'</td>';
            echo '<td>'.$row['categories'].'</td>';
            echo '<td>'.$row['createTime'].'</td>';
            echo '<td>'.$row['description'].'</td>';
            echo '<td><a href = "delete.php?id='.$row['id'].'">删除</a>/<a href = "updateform.php?id='.$row['id'].'">修改</a></td>';
        echo "</tr>";
    }
    
echo "</table>";
// echo "<a href = 'test.php'>添加</a>";
echo "</center>";
?>
</div>

</html>

<?php


//insert

echo "<br>";
echo '<h3> 添加数据:</h3>';


echo '<form action="insert.php" method = "get">';
echo "<table border = 0 cellspacing = '10' cellpadding = '0'>";
echo '<tr><td>编号：</td><td> <input type = "text" name = "id" placeholder = "接着最后一个编号往后填"/> </td></tr>';
echo '<tr><td>收入/支出： </td><td><input type = "radio" name = "inOrOut" value = "IN" />IN';
echo '<input type = "radio" name = "inOrOut" value = "OUT"/>OUT</td></tr>';
echo '<tr><td>金额(AUD)： </td><td><input type = "text" name = "amount" value = "" /> </td></tr>';
echo '<tr><td>种类： </td><td><input type = "radio" name = "categories" value = "grocery" /> grocery';
echo '<input type = "radio" name = "categories" value = "bill" /> bill';
echo '<input type = "radio" name = "categories" value = "rent" /> rent';
echo '<input type = "radio" name = "categories" value = "entertainment" /> entertainment';
echo '<input type = "radio" name = "categories" value = "other" /> other </td></tr>';
echo '<tr><td>时间： </td><td><input type = "text" name = "createTime" placeholder = "yyyy-mm-dd" /></td></tr>';
echo '<tr><td>描述： </td><td><input type = "text" name = "description" placeholder = "可为空" /></td></tr>';
echo '<br>';
echo '<tr><td colspan = 2><input type = "submit" value = "add to database" /></td></tr>';
echo '</table>';
echo '</form>';


// 按时间查询
echo '<h3> 汇总:</h3>';

echo "<a href = 'groupbyweek.php'> 按周汇总 </a>";
echo "<br>";
echo "<a href = 'groupbymonth.php'> 按月汇总 </a>";
echo "<br>";
echo "<a href = 'groupbyyear.php'> 按年汇总 </a>";




// 按种类+时间查询
echo "<br>";
echo "<h3> 按种类+时间查询</h3>";
echo '<form action="category_time.php" method="post">';  

echo '种类: ';
echo '<select name="category">';
echo '<option value="">请选择</option>';
echo '<option value="grocery">grocery</option>';
echo '<option value="bill">bill</option>';
echo '<option value="rent">rent</option>';
echo '<option value="entertainment">entertainment</option>';
echo '<option value="other">other</option>';
echo '</select>'; 

echo ' 时间: '; 
echo '<select name="time">';
echo '<option value="">请选择</option>';
echo '<option value="按周">按周</option>';
echo '<option value="按月">按月</option>';
echo '<option value="按年">按年</option>';
echo '</select>'; 
echo '<input type="submit" value="查询" />';
echo '</form>';

// 关闭连接
mysqli_close($conn);


echo '<br>';
echo '<br>';
?>



<?php
echo "<center>";
echo "Copyright ";

?>
&copy; 
2018-<?php echo date("Y"); ?>
<?php 
echo " RuiqiZ";
echo "</center>";
?>


