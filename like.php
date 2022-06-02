<?php
require_once "connection.php";

if(count($_GET)&&isset($_GET['id'])){
    $id = $_GET['id'];
    $likes = $mysql->query('select likes from images where id='.$id)->fetch_assoc();
    if(isset($_COOKIE[$id])){
        $likes = $likes['likes']-1;
    }else{
        $likes = $likes['likes']+1;
    }
    $mysql->query("update images set likes=".$likes." where id=".$id);
    echo $likes;
}