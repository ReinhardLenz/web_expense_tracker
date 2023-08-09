<?php

include('connect_DB.php'); 
$sum=array();
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

for ($i=0; $i < 6; $i++) { 
    $column_name="0".strval($i);
    $query="SELECT SUM(COALESCE(`".$column_name."`,0.00)) AS column_sum FROM kuukausi_". $kk_no;
    //$query='SELECT SUM(COALESCE(`'.$column_name.'`,0.00)) AS column_sum FROM kuukausi_0';
    $stmt=$pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $sum[$i] = $row['column_sum'];
//    echo $sum[$i];
//    echo "<br>";
}

