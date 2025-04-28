<?php
include 'db.php';

if(isset($_GET["id"])){
    $id= $_GET["id"];
$sql= "DELETE FROM members WHERE id= $id";
$result = $conn->query($sql);
}

header("location:/loanapp/index.php");