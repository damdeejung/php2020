<?php
//$cv = curl_init();
// ตั้ง Url สำหรับดึงข้อมูล 
//curl_setopt($cv, CURLOPT_URL, “https://covid19.th-stat.com/api/open/today");
//header (‘Content-type: text/html; charset=utf-8’);
//curl_setopt($cv, CURLOPT_RETURNTRANSFER, 1);
// ตัวแปร $output เก็บข้อมูลทั้งหมดที่ดึงมา 
//$output = curl_exec($cv);
//$js_array=json_decode($output, true);

define('LINE_API', "https://notify-api.line.me/api/notify");
$token = "3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk"; //dk
$params = array(
//  "message"        => "อรุณสวัสดิ์ครับ", //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
	
//	$data = array(
 "message" => "รายงานสถานการณ์โควิท"
//ผู้ติดเชื้อ : ‘.$js_array[‘Confirmed’].’ คน
//เสียชีวิต : ‘.$js_array[‘Deaths’].’ คน
//หายแล้ว : ‘.$js_array[‘Recovered’].’ คน
//รักษาตัว : ‘.$js_array[‘Hospitalized’].’ คน
//เวลาล่าสุด : ‘.$js_array[‘UpdateDate’].’’ "
	    
  "stickerPkg"     => 1, //stickerPackageId
  "stickerId"      => 2, //stickerId
  //"imageThumbnail" => "https://media.giphy.com/media/KUZIh9xzcTNvkyZJFn/giphy.gif", // max size 240x240px JPEG
  //"imageFullsize"  => "https://media.giphy.com/media/KUZIh9xzcTNvkyZJFn/giphy.gif", //max size 1024x1024px JPEG
);
$res = notify_message($params, $token);
print_r($res);
 
function notify_message($params, $token) {
  $queryData = array(
    'message'          => $params["message"],
    'stickerPackageId' => $params["stickerPkg"],
    'stickerId'        => $params["stickerId"],
    //'imageThumbnail'   => $params["imageThumbnail"],
    //'imageFullsize'    => $params["imageFullsize"],
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

/*************
$notifyURL = “https://notify-api.line.me/api/notify";
$accToken = “3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk”;
$headers = array(
 ‘Content-Type: application/x-www-form-urlencoded’,
 ‘Authorization: Bearer ‘.$accToken
);
	    
$data = array(
 ‘message’ => ‘
รายงานสถานการณ์โควิท
ผู้ติดเชื้อ : ‘.$js_array[‘Confirmed’].’ คน
เสียชีวิต : ‘.$js_array[‘Deaths’].’ คน
หายแล้ว : ‘.$js_array[‘Recovered’].’ คน
รักษาตัว : ‘.$js_array[‘Hospitalized’].’ คน
เวลาล่าสุด : ‘.$js_array[‘UpdateDate’].’’ );
	    
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, $notifyURL);
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2); 
curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 1); 
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec( $ch );
curl_close( $ch );
 
var_dump($result);
$result = json_decode($result,TRUE);
	    
	    
	    
/////////////////// ดึงข่าว ////////////////
//$ch = curl_init('https://www.thairath.co.th/rss/news'); //แหล่งข่าว
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_HEADER, 0);
//$contents = curl_exec($ch);
//curl_close($ch);
 
//$xml = new SimpleXmlElement($contents);
//for($i=0; $i<count($xml->channel->item); $i++){
//	for($i=0; $i<5; $i++){
//$title = $xml->channel->item[$i]->title;
//$url = $xml->channel->item[$i]->link;
//$description = $xml->channel->item[$i]->description;
//$news .= $title."\n".$url."\n\n";


/////////////////////////////////////
/********
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

$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer 3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk', ); //damdee
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
//RETURN
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec( $chOne ); 



 
//Check error 
if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); } 
else { $result_ = json_decode($result, true); 
echo "status : ".$result_['status']; echo "message : ". $result_['message']; } 
//Close connect 
curl_close( $chOne ); 
*/////--------------------------------

?>
