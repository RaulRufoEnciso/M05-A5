<?php
$servername = "bbdd.martamillanlom.cat";
$username = "ddb193275";
$password = "bbddTest12!%";
$dbname = "ddb193275";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["nomProducte"]) && !empty($_POST["nomProducte"])){
    if($_POST["addEdit"] == 0){
        $sql = "INSERT INTO productes (nom) VALUES ('" . $_POST["nomProducte"] ."')";
    } else {
        $sql = "UPDATE productes SET nom='" . $_POST["nomProducte"] . "' WHERE id=" . $_POST["addEdit"];
    }

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

header('Location: ex1List.php');
?>
