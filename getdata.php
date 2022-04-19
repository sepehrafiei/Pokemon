<?php 


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "pokemon";
$state = 0;
if(isset($_GET['p'])){
    $state = $_GET["p"];
}
$request = $_GET["q"]; //Search query

$conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connection Failed: %s\n". $conn -> error);

$sql = "select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='pokemon' and TABLE_SCHEMA = 'pokemon';";
$cols = array();

$result1 = $conn->query($sql);
echo "<form id='myForm' action='manage.php' method='get'><table><tr class='cols'>";
while($row1 = $result1->fetch_assoc()) {
    array_push($cols, $row1['COLUMN_NAME']);
    echo "<td>";
    echo $row1['COLUMN_NAME'];
    echo "</td>";
 }
echo "</tr>";

if($state){
    $sql = "SELECT * FROM `pokemon` WHERE Name = '".$request."';";
}
else{
    $sql = "SELECT * FROM `pokemon` WHERE Name like '".$request."%';";
}
$result2 = $conn->query($sql);
$count = 0;
while($row2 = $result2->fetch_assoc()) {
    $count++;
    echo "<tr>";
    foreach($cols as $col){
        if($state){
            if($col == "#"){
                echo "<td><input readonly value='".$row2[$col]."'class='addNew' required type='text' id='".$col."' name='".$col."'></td>";
            }
            else{
                echo "<td><input value='".$row2[$col]."'class='addNew' required type='text' id='".$col."' name='".$col."'></td>";
            }
            
        }
        else{
            echo "<td>";
            if($col == "Name"){
                echo "<a href='index.php?q=".$row2[$col]."'>";
                echo $row2[$col];
                echo "</a>";
            }
            else{
                echo $row2[$col];
            }
            echo "</td>";
        }
     }
     echo "</tr>";
 }
 if($count == 0){
    echo "<input type='submit'>";
    echo "<tr>";
    foreach($cols as $col){
        if($col == "#"){
            $sql3 = "select max(cast(`#` as int)) as '#' FROM `pokemon`;";
            $result3 = $conn->query($sql3);
            $max = (int)(($result3->fetch_assoc())['#'])+1;
            echo "<td><input class='addNew' readonly value='".$max."' type='text' id='".$col."' name='".$col."'></td>";
        }
        else{
            echo "<td><input class='addNew' required type='text' id='".$col."' name='".$col."'></td>";
        }
     
    }
    echo "</tr>";
 }
 echo "</table>";
 echo "<input name='action' id='action' type='hidden' value='add'>";
 echo "</form>";
//document.getElementById('#').readOnly=false;
?>
