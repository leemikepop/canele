<?php
//define('DB_SERVER','172.19.2.1');
define('DB_SERVER','192.168.0.108');
define('DB_USERNAME','general');
define('DB_PASSWORD','');
define('DB_NAME','canele');

$link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
mysqli_query($link,'SET NAMES utf8');

if($link === false){
    die("ERROR: Could not connect. ".mysqli_connect_error());
}else{
    return $link;
}
?>