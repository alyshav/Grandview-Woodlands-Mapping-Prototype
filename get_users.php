<?php

    $dsn = 'mysql:host=localhost;dbname=mapdata';
    $username = 'root';
    $password = 'hazel123';
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ); 

    $db = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM observations;";

    $rs = $db->query($sql);
    if (!$rs) {
        echo "An SQL error occurred.\n";
        exit;
    }

    $rows = array();
    while($r = $rs->fetch(PDO::FETCH_ASSOC)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
    $db = NULL;
?>