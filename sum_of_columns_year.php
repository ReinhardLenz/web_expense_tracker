<?php

include('connect_DB.php'); 
$sum_year=array();
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

for ($i=0; $i < 6; $i++) { 
    $column_name="0".strval($i);
    $query="SELECT SUM(COALESCE(`".$column_name."`,0.00)) AS column_sum FROM vuosi";
    //$query='SELECT SUM(COALESCE(`'.$column_name.'`,0.00)) AS column_sum FROM kuukausi_0';
    $stmt=$pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $sum_year[$i] = $row['column_sum'];
 //   echo $sum_year[$i];
 //   echo "<br>";
}
$sum_year_B=array();
$menotyyppi=array("tulot","asuminen","nordea","sahko","vakuutukset");
$menotyyppi_sum=array();
for ($i=0; $i < 5 ; $i++) { 
    # code...

    $query="SELECT SUM(COALESCE(`".$menotyyppi[$i]. "`,0.00)) AS " .$menotyyppi[$i] ."_sum FROM vuosi";
    //$query='SELECT SUM(COALESCE(`'.$column_name.'`,0.00)) AS column_sum FROM kuukausi_0';
    $stmt=$pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $apu_String=$menotyyppi[$i]."_sum";
    $sum_year_B[$i] = $row[$apu_String];
    }




$query="SELECT SUM(COALESCE(`tulot`,0.00)) AS tulot_sum FROM vuosi";
//$query='SELECT SUM(COALESCE(`'.$column_name.'`,0.00)) AS column_sum FROM kuukausi_0';
$stmt=$pdo->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_year['tulot'] = $row['tulot_sum'];




$pdo = null;