<?php

/////////////////// ดึงข่าว ////////////////
$ch = curl_init('https://www.thairath.co.th/rss/news'); //แหล่งข่าว
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$contents = curl_exec($ch);
curl_close($ch);
 
$xml = new SimpleXmlElement($contents);
//for($i=0; $i<count($xml->channel->item); $i++){
	for($i=0; $i<5; $i++){
$url = $xml->channel->item[$i]->link;
$title = $xml->channel->item[$i]->title;
$description = $xml->channel->item[$i]->description;
$news .= $title."\n".$url."\n\n";

}
/////////////////////////////////////

$message = $_REQUEST['message'];
$chOne = curl_init(); 
curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
// SSL USE 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
//POST 
curl_setopt( $chOne, CURLOPT_POST, 1); 
// Message 
curl_setopt( $chOne, CURLOPT_POSTFIELDS, $message); 
//ถ้าต้องการใส่รุป ให้ใส่ 2 parameter imageThumbnail และimageFullsize
curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$news"); 
// follow redirects 
curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
//ADD header array
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer O4iWswQxqWbRkbPszlzLea8sdqvvI2fIMEb9pRF6VpY', ); //หรียญทอง
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
//RETURN
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec( $chOne ); 

$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer 0btH1CvWA5iJcJoNBV2ATVUV7zOovtewuZbSHfCY9HI', ); //ชุมแสง
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);	
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec( $chOne );
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer osvs6eFcvIQWdA8gwI1rxdITHbmTWFB2CT7RpW3Q3Pv', ); //เก๋งทองคำ
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec( $chOne ); 	
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer vs1Hs0LqnDTJZQ9wWhs2hu0aiyAKexXFfg8N8tjB5eb', ); //นิตยา
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec( $chOne );
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer rU5QQMxtA8VE3gWzGmyE9R4GYA3kjIQrArcU0UIKevq', ); //ปัญจ
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec( $chOne );
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer fwEJpjy74gqS2i6T08BVKxUqCsNBckXC19J427yHGYk', ); //ดำบรรณ
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec( $chOne );

 
//Check error 
if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); } 
else { $result_ = json_decode($result, true); 
echo "status : ".$result_['status']; echo "message : ". $result_['message']; } 
//Close connect 
curl_close( $chOne ); 


?>



/***********************************************************************************************
<?php
$cv = curl_init();// ตั้ง Url สำหรับดึงข้อมูล 
curl_setopt($cv, CURLOPT_URL, “https://covid19.th-stat.com/api/open/today");
header (‘Content-type: text/html; charset=utf-8’);
curl_setopt($cv, CURLOPT_RETURNTRANSFER, 1);// ตัวแปร $output เก็บข้อมูลทั้งหมดที่ดึงมา 
$output = curl_exec($cv);
$js_array=json_decode($output, true);
//$notifyURL = “https://notify-api.line.me/api/notify";
//$accToken = “3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk”; //damdee

$line_api = 'https://notify-api.line.me/api/notify';
$access_token = '3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk';

//$str = 'ทดสอบข้อความ';    //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
//$image_thumbnail_url = 'https://media.giphy.com/media/JAnseEvaGvviN9enPX/giphy.gif';  // ขนาดสูงสุด 240×240px JPEG
//$image_fullsize_url = 'https://media.giphy.com/media/JAnseEvaGvviN9enPX/giphy.gif';  // ขนาดสูงสุด 1024×1024px JPEG
//$sticker_package_id = 1;  // Package ID ของสติกเกอร์
//$sticker_id = 2;    // ID ของสติกเกอร์

$message_data = array(
 ‘message’ => ‘
รายงานสถานการณ์โควิท
ผู้ติดเชื้อ : ‘.$js_array[‘Confirmed’].’ คน
เสียชีวิต : ‘.$js_array[‘Deaths’].’ คน
หายแล้ว : ‘.$js_array[‘Recovered’].’ คน
รักษาตัว : ‘.$js_array[‘Hospitalized’].’ คน
เวลาล่าสุด : ‘.$js_array[‘UpdateDate’].’’ 
);
            
            
//$message_data = array(
 //'message' => $str,
 //'imageThumbnail' => $image_thumbnail_url,
 //'imageFullsize' => $image_fullsize_url,
 //'stickerPackageId' => $sticker_package_id,
 //'stickerId' => $sticker_id
//);

$result = send_notify_message($line_api, $access_token, $message_data);
print_r($result);

function send_notify_message($line_api, $access_token, $message_data)
{
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
//-----------------------------------------

//$access_token = '3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk';
//$result = send_notify_message($line_api, $access_token, $message_data);
//print_r($result);
//send_notify_message();



?>
*/////////////////////////////////////////////////////////////////////////////////////////////////////
