<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css"></style>

        <?php
        include('../database/dblogin.php');
        $mysqli = new mysqli($localhost, $my_user, $my_password, $my_db);
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }

        
        //TABLES CLASS
        class Tables {

            var $table;
            var $mysqli;

            function Tables($table_name, $mysqli) {
                $this->table = $table_name;
                $this->mysqli = $mysqli;
                echo($this->table . "<br />");
            }

            function dropTable() {
                $query = "DROP TABLE IF EXISTS'" . $this->table . "'";
                echo ("Dropped Categories");
            }

            function createTable($columns) {
                $query = "CREATE TABLE " . $this->table .$columns ;
                echo $query . "<br />";
                if ($this->mysqli->query($query) === TRUE) {
                    echo("Created Table " . $this->table);
                } else {
                    echo($this->table . " table not created successfully");
                }
            }
            
            function addFK($query)
            {
                 if ($this->mysqli->query($query) === TRUE) {
                    echo("Created FK  " . $this->table);
                } else {
                    echo($this->table . " FK not created successfully");
                }
            }

            function populateCategoriesTable() {
                $categories = array('None', 'Programming', 'Communications', 'Office', 'Graphics');
                foreach ($categories as $key => $val) {
                    $query = "INSERT INTO " . $this->table . " (category) VALUES (\"" . $val . "\");";
                    echo ($query."<br />");
                    if ($this->mysqli->query($query) === TRUE) {
                        echo("Adding Category " . $val . "<br >");
                    }
                }
            }
            
            
        }
        ?>
        
        
        
        <?php
        /*
        $table = new Tables("categories", $mysqli);
        $table->createTable(" (cat_id int(11) not null auto_increment,
                    category varchar(25) not null,
                    PRIMARY KEY (cat_id));");
        $table->populateCategoriesTable();
         */
        
       /* $table = new Tables("Skills", $mysqli);
        $table->createTable(" (skill_id int(11) not null auto_increment,
            skill varchar(25) not null,
            history text,
            cat_FK int(11) not null,
            PRIMARY KEY (skill_id),
            INDEX(cat_FK)
            );");
        $table ->addFK ("alter table skills add constraint skill_FK FOREIGN KEY (cat_FK) reference
s categories(cat_id) on UPDATE CASCADE on DELETE CASCADE;");*/        
        
        mysqli_close($mysqli);
        ?>



