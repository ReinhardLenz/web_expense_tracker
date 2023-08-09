<?php
    // Time limit to 0 for exporting big records.
    ///set_time_limit(0); 
    // mysql hostname
    ///$host= 'xxx';
    // mysql x
    ///$user = 'x';
    // mysql x
    ///$password = 'x';
    // Database Connection using PDO with try catch method. 
    ///try { $pdo = new PDO("mysql:host=$host;dbname=matrix", $user, $password); }
    // In case of error PDO exception will show error message.
    ///catch(PDOException $e) {    echo $e->getMessage();    }
    include('connect_DB.php'); 
    
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment;Filename=Vuosiraportti.xls");
    echo "<html>";
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
    echo "<body>";
    echo "<table border=1>";
    echo"<tr><th>id</th><th>tulot</th><th>ruokailu_kotona</th><th>ruokailu_ulkona</th><th>asuminen</th><th>liikenne</th><th>nordea</th><th>sahko</th><th>vakuutukset</th><th>kodin_hankinnat</th><th>virkistys</th><th>muut_menot</th><th>add1</th><th>add2</th><th>add3</th></tr>";
    // We will assign variable here for entry By. you can use your variables here.
    //$EntryBy = $_GET[val];
    // Get data using PDO prepare Query.
    //$STM2 = $pdo ->prepare ("SELECT `id`, `tulot`, `00`, `01`, `asuminen`, `02`, `nordea`, `sahko`, `vakuutukset`, `03`, `04` , `05` , `add1` , `add2` , `add3` FROM vuosi");
    $STM2 = $pdo ->prepare ("SELECT * FROM vuosi");
    /* bind paramenters, Named paramenters alaways start with colon(:)*/
    //$STM2->bindParam(':EntryBy', $EntryBy);
    /* For Executing prepared statement we will use below function */
    $STM2->execute();
    /* We will fetch records like this and use foreach loop to show multiple Results later in bottom of the page.*/
    $STMrecords = $STM2->fetchAll();
    /* We use foreach loop here to echo records.*/
    foreach($STMrecords as $r)
        {
            echo "<tr>";
            echo "<td>" .$r[0] ."</td>";
            echo "<td>" .$r[1] ."</td>";
            echo "<td>" .$r[2] ."</td>";
            echo "<td>" .$r[3] ."</td>";
            echo "<td>" .$r[4] ."</td>";
            echo "<td>" .$r[5] ."</td>";
            echo "<td>" .$r[6] ."</td>";
            echo "<td>" .$r[7] ."</td>";
            echo "<td>" .$r[8] ."</td>";
            echo "<td>" .$r[9] ."</td>";
            echo "<td>" .$r[10] ."</td>";
            echo "<td>" .$r[11] ."</td>";
            echo "<td>" .$r[12] ."</td>";
            echo "<td>" .$r[13] ."</td>";
            echo "<td>" .$r[14] ."</td>";
            echo "<td>" .$r[15] ."</td>";
            echo "</tr>";  
        }
    echo "</table>";
    echo "</body>";
    echo "</html>";
    // Closing MySQL database connection   
    $pdo = null;

    echo "<script>window.location='vuosi.php'</script>";
?>