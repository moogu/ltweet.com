<?php
    //Connect To Database
    $hostname='ltweet.db.7774928.hostedresource.com';
    $username='ltweet';
    $password='k76D6axy2i3D';
    $dbname='ltweet';
    $yourfield = 'NM_USER';
    
    mysql_connect($hostname,$username, $password) OR DIE (mysql_error());
    mysql_select_db($dbname);
    
    $query = 'SELECT * FROM `tb_log`';
    $result = mysql_query($query);
    if($result) {
        while($row = mysql_fetch_array($result)){
            $name = $row[$yourfield];
            echo 'Name: ' . $name . '<br/>';
        }
    }
    ?>