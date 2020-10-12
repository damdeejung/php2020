/*-------------line notify----------------------
$line_api = 'https://notify-api.line.me/api/notify';
$access_token = '3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk';
$message = 'test Hello World';    //text max 1,000 charecter
$image_thumbnail_url = 'https://media.giphy.com/media/q82uvPXb0pY82hcHW6/giphy.gif';  // max size 240x240px JPEG
$image_fullsize_url = 'https://media.giphy.com/media/UBqySWuXS0Wgpf8joe/giphy.gif'; //max size 1024x1024px JPEG
$imageFile = 'copy/240.jpg';
$sticker_package_id = '1';  // Package ID sticker
$sticker_id = '2';    // ID sticker
$message_data = array(
'imageThumbnail' => $image_thumbnail_url,
'imageFullsize' => $image_fullsize_url,
'message' => $message,
'imageFile' => $imageFile,
'stickerPackageId' => $sticker_package_id,
'stickerId' => $sticker_id
);
$result = send_notify_message($line_api, $access_token, $message_data);
echo '<pre>';
print_r($result);
echo '</pre>';
}
/*-------------line noti----------------------
function send_notify_message($line_api, $access_token, $message_data){
$headers = array('Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer '.$access_token );
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $line_api);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, $message_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
// Check Error
if(curl_error($ch))
{
$return_array = array( 'status' => '000: send fail', 'message' => curl_error($ch) );
}
else
{
$return_array = json_decode($result, true);
}
curl_close($ch);
return $return_array;
}
------------------------------------------------------------------------*/
<?php
define('LINE_API',"https://notify-api.line.me/api/notify");
$token = "3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk"; //ใส่Token ที่copy เอาไว้
$str = "Hello World"; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
$stickerPkg = 2; //stickerPackageId
$stickerId = 34; //stickerId
 
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

?>
