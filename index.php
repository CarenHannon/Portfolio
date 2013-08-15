<!DOCTYPE html>

<html>
    <head>
        <?php
        $self = $_SERVER['PHP_SELF'];
        echo("<title>Carole Anne's Portfolio</title>");
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="js/libs/jquery-1.9.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/libs/jqueryui-1.10.0/jquery-ui.min.js"></script>
        <link type="text/css" rel="stylesheet" href="style.css">
        <style type="text/css"></style>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#infolist").accordion({
                    heightStyle: "content"
                });
            });

            str = "oooooo";


            function showDesc(cat)
            {
                if (str == "")
                {
                    document.getElementById("description").innerHTML = "";
                    return;
                }
                if (window.XMLHttpRequest)
                {// IE, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else
                {// old IE
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("description").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "getDescription.php?cat=" + cat, true);
                xmlhttp.send();
            }
        </script>

    </head>

    <?php
    include('database/dblogin.php');
    $mysqli = new mysqli($localhost, $my_user, $my_password, $my_db);
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }

    $query = "select category from categories";
    $result = $mysqli->query($query);
    if (!$result) {
        echo ("Error Fetching Categories");
    }
    ?>



    <body>
        <div id="container">
            <header><h1><a href="index.php">Carole Anne's Portfolio</a></h1></header>
            <nav>
                <h2 class="nav">Navigation</h2>
                <div id="infolist">
                    <?php
                    while ($categories = mysqli_fetch_array($result)) {
                        if ($categories[0] != "None") {
                            echo "<h3><a href=\"#\">" . $categories[0] . "</a></h3>\n";
                            echo "<div><ul>\n";
                            $query = "select skill from skills join categories on categories.cat_id=skills.cat_FK where categories.category = \"" . $categories[0] . "\";";
                            $subresult = $mysqli->query($query);
                            if (!$subresult) {
                                echo ("Error Fetching Data");
                            }
                            while ($row = mysqli_fetch_array($subresult)) {
                                echo "<li><a href=\"#\" onclick=\"showDesc(this.innerHTML)\">" . $row[0] . "</a></li>\n";
                            }

                            echo "</ul>\n";

                            echo"</div>\n";
                        }
                    }
                    ?>
                </div>

            </nav>

            <!--Main body-->
            <article><h3>Featured Article</h3>

                <div id="description"><b>Highlighted Project will go here</b></div>

            </article>

            <!--Footer -->
            <footer>Design by Carole Anne Hannon. 
                <br />Since my main concern is making sure the php/mysql is working correctly, I went with a very simple layout (for now).
            </footer>
        </div>

    </body>
    <?php mysqli_close($mysqli);
    ?>
</html>
