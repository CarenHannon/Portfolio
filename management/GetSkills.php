<?php
        include('../database/dblogin.php');
        $mysqli = new mysqli($localhost, $my_user, $my_password, $my_db);
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
        
        $q=$_GET["q"];
        
        $query="SELECT * FROM skills WHERE skill_id = '".$q."'";

$result = $mysqli->query($query);

echo "<table border='1'>
<tr>
<th>Skill ID</th>
<th>Skill</th> 
<th>Description</th>
</tr>";
$history;
$skill_id;

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['skill_id'] . "</td>";
  echo "<td>" . $row['skill'] . "</td>";
  
  echo "<td><a href=\"\">" . "update description" . "</a></td>";
  echo "</tr>";
  
  $history = $row['history'];
  $skill_id = $row['skill_id'];
  }
echo "</table>";
echo $history."<br />";

echo ("<form input type =\"text\" action =\"update.php\"  method=\"POST\">
    HISTORY:<br /> <textarea rows=\"4\" cols=\"50\" name=\"new\">
".$history."</textarea><br />
    <input type = \"hidden\" name = \"id\"".$skill_id." value = \"".$skill_id."\" readonly>
        <input type = \"hidden\" name = \"table\" value=\"skills\" readonly>
        <input type = \"hidden\" name = \"col\" value=\"history\" readonly>
    <input type=\"submit\">
</form>");

$mysqli->close();?>