<?php

echo'<style>
body{
	background:url(https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1542947427309&di=5c98265810629f9a2f653bff26ec8716&imgtype=0&src=http%3A%2F%2Fimg.zcool.cn%2Fcommunity%2F016555568644026ac7251bb6c50814.jpg%401280w_1l_2o_100sh.jpg) no-repeat;
	background-size:cover;
}
</style>';

echo '<h2>';
echo '<center>';
echo 'Group by week';
echo '</center>';
echo '</h2>';

$conn = mysqli_connect('localhost','root','') // your own password
    or die('Could not connect: ' . mysqli_error($conn));

mysqli_select_db($conn, 'AccountingSystem');

mysqli_query($conn,'set names utf8');


// form SQL statement
$sql = "select subdate(createTime,date_format(createTime,'%w')-1) AS fromDate, subdate(createTime,-(7-date_format(createTime,'%w'))) AS toDate, inOrOut, FORMAT(sum(amount),2) AS totalAmount
from Accounting
group by date_format(createTime,'%v'), inOrOut";

$result = mysqli_query($conn,$sql);

echo "<center>";
echo "<table border = 1 cellspacing = '0' cellpadding = '10'>";
echo "<th>fromDate</th><th>toDate</th><th>in/out</th><th>totalAmount(AUD)</th>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
            echo '<td>'.$row['fromDate'].'</td>';
            echo '<td>'.$row['toDate'].'</td>';
            echo '<td>'.$row['inOrOut'].'</td>';
            echo '<td>'.$row['totalAmount'].'</td>';
        echo "</tr>";
    }
   

echo "</table>";

// net
echo "<br>";
echo "<h3>";
echo "net";
echo "</h3>";


$sql = "select subdate(createTime,date_format(createTime,'%w')-1) AS fromDate, subdate(createTime,-(7-date_format(createTime,'%w'))) AS toDate,
FORMAT(sum(IF (inOrOut = 'OUT', -amount,amount)),2)
as net
from Accounting
group by date_format(createTime,'%v')";

$result = mysqli_query($conn,$sql);

echo "<table border = 1 cellspacing = '0' cellpadding = '10'>";
echo "<th>fromDate</th><th>toDate</th><th>net(AUD)</th>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
            echo '<td>'.$row['fromDate'].'</td>';
            echo '<td>'.$row['toDate'].'</td>';
            echo '<td>'.$row['net'].'</td>';
        echo "</tr>";
    }
   

echo "</table>";

echo "<br>";
echo "<a href = 'chaxunxitong.php'> 返回</a>";
echo "</center>";


mysqli_close($conn);

?>
