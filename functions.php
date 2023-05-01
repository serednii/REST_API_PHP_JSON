<?php

class GetPost{
  
//********************************************************************* */
   public function getPosts($connect, $q){
    //    echo "getPost";
       $query =  $this->filterAnsver($q);//Розбираємо  get запрос і формуємо SQL запрос
    //    echo "query";

    //    echo $query;
    $answerSql = $this->mysqliQuery($connect, $query);
    // print_r($answerSql);
    $this->outJson($answerSql);
    }
//********************************************************************* */

//********************************************************************* */
    private function outJson($answerSql){
        if(mysqli_num_rows($answerSql) === 0){
            $this->errorCode(404, "Post not found");
        }else{
            $answerList = [];
            while($post = mysqli_fetch_assoc($answerSql)) {
                $answerList[] = $post;
            }
            echo json_encode($answerList,  JSON_UNESCAPED_UNICODE);
            

        }
    }
//********************************************************************* */

//********************************************************************* */
private function errorCode($cod, $message){
    http_response_code($cod);
    $res = [
        "status" => false,
        "message" =>$message
    ];
    echo json_encode($res,  JSON_UNESCAPED_UNICODE);
}
//********************************************************************* */


//********************************************************************* */
    private function mysqliQuery($connect, $ansver ){
        if ($connect->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }else{
           return  mysqli_query($connect, $ansver );
          }
    }
//********************************************************************* */

//********************************************************************* */
    private function filterAnsver($q){
        $params = explode('/', $q);
        $type = $params[0];
        $id = $params[1];
        //   echo "111111 ";
        //   print_r($params);
        // if(!(strpos($q, 'category=') || strpos($q, 'filter='))){//кщо є пошук не по каталогу або фільтру
            if(str_replace('shop',"",$q) === "" || str_replace('shop',"",$q) === "/" ){
        //   echo "111111 ";

            return   "SELECT * FROM `Shop`" ;
        }elseif(intval($id)>0){ //Якщо є число
        //   echo "222222 ";

        // return  $answerSql = mysqli_query($connect, "SELECT * FROM `Shop` WHERE  `id` = '$id' ");
        return   "SELECT * FROM `Shop` WHERE  `id` = '$id' ";

        }elseif(strpos($q, 'filter-' ) || strpos($q, 'filter=' ) || strpos($q, 'limit=' ) || strpos($q, 'page=' )){//кщо є пошук  по  фільтру
        //   echo "search category filter --- ";
        // echo "333333 ";
   
            $filter="";
            foreach($params as $value){
                //Перебираємо всю строку запросу масива

                // echo strpos($value, 'category=' );
            //    if(strpos($value, 'menu-')!==false) {
                        // $temp = str_replace('menu-',"",$value);//Відкидаємо слово фільтер menu-   лишаємо запрос category=TV
                        // $filterArr = explode('=', str_replace('menu-',"",$value));//розбиваємо на масив
                // if($filter==="")
                        // $filter =   $filter.$filterArr[0].' LIKE \'%'. $filterArr[1].'%\'';
                        // else
                        // $filter =   $filter.'  AND  '.$filterArr[0].' LIKE \'%' . $filterArr[1].'%\'';
                        // $filter =   $filter.' category LIKE \'%' . (str_replace('category=',"",$value) ).'%\'';
                        // else
                        // $filter =   $filter.'AND category LIKE \'%' . (str_replace('category=',"",$value) ).'%\'';
            //    }elsei
            if(strpos($value, 'filter=')!==false){//Пошук по всіх розділах
                // echo"777777";
                        $temp = str_replace('filter=',"",$value);//Відкидаємо слово фільтер filter=   лишаємо запрос TV
                        // $filterArr = explode('=', str_replace('filter-',"",$value));//розбиваємо на масив
                        // echo $temp;
                        if($filter==="")
                            // $filter =   'WHERE  category  LIKE \'%' . $temp. '%\' OR  kod_product  LIKE \'%' . $temp. '%\' OR kod_product  LIKE \'%  '.$temp.'%\ ';
                            $filter =   'WHERE  category  LIKE \'%'. $temp. '%\' OR  kod_product  LIKE \'%' . $temp . '%\' OR  oldPrice  LIKE \'%' . $temp. '%\' ';
                            // $filter =   'WHERE  category  LIKE \'%'. $temp. '%\'  ';

                            // else
                            // $filter =   $filter.'  AND  '.$filterArr[0].' LIKE \'%' . $filterArr[1].'%\'';
                            // echo $filter;
                    }elseif(strpos($value, 'filter-')!==false){//Пошук по окремих колонках розділах
                // echo"4444444";
                        $temp = str_replace('filter-',"",$value);//Відкидаємо слово фільтер filter-   лишаємо запрос title=TV
                        $filterArr = explode('=', str_replace('filter-',"",$value));//розбиваємо на масив
                        if($filter==="")
                            $filter =   'WHERE '.$filterArr[0].' LIKE \'%'. $filterArr[1].'%\'';
                                else
                            $filter =   $filter.'  AND  '.$filterArr[0].' LIKE \'%' . $filterArr[1].'%\'';
                            // echo $filter;
                    }elseif(strpos($value, 'limit=')!==false){
                // echo"55555";
                        $temp = str_replace('limit=',"",$value);//Відкидаємо слово фільтер limit=   лишаємо запрос title=TV
                        // $filterArr = explode('=', str_replace('filter-',"",$value));//розбиваємо на масив
                        if($temp>0)
                     
                  
                            // $filter =   $filter.' LIMIT '.$temp;
                            // echo $filter;
                            if($filter!=="")
                            return "SELECT * FROM `Shop`  $filter  LIMIT  $temp";
                            // else 
                            // return "SELECT * FROM `Shop` LIMIT 20";
                    }elseif(strpos($value, 'page-')!==false){

                    }
                    
                }
        
                if($filter!=="")
                return "SELECT * FROM `Shop`  $filter";
                // else 
                // return "SELECT * FROM `Shop` LIMIT 20";
            // $answerSql = mysqli_query($connect, "SELECT * FROM `shop` WHERE category LIKE '%Побутова_техніка%' " );
            // $answerSql= mysqli_query($connect, "SELECT * FROM `Shop` WHERE $filter");
            // $this->outJson($answerSql);
        }else{ $this->errorCode(404, "Post not found"); }//Якщо нічого не совпало
    }
//********************************************************************* */
}


function addPost($connect, $data, $type){
    
    $id = $data['id'];
    $category = $data['catalog'];
    $oldPrice = $data['oldPrice'];
    $newPrice = $data['newPrice'];
    $title = $data['title'];
    $images = $data['images'];
    $images = json_encode($images, JSON_UNESCAPED_UNICODE );
    $parameters = $data['parametrs'];
    $parameters = json_encode($parameters,  JSON_UNESCAPED_UNICODE );
    
    // $rez = mysqli_query($connect, "INSERT INTO `Shop` (`kod_product`, `category`,`oldPrice`, `newPrice`, `title`) 
    // VALUES (  '$id', '$category', '$oldPrice','$newPrice', '$title')");

$rez = mysqli_query($connect, "INSERT INTO `Shop` (`kod_product`, `category`,`oldPrice`, `newPrice`, `title`, `images`, `parameters`) 
VALUES (  '$id', '$category', '$oldPrice','$newPrice', '$title','$images','$parameters' )");
// $rez = mysqli_query($connect, "INSERT INTO `Shop` (`kod_product`, `category`,`oldPrice`, `newPrice`, `title`, `images`) 
// VALUES (  '$id', '$category', '$oldPrice','$newPrice', '$title','$images' )");
    mysqli_query($connect, "INSERT INTO `posts`(`Name`, `text`) VALUES ( '$id', '$rez')");

    // mysqli_query($connect, "INSERT INTO `Shop` (`kod_product`, `category`,`oldPrice`, `newPrice`,  `title`) 
    // VALUES (  '$id', '$category', '$oldPrice','$newPrice', '$title')");

    http_response_code(201);
    $res = [
        "status" => true,
        "post_id" => mysqli_insert_id($connect)
    ];
    echo json_encode($res);
}

function updatePost($connect, $id, $data){
    $title = $data['title'];
    $body = $data['body'];
  mysqli_query($connect, "UPDATE `posts` SET `Name` = '$title', `text` = '$body' WHERE `posts`.`id` ='$id';  ");
    http_response_code(200);
    $res = [
        "status" => true, 
        "post_id" =>"Post is update"
    ];
    echo json_encode($res);
}

function deletePost($connect, $id, $table){
    if($id ==="ALLDELETE")mysqli_query($connect,  "DELETE FROM $table ");
    else mysqli_query($connect,  "DELETE FROM `Shop` WHERE `Shop`.`id` = '$id' ");
    http_response_code(200);
    $res = [
        "status" => true,
        "post_id" =>"Post is deleted"
    ];
    echo json_encode($res);
}










// function getPosts ($connect, $type) {
//     $posts = mysqli_query($connect, "SELECT * FROM `$type`");
    
//     $postsList = [];
//     while($post = mysqli_fetch_assoc($posts)) {
//         $postsList[] = $post;
//     }
//     echo json_encode($postsList);
// }

// function getPost($connect, $id, $type){
//     $post = mysqli_query($connect, "SELECT * FROM `$type` WHERE  `id` = '$id' ");

//     if(mysqli_num_rows($post) === 0){
//         http_response_code(404);
//         $res = [
//             "status" => false,
//             "message" => "Post not found"
//         ];
//         echo json_encode($res);
//     }else{
//         $post = mysqli_fetch_assoc($post);
//         echo json_encode($post);
//     }
  
// }


