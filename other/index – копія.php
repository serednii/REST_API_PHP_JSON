<?php
// echo 'Name  '.htmlspecialchars($_POST[name]). '!';
// echo 'email  '.htmlspecialchars($_POST[email]). '!';\

if(isset($GET["data"])){
    // $data = file_get_contents("php://input");
    // echo $data
    $get = $GET['data'];
    echo $get;
    // $user = json_decode($data, true);
    return "hello";
    // do whatever we want with the users array.
 }
// echo 'ema '.htmlspecialchars($GET[data]). '!';

// echo 'id  '.htmlspecialchars($_GET[id?]). '!';
?>