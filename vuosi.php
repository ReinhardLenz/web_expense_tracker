<?php    ?>

<html>
<head>

</head>

<body>




<?php
include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php');


//echo '<form method="post" action= "http://'.$_SERVER["HTTP_HOST"]. "/matrix/2d_array_mysql_Rev_D.php" .'">';
echo '<form method="post" action= "https://'.$_SERVER["HTTP_HOST"]. "/matrix/2d_array_mysql_Rev_D.php" .'">';
//before sending to server, http must be changed to https !!

$month_JFSOND=array("Tammikuu","Helmikuu","Maaliskuu","Huhtikuu","Toukokuu","Kesäkuu","Heinäkuu","Elokuu","Syyskuu","Lokakuu","Marraskuu","Joulukuu");

//luo yläpalkiin painonapit kuukausille

for ($i=0; $i < 12; $i++) { 
    # code...
$väliaikainen_2=$i+1;
    echo ' <input name="'.$väliaikainen_2.'" value="'.$month_JFSOND[$i].'" type="submit">';
}

echo '</form>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i=1; $i <=12 ; $i++) { 
            if (isset($_POST[$i])) {
                //echo $_POST[$i];
                $_SESSION['month']=strval($i);
            }
    }
}

?>
<head><style>input{text-align: right;}</style></head><body>
<form method="post"><table border=1 width="1000">


<table border=1 width="1000">

<tr>
    <th>Kuukausi</th>
    <th>Tulot yhteensä</th>
    <th>Ruokailu kotona</th>
    <th>Ruokailu ulkona</th>
    <th>Asuminen</th>
    <th>Liikenne</th>
    <th>Nordea</th>
    <th>Sähkö</th>
    <th>Vakuutus</th>
    <th>Kodin hankinnat</th>
    <th>Virkistys</th>
    <th>Muut menot</th>
    <th>Tulos +/-</th>
    <th>Kommentit</th>

</tr>


<?php


include('sum_of_columns_year.php');

function whatever_to_string($in){
    ob_start();
    print_r($in);
    return
     ob_get_clean();
    }


function flatten(array $array) {
    $return = array();
    array_walk_recursive($array, function($a) use (&$return) { $return[] = $a . " "; });
    return $return;
}


$month_JFSOND=array("Tammikuu","Helmikuu","Maaliskuu","Huhtikuu","Toukokuu","Kesäkuu","Heinäkuu","Elokuu","Syyskuu","Lokakuu","Marraskuu","Joulukuu");


include('utility.php'); 
include('connect_DB.php'); 
// read in from mysql table
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$query="SELECT * FROM vuosi";
$stmt=$pdo->prepare($query);
$stmt->execute();
$results=$stmt->fetchAll();
$resultsArray_vuosi = objectToArray($results);
$pdo = null;

//Reading comments from months

$push_month=array();

include('connect_DB.php'); 
// read in from mysql table
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
for ($i_kk_no=1; $i_kk_no < 13; $i_kk_no++) { 
    # code...

    $query="SELECT `add1` FROM kuukausi_". $i_kk_no;
    $stmt=$pdo->prepare($query);
    $stmt->execute();
    $results=$stmt->fetchAll();
    $resultsArray_month = objectToArray($results);
    //$push_month[$i_kk_no]=implode(",", flatten($resultsArray_month));
    $push_month[$i_kk_no]=implode(flatten($resultsArray_month));

}


//End reading from kuukausi

$pdo = null;


$result_sum=0;
for ($e=0; $e < 12; $e++) { 
    # code...
    echo'<tr>';

    echo'<th>';
    echo $month_JFSOND[$e];
    echo'</th>';

    echo '<th width="13%">';
    echo "<input size=5  value='". $resultsArray_vuosi[$e]['tulot']  ."'  name ='index_vuosi[A][0][".$e."]'     type='text'>";
    echo '</th>';

    echo '<th>';
    echo $resultsArray_vuosi[$e]['00'];
    echo '</th>';

    echo '<th>';
    echo $resultsArray_vuosi[$e]['01'];
    echo '</th>';


    echo '<th width="13%">';
    echo "<input size=5  value='". $resultsArray_vuosi[$e]['asuminen']  ."'  name ='index_vuosi[A][1][".$e."]'     type='text'>";

    echo '</th>';

    echo '<th>';
    echo $resultsArray_vuosi[$e]['02'];
    echo '</th>';

    echo '<th width="13%">';
    echo "<input size=5  value='". $resultsArray_vuosi[$e]['nordea']  ."'  name ='index_vuosi[A][2][".$e."]'     type='text'>";
    echo '</th>';

    echo '<th width="13%">';
    echo "<input size=5  value='". $resultsArray_vuosi[$e]['sahko']  ."'  name ='index_vuosi[A][3][".$e."]'     type='text'>";
    echo '</th>';

    echo '<th width="13%">';
    echo "<input size=5  value='". $resultsArray_vuosi[$e]['vakuutukset']  ."'  name ='index_vuosi[A][4][".$e."]'     type='text'>";    
    echo '</th>';

    echo '<th>';
    echo $resultsArray_vuosi[$e]['03'];
    echo '</th>';

    echo '<th>';
    echo $resultsArray_vuosi[$e]['04'];
    echo '</th>';

    echo '<th>';
    echo $resultsArray_vuosi[$e]['05'];
    echo '</th>';

    echo '<th>';
    $result[$e]=$resultsArray_vuosi[$e]['tulot']-$resultsArray_vuosi[$e]['00']-$resultsArray_vuosi[$e]['01']-$resultsArray_vuosi[$e]['asuminen']-$resultsArray_vuosi[$e]['02']-$resultsArray_vuosi[$e]['nordea']-$resultsArray_vuosi[$e]['sahko']-$resultsArray_vuosi[$e]['vakuutukset']-$resultsArray_vuosi[$e]['03']-$resultsArray_vuosi[$e]['04']-$resultsArray_vuosi[$e]['05'];
    echo $result[$e];
    $result_sum+=$result[$e];
    echo '</th>';


    echo '<th>';
    $e1=$e+1;
    echo $push_month[$e1];
    echo '</th>';


    echo'</tr>';
}

echo'<tr>';

echo '<th>';
echo' ';
echo '</th>';


echo '<th>';
echo $sum_year_B[0]." €";
echo '</th>';

echo '<th>';
echo $sum_year[0]." €";
echo '</th>';

echo '<th>';
echo $sum_year[1]." €";
echo '</th>';

echo '<th>';
echo $sum_year_B[1]." €";
echo '</th>';

echo '<th>';
echo $sum_year[2]." €";
echo '</th>';

echo '<th>';
echo $sum_year_B[2]." €";

echo '</th>';

echo '<th>';
echo $sum_year_B[3]." €";
echo '</th>';

echo '<th>';
echo $sum_year_B[4]." €";
echo '</th>';

echo '<th>';
echo $sum_year[3]." €";
echo '</th>';

echo '<th>';
echo $sum_year[4]." €";
echo '</th>';

echo '<th>';
echo $sum_year[5]." €";
echo '</th>';

echo '<th>';
echo $result_sum." €";
echo '</th>';

echo'</tr>';



//start of average



echo'<tr>';


echo "<th>keskiarvo/viikko</th>";



echo '<th>';
echo round($sum_year_B[0]/52,2)." €";
echo '</th>';

echo '<th>';
echo round($sum_year[0]/52,2)." €";
echo '</th>';

echo '<th>';
echo round($sum_year[1]/52,2)." €";
echo '</th>';

echo '<th>';
echo round($sum_year_B[1]/52,2)." €";
echo '</th>';

echo '<th>';
echo round($sum_year[2]/52,2)." €";
echo '</th>';

echo '<th>';
echo round($sum_year_B[2]/52,2)." €";

echo '</th>';

echo '<th>';
echo round($sum_year_B[3]/52,2)." €";
echo '</th>';

echo '<th>';
echo round($sum_year_B[4]/52,2)." €";
echo '</th>';

echo '<th>';
echo round($sum_year[3]/52,2)." €";
echo '</th>';

echo '<th>';
echo round($sum_year[4]/52,2)." €";
echo '</th>';

echo '<th>';
echo round($sum_year[5]/52,2)." €";
echo '</th>';

echo '<th>';
echo round($result_sum/52,2)." €";
echo '</th>';


echo'</tr>';





//end of average



?>

</table>    
<input type="submit" name="submit" style="height:50px; width:50px" value="submit">
<br>
<br>
<input type="submit" name="export" value="export">

</form>
<br>
<br>
<br>
<?php

$input_descript=array("tulot","asuminen","nordea","sahko","vakuutukset");

if (isset($_POST['submit'])) {
   try{
       include('connect_DB.php'); 
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
       for ($e=0; $e < 12; $e++) {
       for ($i=0; $i < 5; $i++) { 
           //$values['A'][$i][$e]=$_POST["index_vuosi"]['A'][$i][$e];
           //$_SESSION['A'][$i][$e]=$_POST["index_vuosi"]['A'][$i][$e];
           //$string_of_i="0".strval($i);
           $valiaikainen=$_POST["index_vuosi"]["A"][$i][$e];
           $sql = "UPDATE `vuosi` SET `$input_descript[$i]` = '$valiaikainen' WHERE `id` = '$e'";
           $pdo->exec($sql);
       }
    }

    for ($e=0; $e < 12; $e++) { 
        # code...
        $e1=$e+1;
        $valiaikainen=$push_month[$e1];
        $sql = "UPDATE `vuosi` SET `add1` = '$valiaikainen' WHERE `id` = '$e'";
        $pdo->exec($sql);
    }
   }catch(PDOException $e){
       echo $e->getMessage();
   }

   
   $pdo = null;

  echo "<script>window.location='vuosi.php'</script>";
}

if (isset($_POST['export'])) {
    echo "<script>window.location='excel_export1.php'</script>";
}
include($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php');