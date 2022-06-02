<?php
require_once 'connection.php';
$images = $mysql->query("select * from images");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image library</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <h3><a href="<?php echo $_SERVER['PHP_SELF'] ?>">Library</a></h3>
    <hr>

            <div class="wrapper">

                <nav class="text-left ">
<!--                    <a class="ml-auto" href="index.html">Cloud Images</a>-->
<!---->
<!--                    <ul class="ml-auto nav-ul">-->
<!--                        <li class="nav-ul">-->
<!--                            <a href="index.html">Home</a>-->
<!--                        </li>-->
<!--                        <li class="nav-ul">-->
<!--                            <a href="upload-image.html">Upload</a>-->
<!--                        </li>-->
<!--                        <li class="nav-ul">-->
<!--                            <a href="search.html">Search</a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!---->

                </nav>
                <main class="text-snow">

                    <h3 class="text-left m0">Your Images</h3>

                    <hr>
                    <div class="row custom-column" id="images-row">
                        <?php
                        foreach ($images as $image):
                        ?>
                            <div class="column">
                                <img id="<?php echo $image['id'] ?>" src="<?php echo $image['url'] ?>">
                                <div class="<?php if(isset($_COOKIE[$image['id']])) echo 'liked'; else echo 'like'?>" onclick="like(this)" id="like-<?php echo $image['id'] ?>"></div>
                                <div class="likes"><small><span id="img-likes-<?php echo $image['id']?>"><?php echo $image['likes'] ?></span> likes </small></div>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>

                    </tbody>
                    </table>
                </main>
                <footer>

                </footer>
            </div>


    <script>

        function like(e) {
            let id = e.id.split("-")[1];
            let xhr = new XMLHttpRequest()
            xhr.onreadystatechange = () => {
                if(xhr.readyState==4 && xhr.status==200){
                    if(document.cookie.indexOf(id)>-1){
                        e.classList.add('like');
                        e.classList.remove('liked');
                        document.cookie = id+"=1; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
                    }else {
                        e.classList.add('liked');
                        e.classList.remove('like');
                        document.cookie = id+"=1; max-age:24*7*60*60";
                    }
                    
                    document.getElementById("img-likes-"+id).innerText = xhr.response;
                }
            }

            xhr.open("get","like.php?id="+id);


            xhr.send();

        }
    </script>

</body>
</html>