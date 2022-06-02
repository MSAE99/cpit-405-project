<?php 
require_once ("connection.php");

if(isset($_GET["id"])){
	
$id=$_GET["id"];
$ck =$_GET["ck"];
setcookie($id, $ck, time() + 2 * 24 * 60 * 60);

if(isset($_COOKIE[$id]) && $_COOKIE[$id]=="like"){
$likes = $mysql->query("select likes from images where id=".$id);

$mysql->query("update images set likes=".($likes+1)." where id=".$id);
$mysql->close();
setcookie($id, "Liked", time() + 2 * 24 * 60 * 60);
return "done" 
}
if(isset($_COOKIE[$id]) && $_COOKIE[$id]=="liked"){
$likes = $mysql->query("select likes from images where id=".$id);

$mysql->query("update images set likes=".($likes-1)." where id=".$id);
$mysql->close();
setcookie($id, "Like", time() + 2 * 24 * 60 * 60);
return "done" 
}
return "done"
}


?>