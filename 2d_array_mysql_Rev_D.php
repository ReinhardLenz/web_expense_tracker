<?php
include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php');
// NOTE:
// in the mysqldatabase, the month index is from 1,2,3,... 12
// $kk_no  index is from 1,2,3,... 12
// $_SESSION['month']   index is from 1,2,3,... 12
// $month_JFSOND index is from 0,1,2,... 11

/*
echo'<script>
  function key(event) {
    if (event.charCode == 13 && /Android/.test(navigator.userAgent)) {
      event.preventDefault();
      document.getElementById("sb").focus();
    }
  }
</script>';
*/


// tämän tarkoitus oli, että jos mobiiliversiossa paintetaan next, se menisi suoraan submit napille. ei taida toimia
/*
function getWeekday($date) {
    return date('w', strtotime($date));
}

echo getWeekday('2012-10-11');
*/
function getWeekday($date) {
    $days = array('su', 'ma', 'ti', 'ke','to','pe', 'la');
    return $days[date('w', strtotime($date))];
    }

echo '<script>

function key(event) {
    div = document.createElement("div");
    div.textContent = "eventType:" + event.type + " keyCode:" + event.keyCode + " charCode:" + event.charCode;
    document.body.appendChild(div);
    if (event.charCode == 13 &&
        /Android/.test(navigator.userAgent)) {
      event.preventDefault();
      document.getElementById("sb").focus();
    }
  }
</script>
';



echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">';

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
                echo 'valittu: '. $_POST[$i];
                $_SESSION['month']=strval($i);
                $kk_no=$_SESSION['month'];
            } 
    }

} else {
    if (isset($_SESSION['month'])){
        $kk_no=$_SESSION['month'];
        echo ("<br><p>Kuukausi oli jo valittu ja on " . $month_JFSOND[$kk_no-1]  . "</p><br>");
    } else
        {
        echo 'ei painike painettu';
        $now = new DateTime();
        $kk_no= strval($now->format('n'));
        $_SESSION['month']=$kk_no;
        //$kk_to_int=$kk_no;
        //settype($kk_to_int,'integer');
        echo ("<br><p>Kuukaudeksi on laitettu " . $month_JFSOND[$kk_no-1] . "</p><br>"); 
        }
}



?>

<!-- vuosi painike sivun yläpuolella -->
<form >
<br>
<input type="submit" name="submit" style="height:20px; width:50px" value="vuosi">


<?php  

    if (isset($_GET['submit'])) {
        //header("http://100.115.92.199:8000/matrix/2d_array_mysql_Rev_D.php");
        //echo "<script>window.location='http://100.115.92.199:8000/matrix/vuosi.php'</script>";
        //localhost
        echo "<script>window.location='https://raikkulenz.kapsi.fi/matrix/vuosi.php'</script>";
    }

?>
</form>


<?php

if (isset($_SESSION['month'])) {
    $kk_no=$_SESSION['month'];
}

$rows=31;
$columns=6;

include('utility.php'); 
include('connect_DB.php'); 
// read in from mysql table
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$query="SELECT * FROM kuukausi_". $kk_no;
$stmt=$pdo->prepare($query);
$stmt->execute();
$results=$stmt->fetchAll();
$resultsArray = objectToArray($results);


echo("<br>");
for ($e=0; $e < $columns ; $e++) { 
    for ($i=0; $i < $rows; $i++) { 
        $ColumnName='0'.strval($e);
        $values['A'][$e][$i]=$resultsArray[$i][$ColumnName];
    }
}



$pdo = null;
?>
<!--CREATE THE TABLE -->
<html><head><style>input{text-align: right;}</style></head><body>
<form method="post"><table border=1 width="100">
<tr>
    <th>Päivä</th>
    <th>Ruoka kotona</th>
    <th>Ruoka ulkona</th>
    <th>Liikenne</th>
    <th>Kodin hankinnat</th>
    <th>Virkistys</th>
    <th>Muut Menot</th>
    <th>Kommentti</th>
</tr>

<?php

for ($e=0;$e<$rows;$e++) { 
    echo '<tr>';
    $day_from_index=$e+1;
    $weekday=getWeekday(date("Y")."-".$kk_no.'-'.$day_from_index);
    echo '<th width="8%">'.$weekday.', '.$day_from_index.'</th>';
    for($i=0;$i<$columns;$i++){
        echo '<th width="8%">';
        echo "<input size=5 type = 'decimal' autofocus='autofocus' inputmode='text' name = 'index[A][". $i ."][" . $e ."]'  value = '". $values['A'][$i][$e] . "' />";
        echo '</th>';
    }
    //kommentti
    echo '<th width="8%">';
    echo "<input size=5 type = 'text' name = 'index[A][add1][" . $e ."]'  value = '". $resultsArray[$e]['add1'] . "' />";
    echo '</th>';


}
// show the total amount of each column
echo '</tr>';
include('sum_of_columns.php');
echo '<tr>';
echo "<th>Summa</th>";
for ($i=0; $i <$columns ; $i++) { 
    echo '<th width="8%">';
    echo $sum[$i]." €";
    echo '</th>';}
echo '</tr>';

// average per day
echo '<tr>';
echo "<th>keskiarvo/päivä</th>";
for ($i=0; $i <$columns ; $i++) { 
    echo '<th width="8%">';
    echo round($sum[$i]/30,2)." €";
    echo '</th>';}
echo '</tr>';


//transfer the sum  to the "vuosi" table
    try{
        include('connect_DB.php'); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $kk_no_t=$kk_no-1;

        for ($i=0; $i < $columns; $i++) {
            $string_of_i="0".strval($i);
            $valiaikainen=$sum[$i];
            $sql = "UPDATE `vuosi` SET `$string_of_i` = '$valiaikainen' WHERE `id` = '$kk_no_t'";
            $pdo->exec($sql);
        

    }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    $pdo = null;

//end transfer


echo '</table>';
//echo '<input type="submit" style="height: 0px; width: 0px; border: none; padding: 0px;" hidefocus="true" />';
echo'<input type="submit" name="submit" style="height:50px; width:50px" id=sb value="submit"><br><br><input type="submit" name="delete" value="delete">';
echo '<br><br><br>';
echo"</form></body></html>";

if (isset($_POST['submit'])) {
     //echo '<p>Output</p>';
    try{
        include('connect_DB.php'); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    for ($e=0; $e < $rows; $e++) {

        for ($i=0; $i < $columns; $i++) { 
            //echo($_POST["index"]['A'][$i][$e].'   ');
            $values['A'][$i][$e]=$_POST["index"]['A'][$i][$e];
            $_SESSION['A'][$i][$e]=$_POST["index"]['A'][$i][$e];
            $string_of_i="0".strval($i);
            $valiaikainen=$_POST["index"]['A'][$i][$e];
            $kommentti=$_POST["index"]['A']['add1'][$e];

            $sql = "UPDATE `kuukausi_". $kk_no."` SET `$string_of_i` = '$valiaikainen' WHERE `id` = '$e'";
            //$sql = "UPDATE `kuukausi_00` SET `$string_of_i` = '$valiaikainen' WHERE `id` = '$e'";
            $pdo->exec($sql);
            $sql = "UPDATE `kuukausi_". $kk_no."` SET `add1` = '$kommentti' WHERE `id` = '$e'";
            //$sql = "UPDATE `kuukausi_00` SET `$string_of_i` = '$valiaikainen' WHERE `id` = '$e'";
            $pdo->exec($sql);


        }

    }
    }catch(PDOException $e){
        echo $e->getMessage();
    }

    
    $pdo = null;

   echo "<script>window.location='2d_array_mysql_Rev_D.php'</script>";
}



if (isset($_POST['delete'])) {
   // $kk_no=$_POST['month'];
  //  $kk_no=1;
    
    try{
        include('connect_DB.php'); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    for ($e=0; $e < $rows; $e++) {
        for ($i=0; $i < $columns; $i++) { 
            $string_of_i="0".strval($i);
            $valiaikainen="0";
            $sql = "UPDATE `kuukausi_". $kk_no."` SET `$string_of_i` = '$valiaikainen' WHERE `id` = '$e'";
            $pdo->exec($sql);
        }
     }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
   $pdo = null;

   echo "<script>window.location='2d_array_mysql_Rev_D.php'</script>";
}
include($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php');