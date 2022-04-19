<?php 


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "pokemon";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connection Failed: %s\n". $conn -> error);
if(isset($_GET["action"])){
    $action = $_GET["action"];
    if($action == "add"){
        $sql = "INSERT INTO `pokemon`(`#`, `Name`, `Type1`, `Type2`, `Total`, `HP`, `Attack`, `Defence`, `SpecialAttack`, `SpecialDefense`, `Speed`, `Generation`, `Legendary`) VALUES ('".$_GET["#"]."','".$_GET["Name"]."','".$_GET["Type1"]."','".$_GET["Type2"]."','".$_GET["Total"]."','".$_GET["HP"]."','".$_GET["Attack"]."','".$_GET["Defence"]."','".$_GET["SpecialAttack"]."','".$_GET["SpecialDefense"]."','".$_GET["Speed"]."','".$_GET["Generation"]."','".$_GET["Legendary"]."')";
    }
    else if($action == "delete"){
        $sql = "DELETE FROM `pokemon` WHERE `#` = ".$_GET["#"].";";
        $result = $conn->query($sql);
        $sql = "UPDATE `pokemon` SET `#`= `#`-1 WHERE `#`> ".$_GET["#"].";";
    }
    else if($action == "update"){
        $sql = "UPDATE `pokemon` SET `#`='".$_GET["#"]."',`Name`='".$_GET["Name"]."',`Type1`='".$_GET["Type1"]."',`Type2`='".$_GET["Type2"]."',`Total`='".$_GET["Total"]."',`HP`='".$_GET["HP"]."',`Attack`='".$_GET["Attack"]."',`Defence`='".$_GET["Defence"]."',`SpecialAttack`='".$_GET["SpecialAttack"]."',`SpecialDefense`='".$_GET["SpecialDefense"]."',`Speed`='".$_GET["Speed"]."',`Generation`='".$_GET["Generation"]."',`Legendary`='".$_GET["Legendary"]."' WHERE `#`= ".$_GET["#"].";";
    }
    
    echo $sql;
} 

$result = $conn->query($sql);
header("Location: index.php");

?>