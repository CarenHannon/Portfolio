<?php
        include('../database/dblogin.php');
        $mysqli = new mysqli($localhost, $my_user, $my_password, $my_db);
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
        
        $skill_id=$_POST["id"];
        $new = $_POST["new"];
        $table = $_POST["table"];
        $column = $_POST["col"];
        $query = "update ".$table." set ".$column."= \"".$new."\" where skill_id = ".$skill_id.";";
        if ($mysqli->query($query) === TRUE) {
                    echo("Updated History ");
                } else {
                    echo( " Error Updating");
                }
        
        
        echo(htmlentities($skill_id));
        echo("<br />");
        echo($new);
        echo($query);

$mysqli->close();?>