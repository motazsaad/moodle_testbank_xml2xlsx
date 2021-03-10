<script>
var d = new Date();
var n = d.getTime();
var oldTime = sessionStorage.getItem("firstVisitTime");
if(oldTime !== null){
//alert("not null > "+(n - oldTime));
if(((n - oldTime) > (240000))){
sessionStorage.setItem("firstVisit", "1");
}else{
sessionStorage.setItem("firstVisit", "0");
}
}else{
//alert("is null");
sessionStorage.setItem("firstVisit", "1");	
}
var isShowBefor = sessionStorage.getItem("firstVisit");
//alert("1-> "+isShowBefor);
if (isShowBefor === "1"){
	sessionStorage.setItem("firstVisit", "0");
	isShowBefor = sessionStorage.getItem("firstVisit");
	sessionStorage.setItem("firstVisitTime", n);
	//alert("2-> "+isShowBefor);
	//NotificationSettings(TitlePopUp, MessagePopUp, URLPopUp, TargetPopUp);
}else{
//	alert("3-> "+isShowBefor);
}
</script>
<?php
/*
if (false){
$filename = $_GET['text'];
$file = 'Converted_files/'.$filename;
header('Content-Description: File Transfer');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename='.basename($file));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
ob_clean();
flush();
readfile($file);
exit();
}
*/
?>