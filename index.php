
<?php 
require 'connect.php';
require 'functions.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: *, Authorization');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');
header("Content-Type: application/json; charset=UTF-8");
// header('Content-type: json/application');
$method = $_SERVER['REQUEST_METHOD'];

//shop
//shop/4
//shop/catalog=Побутова_техніка
 $q = $_GET['q'];
$params = explode('/', $q);
$type = $params[0];
$id = $params[1];
// print_r($params); 
// echo(count($params));
// echo "Микола";

// $pp = $_POST;
// $params_post = explode('/', $pp);
// $type_post = $params_post[0];
// $id_post = $params_post[1];

//  mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( 'type', '$type')");
//  mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( 'id', '$id')");
//  mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( 'Q', '$q')");
//  mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( 'type_post', '$type_post')");
//  mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( 'id_post', '$id_post')");
//  mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( 'DELETE', '$_DELETE')");

//  mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( 'method', '$method')");
 $r = $_REQUEST;
 $r1 = $r[0];
 $r2 = $r[1];

//  mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( '_R_1', '$r1')");
//  mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( '_R_2', '$r2')");


// echo $params[0];
// print_r( "    ");
// echo $params[1];
// echo "    ";
// echo $params[2];
// echo "    ";
// echo str_replace('category=',"",$params[2]);
// echo "    ";
// echo $params[3];
// echo "    ";
// echo $params.length();
// echo "    ";
// echo strpos($q, 'category=');
// echo "    ";

$getPost =  new GetPost();
    // mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( 'POST DATA', '$data')");

if($method === 'GET'){
  if($type === 'shop')
      $getPost->getPosts($connect, $q);//Якщо ні то видаємо весь пост
  
}elseif($method === 'POST'){
    if($type === 'shop'){
    $data = file_get_contents( 'php://input');
    $data = json_decode($data,true);
    // mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( 'POST DATA', '$data')");
    // mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( 'type', 'INSERT INTO')");
    addPost($connect, $data, $type);
    }else{
      die('ERROR');
    }
}elseif($method === 'PATCH'){
  
  if($type === 'posts'){
    if(isset($id)){
      $data = file_get_contents( 'php://input');
      $data = json_decode($data,true);
      updatePost($connect, $id, $data);
    }
  }

}elseif($method === 'DELETE'){
  $data = file_get_contents( 'php://input');
  $data = json_decode($data,true);
  
  if($type === 'Shop'){
    if(isset($data)){
      deletePost($connect, $data, $type);
    }
  }

  if($type === 'posts'){
    // mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( 'type', '$type')");
    //  mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( 'id', '$id')");
    if(isset($data)){
      deletePost($connect, $data, $type);
    }
  }
}
