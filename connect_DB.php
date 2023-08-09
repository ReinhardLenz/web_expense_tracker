<?php
$host='xxxx';
$user='xxxx';
$password='xxxx';
$dbname='xxxx';

$dsn='mysql:host='.$host.';dbname='.$dbname;
$pdo=new PDO($dsn,$user,$password);