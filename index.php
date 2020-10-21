<?php
define('LINE_API',"https://notify-api.line.me/api/notify");
$token = "3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk"; //ใส่Token ที่copy เอาไว้
$str = "hello World"; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
$stickerPkg = 1; //stickerPackageId
$stickerId = 106; //stickerId
$res = notify_message($str,$stickerPkg,$stickerId,$token);
print_r($res);
function notify_message($message,$stickerPkg,$stickerId,$token){
     $queryData = array(
      'message' => $message,
      'stickerPackageId'=>$stickerPkg,
      'stickerId'=>$stickerId
     );
     $queryData = http_build_query($queryData,'','&');
     $headerOptions = array(
         'http'=>array(
             'method'=>'POST',
             'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                 ."Authorization: Bearer ".$token."\r\n"
                       ."Content-Length: ".strlen($queryData)."\r\n",
             'content' => $queryData
         ),
     );
   $context = stream_context_create($headerOptions);
   $result = file_get_contents(LINE_API,FALSE,$context);     
   $res = json_decode($result);
  return $res;  
 }

$token = "3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk"; //ใส่Token ที่copy เอาไว้
$res = notify_message($str,$stickerPkg,$stickerId,$token);
print_r($res);
notify_message(); // call the function
sleep(2);
$token = "3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk"; //ใส่Token ที่copy เอาไว้
$res = notify_message($str,$stickerPkg,$stickerId,$token);
print_r($res);
notify_message(); // call the function
$token = "3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk"; //ใส่Token ที่copy เอาไว้
$res = notify_message($str,$stickerPkg,$stickerId,$token);
print_r($res);
notify_message(); // call the function

//----------------------------------------------


?>

/*
define('LINE_API',"https://notify-api.line.me/api/notify");
$token = "3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk"; //ใส่Token ที่copy เอาไว้
$str = "hello World"; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
$stickerPkg = 1; //stickerPackageId
$stickerId = 106; //stickerId
$res = notify_message($str,$stickerPkg,$stickerId,$token);
print_r($res);
function notify_message($message,$stickerPkg,$stickerId,$token){
     $queryData = array(
      'message' => $message,
      'stickerPackageId'=>$stickerPkg,
      'stickerId'=>$stickerId
     );
     $queryData = http_build_query($queryData,'','&');
     $headerOptions = array(
         'http'=>array(
             'method'=>'POST',
             'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                 ."Authorization: Bearer ".$token."\r\n"
                       ."Content-Length: ".strlen($queryData)."\r\n",
             'content' => $queryData
         ),
     );
     $context = stream_context_create($headerOptions);
     $result = file_get_contents(LINE_API,FALSE,$context);     
     $res = json_decode($result);
  return $res;
 }


define('LINE_API', "https://notify-api.line.me/api/notify");
$token = "3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk"; //ใส่Token ที่copy เอาไว้
$params = array(
  "message"        => "อรุนสวัสดิ์ครับ", //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
  "stickerPkg"     => 1, //stickerPackageId
  "stickerId"      => 2, //stickerId
  "imageThumbnail" => "https://media.giphy.com/media/GEC49lPULGaoE/giphy.gif", // max size 240x240px JPEG
  "imageFullsize"  => "https://media.giphy.com/media/GEC49lPULGaoE/giphy.gif", //max size 1024x1024px JPEG
);
$res = notify_message($params, $token);
// print_r($res);
 
function notify_message($params, $token) {
  $queryData = array(
    'message'          => $params["message"],
    'stickerPackageId' => $params["stickerPkg"],
    'stickerId'        => $params["stickerId"],
    'imageThumbnail'   => $params["imageThumbnail"],
    'imageFullsize'    => $params["imageFullsize"],
  );
  $queryData = http_build_query($queryData, ' ', '&');
  $headerOptions = array(
    'http' => array(
      'method'  => 'POST',
      'header'  => "Content-Type: application/x-www-form-urlencoded\r\n"
      . "Authorization: Bearer " . $token . "\r\n"
      . "Content-Length: " . strlen($queryData) . "\r\n",
      'content' => $queryData,
    ),
  );
  $context = stream_context_create($headerOptions);
  $result = file_get_contents(LINE_API, FALSE, $context);
  $res = json_decode($result);
  return $res;
}



define('LINE_API', "https://notify-api.line.me/api/notify");
$token = "3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk"; //ใส่Token ที่copy เอาไว้
$params = array(
  "message"        => "อรุณสวัสดิ์ครับ", //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
  "stickerPkg"     => 1, //stickerPackageId
  "stickerId"      => 2, //stickerId
  "imageThumbnail" => "https://media.giphy.com/media/GEC49lPULGaoE/giphy.gif", // max size 240x240px JPEG
  "imageFullsize"  => "https://media.giphy.com/media/GEC49lPULGaoE/giphy.gif", //max size 1024x1024px JPEG
);
$res = notify_message($params, $token);
// print_r($res);
 
function notify_message($params, $token) {
  $queryData = array(
    'message'          => $params["message"],
    'stickerPackageId' => $params["stickerPkg"],
    'stickerId'        => $params["stickerId"],
    'imageThumbnail'   => $params["imageThumbnail"],
    'imageFullsize'    => $params["imageFullsize"],
  );
  $queryData = http_build_query($queryData, ' ', '&');
  $headerOptions = array(
    'http' => array(
      'method'  => 'POST',
      'header'  => "Content-Type: application/x-www-form-urlencoded\r\n"
      . "Authorization: Bearer " . $token . "\r\n"
      . "Content-Length: " . strlen($queryData) . "\r\n",
      'content' => $queryData,
    ),
  );
  $context = stream_context_create($headerOptions);
  $result = file_get_contents(LINE_API, FALSE, $context);
  $res = json_decode($result);
  return $res;
}
//--------------------------------------------
$token = "3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk"; //ใส่Token ที่copy เอาไว้
$res = notify_message($params, $token);
// print_r($res);
notify_message(); // call the function


*/
