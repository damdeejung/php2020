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
