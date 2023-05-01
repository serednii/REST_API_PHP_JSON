
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


 $q = $_GET['q'];
$params = explode('/', $q);
$type = $params[0];
$id = $params[1];
// mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( 'type', '$type')");
//  mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( 'id', 'cvbc')");


if($method === 'GET'){
  // if($type === 'posts'){
 
   if ($connect->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   }else{
     if(isset($id)){
       getPost($connect, $id, $type);
     }else {
       getPosts($connect, $type);
     }
   }
  //  }

}elseif($method === 'POST'){
    $data = file_get_contents( 'php://input');
    $data = json_decode($data,true);
    addPost($connect, $data, $type);

}elseif($method === 'PATCH'){
  
  if($type === 'posts'){
    if(isset($id)){
      $data = file_get_contents( 'php://input');
      $data = json_decode($data,true);
      updatePost($connect, $id, $data);
    }
  }
}elseif($method === 'DELETE'){
  
  if($type === 'posts'){
    if(isset($id)){
      deletePost($connect, $id);
    }
  }
}

  

















// //  echo  `<br/>`
//   echo 'Привет, ' . htmlspecialchars($_GET["name"]) . '!';
// echo $url;
// // echo 'Привет, ' . htmlspecialchars($_GET["name"]) . '!';
// // }


    // if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        //  $url = "https://";   
    // else  
        //  $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
  
      
    // echo  $url;  
    // if(strpos($url, '/posts/') || strpos($url, '/posts')){
    //   echo 'true';
    // }else {
    //   echo 'false';
    // }






  // if(strpos($url, '/posts/') || strpos($url, '/posts')){





        //   // echo "Connected successfully";
    //   $posts = mysqli_query($connect, "SELECT * FROM  `posts`");
    //   $postsList=[];
    //   while ($post = mysqli_fetch_assoc   ($posts)){
    //   // $postsList = $post;
    //   array_push($postsList, $post);
    // }
    // echo json_encode($postsList);





    // echo 'METHODgg   ',$_SERVER['REQUEST_METHOD'];
// echo  'SERVER_PORT    ', $_SERVER['SERVER_PORT'] ;
// echo '<br/>';
// echo 'REQUEST_URI   ', $_SERVER['REQUEST_URI'];
// echo '<br/>';
// echo 'SERVER_ADDR   ',$_SERVER['SERVER_ADDR'];
// echo '<br/>';
// echo 'SERVER_NAME   ',$_SERVER['SERVER_NAME'];
// echo '<br/>';
// echo 'PHP_SELF   ',$_SERVER['PHP_SELF'];
// echo '<br/>';
// echo 'REQUEST_METHOD   ',$_SERVER['REQUEST_METHOD'];
// echo '<br/>';
// echo 'REMOTE_ADDR   ',$_SERVER['REMOTE_ADDR'];
// echo '<br/>';
// echo 'REMOTE_HOST   ',$_SERVER['REMOTE_HOST'];
// echo '<br/>';
// echo 'REMOTE_PORT   ',$_SERVER['REMOTE_PORT'];
// echo '<br/>';