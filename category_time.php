<?PHP

echo '<style>
body{
    background:url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_SfQ-OIwXBHA4TTkJpuEyxc2Zb-0AfvIUovYGDvC3Yp1EovzS_g) no-repeat;
    background-size:cover;
}
</style>';


if($_POST){
$cat = $_POST["category"];
$time = $_POST["time"];
}


echo "<center>";
echo "<h1> $cat </h1>";
echo "</center>";



$conn = mysqli_connect('localhost','root','') // your own password
    or die('Could not connect: ' . mysqli_error($conn));

mysqli_select_db($conn, 'AccountingSystem');

mysqli_query($conn,'set names utf8');

// form and run the sql query


if($time == '按周'){
$sql = "select subdate(createTime,date_format(createTime,'%w')-1) AS fromDate, subdate(createTime,-(7-date_format(createTime,'%w'))) AS toDate, inOrOut, FORMAT(sum(amount),2) AS totalAmount
from Accounting
where categories = '$cat'
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

if($cat != 'grocery'){
// net
echo "<br>";
echo "<h3>";
echo "net";
echo "</h3>";

$sql = "select subdate(createTime,date_format(createTime,'%w')-1) AS fromDate, subdate(createTime,-(7-date_format(createTime,'%w'))) AS toDate,
FORMAT(sum(IF (inOrOut = 'OUT', -amount,amount)),2)
as net
from Accounting
where categories = '$cat'
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
   

echo "</table>";}

echo "<br>";
echo "<a href = 'chaxunxitong.php'> 返回</a>";
echo "</center>";}

else if($time == '按月'){
	$sql = "select year(createTime) AS year,month(createTime) AS month, inOrOut,FORMAT(sum(amount),2) AS totalAmount
from Accounting
where categories = '$cat'
group by year(createTime),month(createTime),inOrOut";

$result = mysqli_query($conn,$sql);

echo "<center>";
echo "<table border = 1 cellspacing = '0' cellpadding = '10'>";
echo "<th>year</th><th>month</th><th>in/out</th><th>totalAmount(AUD)</th>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        	echo '<td>'.$row['year'].'</td>';
            echo '<td>'.$row['month'].'</td>';
            echo '<td>'.$row['inOrOut'].'</td>';
            echo '<td>'.$row['totalAmount'].'</td>';
        echo "</tr>";
    }
  
echo "</table>";


if($cat != 'grocery'){
    // net
echo "<br>";
echo "<h3>";
echo "net";
echo "</h3>";


$sql = "select year(createTime) AS year,month(createTime) AS month,
FORMAT(sum(IF (inOrOut = 'OUT', -amount,amount)),2)
AS net
from Accounting
where categories = '$cat'
group by year(createTime),month(createTime)";

$result = mysqli_query($conn,$sql);

echo "<table border = 1 cellspacing = '0' cellpadding = '10'>";
echo "<th>year</th><th>month</th><th>net(AUD)</th>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
            echo '<td>'.$row['year'].'</td>';
            echo '<td>'.$row['month'].'</td>';
            echo '<td>'.$row['net'].'</td>';
        echo "</tr>";
    }
   

echo "</table>";
}

echo "<br>";
echo "<a href = 'chaxunxitong.php'> 返回</a>";
echo "</center>";
}

else if($time == '按年'){
$sql = "select year(createTime) AS year, inOrOut, FORMAT(sum(amount),2) AS totalAmount
from Accounting
where categories = '$cat'
group by year(createTime),inOrOut";

$result = mysqli_query($conn,$sql);

echo "<center>";
echo "<table border = 1 cellspacing = '0' cellpadding = '10'>";
echo "<th>year</th><th>in/out</th><th>totalAmount(AUD)</th>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
            echo '<td>'.$row['year'].'</td>';
            echo '<td>'.$row['inOrOut'].'</td>';
            echo '<td>'.$row['totalAmount'].'</td>';
        echo "</tr>";
    }
    
echo "</table>";

if($cat != 'grocery'){
    // net
echo "<br>";
echo "<h3>";
echo "net";
echo "</h3>";


$sql = "select year(createTime) AS year, 
FORMAT(sum(IF (inOrOut = 'OUT', -amount,amount)),2) 
AS net
from Accounting
where categories = '$cat'
group by year(createTime)";

$result = mysqli_query($conn,$sql);

echo "<table border = 1 cellspacing = '0' cellpadding = '10'>";
echo "<th>year</th><th>net(AUD)</th>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
            echo '<td>'.$row['year'].'</td>';
            echo '<td>'.$row['net'].'</td>';
        echo "</tr>";
    }
   

echo "</table>";
}

echo "<br>";
echo "<a href = 'chaxunxitong.php'> 返回</a>";
echo "</center>";
}

// run the sql query


?>
