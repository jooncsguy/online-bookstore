<?php
  // required headers
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  // include database and object files
  include_once '../config/db.php';
  include_once '../objects/author.php';

  // get database connection
  $database = new Database();
  $db = $database->getConnection();

  // prepare $author object
  $author = new Author($db);

  // set ID property of record to read
  $author->authorid = isset($_GET['authorid']) ? $_GET['authorid'] : die();
  // read the details of product to be edited
  $author->readone();

  if($author->authorid!=null){
      // create array
      $arr = array(
            "authorid" => $author->authorid,
            "authorname" =>  $author->authorname

      );
      // set response code - 200 OK
      http_response_code(200);
      echo json_encode($arr);
  }else{
      // set response code - 404 Not found
      http_response_code(404);
      echo json_encode(array("message" => "Product does not exist."));
  }
?>
