<?php
    //Connect To Database
    $hostname='ltweet.db.7774928.hostedresource.com';
    $username='ltweet';
    $password='k76D6axy2i3D';
    $dbname='ltweet';
    $usertable='tb_log';
    $yourfield = 'nm_user';
    
    mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database! Please try again later.');
    mysql_select_db($dbname);
    
    $query = 'SELECT * FROM ' . $usertable;
    $result = mysql_query($query);
    if($result) {
        while($row = mysql_fetch_array($result)){
            $name = $row[$yourfield];
            echo 'Name: ' . $name;
        }
    }
    ?>