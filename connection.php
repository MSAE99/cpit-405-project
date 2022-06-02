<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$host="localhost";
$user="cpit-405";
$passwd="VzH55xBgNFMo0rjR";
$database="cpit-405";
$mysql = new mysqli($host,$user,$passwd,$database);

if($mysql->error){
    die($mysql->error);
}
$table = "images";

$sql = "CREATE TABLE ".$table." (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
url TEXT NOT NULL,
likes INT(5) default 0
); ";

if ($result = $mysql->query("SHOW TABLES LIKE '".$table."'")) {
    if($result->num_rows != 1) {
        if($mysql->query($sql)===TRUE){
//
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "http://api.giphy.com/v1/gifs/search?q=motorcycle&api_key=pv61WXUd2P870H9biGwqmCIgWMRUewnL");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($curl);
            $data = json_decode($output,true);
            //print_r($data['data'][0]['images']['downsized_medium']['url']);
            $data = $data['data'];
            foreach ($data as $image){
                $insert_statement = $mysql->prepare("INSERT INTO images (url) VALUES(?);");
                if($insert_statement){
                    $insert_statement->bind_param("s", $image['images']['downsized_medium']['url']);
                    $insert_statement->execute();
                    $insert_statement->close();
                }
                if($mysql->error){
                    die($mysql->error);
                }

            }
            curl_close($curl);

        }else{
            die($mysql->error);
        }

    }
}
////            echo "<script>
////                 let xhr = new XMLHttpRequest();
////                xhr.open('get', 'http://api.giphy.com/v1/gifs/search?q=motorcycle&api_key=pv61WXUd2P870H9biGwqmCIgWMRUewnL',true);
////                xhr.send();
////                xhr.onload = function() {
////                if(this.readyState===4 && this.status===200) {
////                    let res = JSON.parse(xhr.response);
////                    res.data.forEach(function (v, i) {
////                        images.push(new MyImage(v.images.downsized_medium.url, v.title, v.id, v.trending_datetime))
////                    })
////                }
////            };
////</script>";