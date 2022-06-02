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
                                 <div class="like" onclick="f(this)" id="like<?php echo $image['id'] ?>"></div>
                                <div class="likes" ><small><?php echo $image['likes'] ?> likes </small></div>
                            
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

        
function f (e){
    const like = document.getElementById('like');
            if (like.className == "like") {
                like.setAttribute('class' , 'liked');
            
                window.location.href = "like.php?id=" + $image['id'] + "&ck=like";
            }
      else {
                like.setAttribute('class' , 'like');
                window.location.href = "like.php?id=" + $image['id'] + "&ck=liked";
            }


        }

    </script>
</body>

</html>