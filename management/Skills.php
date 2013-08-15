<html>
    <head>
        <title></title>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script>
function showSkill(str)
{
if (str=="")
  {
  document.getElementById("history").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("history").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","GetSkills.php?q="+str,true);
xmlhttp.send();
}
</script>
    </head>

    <form>
    <select name="skills" onchange ="showSkill(this.value)">
    <?php
        include('../database/dblogin.php');
        $mysqli = new mysqli($localhost, $my_user, $my_password, $my_db);
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
        $query = "select skill_id, skill from skills";
        $result = $mysqli->query($query);     
        echo ("<option value =\"\"> Select a skill:</option>  ");
        while ($i =  mysqli_fetch_row($result))
        {
            
            echo ("<option value = \"".$i[0]."\">".$i[1]."</option>   ");
        }?>
    </select>
    </form>
<br>
<div id="history"><b>Skill</b></div>



        <?php $mysqli->close()?>

</body>
</html>
    </body>
</html>