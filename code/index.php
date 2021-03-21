<html dir="rtl" lang="ar">
<!--/*
- The function of this program is to convert XML files in moodle platform format into excel.
- Islamic University - Gaza.
- Developed by: Abd Alaziz M. Alswasis.
- @2021-2022
*/-->
<head>
<meta charset="utf-8">
</head>
<body>
<center>
<br/><br/>
<center><h1>تحويل بنوك الأسئلة من ملفات XML الى Excel</h1></center>
<form name="form" method="POST" action="" enctype="multipart/form-data" >
  <label for="cars">إختر نوع بنك الأسئلة:</label>
  <select name="type_question" id="cars">
    <option value="--">--</option>
    <option value="True-Flase">صح او خطأ</option>
    <option value="Multi-choice">إختيار من متعدد</option>
    <option value="Matching">مصطلح</option>
	<option value="Random-Matching">مصطلح عشوائي</option>
    <option value="Order">ترتيب</option>
    <option value="Exam">جميع الأنواع</option>
  </select>
  <br><br>
<input type="file" name="my_file"/><br/><br/>
<input type="submit" name="submit" value="إرسال الملف"/>
</form>
</center>
</body>
</html>

<?php
/** Include PHPExcel */
require_once("Classes/PHPExcel.php");
deleteFilesAfter24Hours();
$array_filename = array();
//////////////////////////////////////////////////////////////////
function iniValue($typeQuestion , $path){
//echo $path;
if(strlen($path) > 5){
	//echo "".strlen($path);
	echo "<br>";
//Create a P1HPExcel object
$objPHPExcel = new PHPExcel();

// Set default font
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(12);

//Rename the worksheet
$objPHPExcel->getActiveSheet()->setTitle('exam info');
// right-to-left worksheet
$objPHPExcel->getActiveSheet()->setRightToLeft(true);
//Set active worksheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

if (($typeQuestion == "True-Flase")){
//Set the first row as the header rows
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ترقيم السؤال')
							  ->setCellValue('B1', 'تصنيف السؤال')
							  ->setCellValue('C1', 'اسم السؤال')
							  ->setCellValue('D1', 'السؤال')
							  ->setCellValue('E1', 'الإجابة');
convertFileFromXmlToExcel_TrueFalse($path, $objPHPExcel, "TrueFlase", "لقد قمت بإختيار نوع تصنيف خاطئ يرجى المحاولة مرة اخرى.");
}else if($typeQuestion == "Multi-choice"){
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ترقيم السؤال')
                              ->setCellValue('B1', 'تصنيف السؤال')
                              ->setCellValue('C1', 'اسم السؤال')
							  ->setCellValue('D1', 'السؤال')
							  ->setCellValue('E1', 'إجابة 1')
							  ->setCellValue('F1', 'إجابة 2')
							  ->setCellValue('G1', 'إجابة 3')
							  ->setCellValue('H1', 'إجابة 4')
							  ->setCellValue('I1', 'رقم الإجابة الصحيحة')
							  ->setCellValue('J1', 'عدم ترتيب الإجابات عشوائيا');
convertFileFromXmlToExcel_MultiChoice($path, $objPHPExcel, "Multichoice", "لقد قمت بإختيار نوع تصنيف خاطئ يرجى المحاولة مرة اخرى.");
}else if($typeQuestion == "Matching"){
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ترقيم السؤال')
                              ->setCellValue('B1', 'تصنيف السؤال')
                              ->setCellValue('C1', 'اسم السؤال')
							  ->setCellValue('D1', 'السؤال')
							  ->setCellValue('E1', 'الإجابة الصحيحة')
							  ->setCellValue('F1', 'الإجابات المتاحة');
							  //->setCellValue('E1', 'A3')
							  //->setCellValue('F1', 'A4');
							  //->setCellValue('C1', 'answer');
convertFileFromXmlToExcel_Matching($path, $objPHPExcel, "Matching", "لقد قمت بإختيار نوع تصنيف خاطئ يرجى المحاولة مرة اخرى.");
}else if($typeQuestion == "Random-Matching"){
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ترقيم السؤال')
                              ->setCellValue('B1', 'تصنيف السؤال')
							  ->setCellValue('C1', 'اسم السؤال')
							  ->setCellValue('D1', 'السؤال')
							  ->setCellValue('E1', 'الإجابة');
convertFileFromXmlToExcel_ShortAnswer($path, $objPHPExcel, "Random-Matching", "لقد قمت بإختيار نوع تصنيف خاطئ يرجى المحاولة مرة اخرى.");
}else if($typeQuestion == "Order"){
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ترقيم السؤال')
                              ->setCellValue('B1', 'تصنيف السؤال')
                              ->setCellValue('C1', 'اسم السؤال')
							  ->setCellValue('D1', 'السؤال')
							  ->setCellValue('E1', 'الترتيب 1')
							  ->setCellValue('F1', 'الترتيب 2')
							  ->setCellValue('G1', 'الترتيب 3')
							  ->setCellValue('H1', 'الترتيب 4')
							  ->setCellValue('I1', 'الترتيب 5')
							  ->setCellValue('J1', 'الترتيب 6')
							  ->setCellValue('K1', 'الترتيب 7')
							  ->setCellValue('L1', 'الترتيب 8')
							  ->setCellValue('M1', 'الترتيب 9')
							  ->setCellValue('N1', 'الترتيب 10');
convertFileFromXmlToExcel_Order($path, $objPHPExcel, "Order", "لقد قمت بإختيار نوع تصنيف خاطئ يرجى المحاولة مرة اخرى.");
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else if($typeQuestion == "Exam"){

	//$qTypeIndex = 0
	for ($qTypeIndex = 1; $qTypeIndex <= 5; $qTypeIndex++) {
	if ($qTypeIndex == 1){
		////////////////////////////////////////////////////////////////////
	//echo $qTypeIndex."- >>>>>>>>>>>>>>>>>>>>>>> True-Flase <br>";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(12);
	$objPHPExcel->getActiveSheet()->setTitle('exam info');
	// right-to-left worksheet
    $objPHPExcel->getActiveSheet()->setRightToLeft(true);
	$objPHPExcel->setActiveSheetIndex(0);
////////////////////////////////////////////////////////////////////
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ترقيم السؤال')
							  ->setCellValue('B1', 'تصنيف السؤال')
							  ->setCellValue('C1', 'اسم السؤال')
							  ->setCellValue('D1', 'السؤال')
							  ->setCellValue('E1', 'الإجابة');
convertFileFromXmlToExcel_TrueFalse($path, $objPHPExcel, "TrueFlase", "لا يوجد أسئلة صح وخطأ.");
}else if($qTypeIndex == 2){
	////////////////////////////////////////////////////////////////////
    //echo $qTypeIndex."- >>>>>>>>>>>>>>>>>>>>>>> Multi-choice <br>";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(12);
	$objPHPExcel->getActiveSheet()->setTitle('exam info');
	$objPHPExcel->getActiveSheet()->setRightToLeft(true);
	$objPHPExcel->setActiveSheetIndex(0);
////////////////////////////////////////////////////////////////////
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ترقيم السؤال')
                              ->setCellValue('B1', 'تصنيف السؤال')
                              ->setCellValue('C1', 'اسم السؤال')
							  ->setCellValue('D1', 'السؤال')
							  ->setCellValue('E1', 'إجابة 1')
							  ->setCellValue('F1', 'إجابة 2')
							  ->setCellValue('G1', 'إجابة 3')
							  ->setCellValue('H1', 'إجابة 4')
							  ->setCellValue('I1', 'رقم الإجابة الصحيحة')
							  ->setCellValue('J1', 'عدم ترتيب الإجابات عشوائيا');
convertFileFromXmlToExcel_MultiChoice($path, $objPHPExcel, "Multichoice", "لا يوجد أسئلة إختيار من متعدد.");
}else if($qTypeIndex == 3){
	////////////////////////////////////////////////////////////////////
	//echo $qTypeIndex."- >>>>>>>>>>>>>>>>>>>>>>> Matching <br>";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(12);
	$objPHPExcel->getActiveSheet()->setTitle('exam info');
	$objPHPExcel->getActiveSheet()->setRightToLeft(true);
	$objPHPExcel->setActiveSheetIndex(0);
////////////////////////////////////////////////////////////////////
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ترقيم السؤال')
                              ->setCellValue('B1', 'تصنيف السؤال')
                              ->setCellValue('C1', 'اسم السؤال')
							  ->setCellValue('D1', 'السؤال')
							  ->setCellValue('E1', 'الإجابة الصحيحة')
							  ->setCellValue('F1', 'الإجابات المتاحة');
							  //->setCellValue('E1', 'A3')
							  //->setCellValue('F1', 'A4');
							  //->setCellValue('C1', 'answer');
convertFileFromXmlToExcel_Matching($path, $objPHPExcel, "Matching", "لا يوجد اسئلة مصطلح.");
}else if($qTypeIndex == 4){
	////////////////////////////////////////////////////////////////////
	//echo $qTypeIndex."- >>>>>>>>>>>>>>>>>>>>>>> Order <br>";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(12);
	$objPHPExcel->getActiveSheet()->setTitle('exam info');
	$objPHPExcel->getActiveSheet()->setRightToLeft(true);
	$objPHPExcel->setActiveSheetIndex(0);
////////////////////////////////////////////////////////////////////
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID')
                              ->setCellValue('B1', 'Category')
                              ->setCellValue('C1', 'Name Question')
							  ->setCellValue('D1', 'Question')
							  ->setCellValue('E1', '1')
							  ->setCellValue('F1', '2')
							  ->setCellValue('G1', '3')
							  ->setCellValue('H1', '4')
							  ->setCellValue('I1', '5')
							  ->setCellValue('J1', '6')
							  ->setCellValue('K1', '7')
							  ->setCellValue('L1', '8')
							  ->setCellValue('M1', '9')
							  ->setCellValue('N1', '10');
convertFileFromXmlToExcel_Order($path, $objPHPExcel, "Order", "لا يوجد أسئلة ترتيب.");
}else if ($qTypeIndex == 5){
		////////////////////////////////////////////////////////////////////
	//echo $qTypeIndex."- >>>>>>>>>>>>>>>>>>>>>>> ShortAnswer <br>";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(12);
	$objPHPExcel->getActiveSheet()->setTitle('exam info');
	$objPHPExcel->getActiveSheet()->setRightToLeft(true);
	$objPHPExcel->setActiveSheetIndex(0);
////////////////////////////////////////////////////////////////////
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ترقيم السؤال')
                              ->setCellValue('B1', 'تصنيف السؤال')
							  ->setCellValue('C1', 'اسم السؤال')
							  ->setCellValue('D1', 'السؤال')
							  ->setCellValue('E1', 'الإجابة');
convertFileFromXmlToExcel_ShortAnswer($path, $objPHPExcel, "Random-Matching", "لا يوجد أسئلة مصطلح عشوائية.");
}
	}
}
////////////////////////////////////////////////////////////
global $array_filename;
if(count($array_filename) >0){
	toDownloadCurrentFile("");
}
////////////////////////////////////////////////////////////
}else {
	echo "<h1 style='background-color:red;'>Please, Select the file to be converted...</h1>";	
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function convertFileFromXmlToExcel_TrueFalse($pathFile,$objPHPExcel, $Qtypr,$ErrorMsg){
$categoryQuestion = [];
$category = "";
$mainArrayNameQuestion = []; 
$mainArrayQuestion = [];
$mainArrayAnswer = [];
$index = 1;
//$xml=simplexml_load_file("trueandfalse.xml") or die("Error: Cannot create object");
//print_r($xml);
//echo $xml->question[0]->text;
$objDOM = new DOMDocument();
//Load xml file into DOMDocument variable
//$objDOM->load("trueandfalse.xml");
$objDOM->load($pathFile);
//Find Tag element "quiz" and return the element to variable $quiz
$quiz = $objDOM->getElementsByTagName("quiz");
foreach ($quiz as $quiz_data) {
/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
$question = $quiz_data->getElementsByTagName("question");
//looping if tag config have more than one
foreach ($question as $data) {
	//print_r($question);
    $questiontext = $data->getAttribute('type');
	//print_r($type_question);
	if($questiontext == "truefalse"){
		//////
		$questiontext = $data->getElementsByTagName("name");
		foreach ($questiontext as $text) {
        //print_r($text->nodeValue);    
		$str = $text->nodeValue;
		//echo '>'.$str;
		//$a = strip_tags($str);
	    $mainArrayNameQuestion[] = trim($str);	
		//echo '<br>';
		}
		////////////////////////////////////////////////////////////////////////
		$questiontext = $data->getElementsByTagName("questiontext");
		foreach ($questiontext as $text) {
        //print_r($text->nodeValue);    
		$str = $text->nodeValue;
		$a = strip_tags($str);
	    $mainArrayQuestion[] = trim($a);
        $categoryQuestion[] = $category;
		//echo '<br>';
		}
		/////////////////////////////////////////////////////////////////////////
		$answer = $data->getElementsByTagName("answer");
		foreach ($answer as $text) {
			$questiontext = $text->getAttribute('fraction');
        if($questiontext == "100"){
		//print_r($text->nodeValue); 
	    $mainArrayAnswer[] = $text->nodeValue;			
		//echo '<br>';
		}
		}
	}else if($questiontext == "category"){
		$questiontext = $data->getElementsByTagName("category");
		foreach ($questiontext as $text) {
		$str = $text->nodeValue;
		$str = str_ireplace('$course$/top/','',$str);
	    //$mainArrayNameQuestion[] = trim($str);	
		//if (contains(trim($str),"TF")){
			 $category = trim($str);
			   //echo $str;
			   //echo '<br>';
		 //  }
	}
	}
}
}
//var_dump($mainArrayQuestion);
for($i=1; $i<=count($mainArrayQuestion); $i++){
	$ans = isArabic($mainArrayQuestion[$i-1],$mainArrayAnswer[$i-1]);
	//echo '>'.$ans;
	$objPHPExcel->getActiveSheet()->setCellValue('A'.($i+1), $i)
                               	  ->setCellValue('B'.($i+1), $categoryQuestion[$i-1])
	                              ->setCellValue('C'.($i+1), $mainArrayNameQuestion[$i-1])
    							  ->setCellValue('D'.($i+1), $mainArrayQuestion[$i-1])
						   	      ->setCellValue('E'.($i+1), $ans);								  
}
//print_r($objPHPExcel);
//////////////////////////////////////////////////////////////////
//print_r($objPHPExcel);
//Dynamic name, the combination of date and time
/*if (count($mainArrayQuestion) > 0){
$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
toDownloadCurrentFile($filename);
}*/
////////////////////////////////////////////////////////////////////////////
//echo count($mainArrayQuestion);
if(count($mainArrayQuestion)<1){
	errorTypeCategory($ErrorMsg);
}else{
	$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
    global $array_filename;
	$array_filename[] = $filename;
	/*toDownloadCurrentFile($filename);
	if(file_exists("Converted_files/".$filename)){
		//unlink("Converted_files/".$filename);
		}*/
	}
/////////////////////////////////////////////////////////////////////////////
//header("Content-type: application/xlsx");
//header("Content-Disposition: attachment;filename= Converted_files/".$filename);
//toDownloadCurrentFile(str_replace('.php', '.xlsx', "Converted_files/".$filename));
//header('Content-type: application/vnd.ms-excel');
//header('Content-Disposition: attachment; filename='.$filename);
//$objWriter->save("php://output");
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function convertFileFromXmlToExcel_MultiChoice($pathFile,$objPHPExcel, $Qtypr,$ErrorMsg){
$categoryQuestion = [];
$category = "";
$mainArrayNameQuestion = []; 
$mainArrayQuestion = [];
$mainArrayAnswer = array();
$mainArrayTrueAnswer = [];
$mainShuffleAnswers = [];
$objDOM = new DOMDocument();
$objDOM->load($pathFile);
//Find Tag element "quiz" and return the element to variable $quiz
$quiz = $objDOM->getElementsByTagName("quiz");
foreach ($quiz as $quiz_data){
/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
$question = $objDOM->getElementsByTagName("question");
//looping if tag config have more than one
$indexAnswerForQuestion = 0;
foreach ($question as $data){
	//print_r($question);
    $questiontext = $data->getAttribute('type');
	//print_r($type_question);
	$index = 1;
	$hasAnswer = false;
	//$TrueAnswer = "";
	if($questiontext == "multichoice"){
		//////
		$questiontext = $data->getElementsByTagName("name");
		foreach ($questiontext as $text) {
        //print_r($text->nodeValue);    
		$str = $text->nodeValue;
		//echo '>'.$str;
		//$a = strip_tags($str);
	    $mainArrayNameQuestion[] = trim($str);	
		//echo '<br>';
		}
		////////////////////////////////////////////////////////////////////////
		$questiontext = $data->getElementsByTagName("questiontext");
		foreach ($questiontext as $text) {
        //print_r($text->nodeValue);    
		$str = $text->nodeValue;
		$a = strip_tags($str);
	    $mainArrayQuestion[] = trim($a);
        $categoryQuestion[] = $category;		
		//echo '<br>';
		}
		////////////////////////////////////////////////////////////////////////
		$questiontext = $data->getElementsByTagName("shuffleanswers");
		//echo "isRand 1>>> ".$questiontext;
		foreach ($questiontext as $text) {
        //print_r($text->nodeValue);    
		$str = $text->nodeValue;
		//echo "isRand 2>>> ".$str;
		$a = strip_tags($str);
		if($a == "true"){
			$mainShuffleAnswers[] = "";
			//echo "isRand 1>>> ".$a;
		}else{
			$mainShuffleAnswers[] = "1";
			//echo "isRand 2>>> ".$a;			
		}	
		}
		/////////////////////////////////////////////////////////////////////////
		$answer = $data->getElementsByTagName("answer");
		foreach ($answer as $text) {
			$questiontext = $text->getAttribute('fraction');
			$q = $text->nodeValue;
		    $fq = strip_tags($q);
			$mainArrayAnswer[$indexAnswerForQuestion][] = trim($fq);
			if($questiontext == "100"){
				//print_r($text->nodeValue);
				//print_r($index);
				//$mainArrayAnswer[] = $text->nodeValue;
				//$TrueAnswer = $TrueAnswer ." + ". $index;	
				$mainArrayTrueAnswer[] = $index;	
                $hasAnswer = true;				
				//echo '<br>';
				//echo $fq.' >>> '.$index;
				}
				$index++;
		}
		if (!$hasAnswer){
			$mainArrayTrueAnswer[] = -1;
		}
		$indexAnswerForQuestion++;
	}else if($questiontext == "category"){
		$questiontext = $data->getElementsByTagName("category");
		foreach ($questiontext as $text) {
		$str = $text->nodeValue;
		$str = str_ireplace('$course$/top/','',$str);
	    //$mainArrayNameQuestion[] = trim($str);	
		//if (contains(trim($str),"MC")){
			 $category = trim($str);
			   //echo $str;
			   //echo '<br>';
		  // }
	}
	}
}
}
error_reporting(E_ALL ^ E_NOTICE);
//echo count($mainArrayTrueAnswer);
for($i=1; $i<=count($mainArrayQuestion); $i++){
	try{
	$objPHPExcel->getActiveSheet()->setCellValue('A'.($i+1), $i)
	                              ->setCellValue('B'.($i+1), $categoryQuestion[$i-1])
    							  ->setCellValue('C'.($i+1), $mainArrayNameQuestion[$i-1])
								  ->setCellValue('D'.($i+1), $mainArrayQuestion[$i-1])
						   	      ->setCellValue('E'.($i+1), $mainArrayAnswer[$i-1][0])
							      ->setCellValue('F'.($i+1), $mainArrayAnswer[$i-1][1])
							      ->setCellValue('G'.($i+1), $mainArrayAnswer[$i-1][2])
							      ->setCellValue('H'.($i+1), $mainArrayAnswer[$i-1][3])
							      ->setCellValue('I'.($i+1), $mainArrayTrueAnswer[$i-1])
								  ->setCellValue('J'.($i+1), $mainShuffleAnswers[$i-1]);
	}catch(Exception $e) {
		echo 'Error in number of element...';
		}								  
}
//////////////////////////////////////////////////////////////////
/*if (count($mainArrayQuestion) > 0){
$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
toDownloadCurrentFile($filename);
}*/
////////////////////////////////////////////////////////////////////////////
//echo count($mainArrayQuestion);
if(count($mainArrayQuestion)<1){
	errorTypeCategory($ErrorMsg);
}else{
	$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
	global $array_filename;
	$array_filename[] = $filename;
	}
/////////////////////////////////////////////////////////////////////////////
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function convertFileFromXmlToExcel_Matching($pathFile,$objPHPExcel, $Qtypr,$ErrorMsg){
$categoryQuestion = [];
$category = "";
$mainArrayNameQuestion = []; 
$QName = "";
$mainArrayQuestion = array();
$mainArrayAnswer = [];
$objDOM = new DOMDocument();
$objDOM->load($pathFile);
//Find Tag element "quiz" and return the element to variable $quiz
$quiz = $objDOM->getElementsByTagName("quiz");
foreach ($quiz as $quiz_data) {
/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
$question = $objDOM->getElementsByTagName("question");
//looping if tag config have more than one
$indexAnswerForQuestion = 0;
$index = 0;
foreach ($question as $data) {
	//print_r($question);
    $questiontext = $data->getAttribute('type');
	//print_r($type_question);
	//$TrueAnswer = "";
	if($questiontext == "matching"){
		//////
		$questiontext2 = $data->getElementsByTagName("name");
		foreach ($questiontext2 as $text2) {
        //print_r($text->nodeValue);    
		$str2 = $text2->nodeValue;
		//echo '>'.$str;
		//$a = strip_tags($str);
		$QName = trim($str2);	
	    //$mainArrayNameQuestion[] = trim($str2);	
		}
		////////////////////////////////////////////////////////////////////////
		$itemCount = 0;
		$questiontext = $data->getElementsByTagName("subquestion");
		//print_r($questiontext->length);
		foreach ($questiontext as $text) {
		$q = $text->childNodes[1]->nodeValue;
		$a = $text->childNodes[3]->nodeValue;
		//$str = $text->item(0);
		$q = strip_tags($q);
		$a = strip_tags($a);
					
	    if ($q != ""){
		//print_r($q);
		//print_r($a);
		$mainArrayQuestion[$index][0] = trim($q);		
		$mainArrayQuestion[$index][1] = trim($a);
		$mainArrayNameQuestion[] = $QName;
		$categoryQuestion[] = $category;
		$index++;
		$itemCount++;
		}
		//echo '<br>';
		}
		/////////////////////////////////////////////////////////////////////////
		$answer = $data->getElementsByTagName("answer");
		$allAnswer = "";
		foreach ($answer as $text) {
			//$questiontext = $text->getAttribute('fraction');
			$q = $text->nodeValue;
		    $fq = strip_tags($q);
			$allAnswer = trim($fq).", ".trim($allAnswer); 
			//$mainArrayAnswer[] = $fq;
		}
		
		for($i=1; $i<=$itemCount; $i++){
		$mainArrayAnswer[] = trim($allAnswer); 
		}
		
	}else if($questiontext == "category"){
		$questiontext = $data->getElementsByTagName("category");
		foreach ($questiontext as $text) {
		$str = $text->nodeValue;
		$str = str_ireplace('$course$/top/','',$str);
	    //$mainArrayNameQuestion[] = trim($str);	
		//if (contains(trim($str),"MQ")){
			 $category = trim($str);
			   //echo $str;
			   //echo '<br>';
		  // }
	}
	}
}
}
//print_r(count($mainArrayAnswer));
for($i=1; $i<=$index; $i++){
	$objPHPExcel->getActiveSheet()->setCellValue('A'.($i+1), $i)
    							  ->setCellValue('B'.($i+1), $categoryQuestion[$i-1])
								  ->setCellValue('C'.($i+1), $mainArrayNameQuestion[$i-1])
								  ->setCellValue('D'.($i+1), $mainArrayQuestion[$i-1][0])
							      ->setCellValue('E'.($i+1), $mainArrayQuestion[$i-1][1])
								  ->setCellValue('F'.($i+1), $mainArrayAnswer[$i-1]);								  
}
//////////////////////////////////////////////////////////////////
/*if (count($mainArrayQuestion) > 0){
$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
toDownloadCurrentFile($filename);
}*/
////////////////////////////////////////////////////////////////////////////
//echo count($mainArrayQuestion);
if(count($mainArrayQuestion)<1){
	errorTypeCategory($ErrorMsg);
}else{
	$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
	global $array_filename;
	$array_filename[] = $filename;
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function convertFileFromXmlToExcel_ShortAnswer($pathFile,$objPHPExcel, $Qtypr,$ErrorMsg){
$categoryQuestion = [];
$category = "";
$mainArrayNameQuestion = []; 
$mainArrayQuestion = [];
$mainArrayAnswer = [];
$index = 1;
//$xml=simplexml_load_file("trueandfalse.xml") or die("Error: Cannot create object");
//print_r($xml);
//echo $xml->question[0]->text;
$objDOM = new DOMDocument();
//Load xml file into DOMDocument variable
//$objDOM->load("trueandfalse.xml");
$objDOM->load($pathFile);
//Find Tag element "quiz" and return the element to variable $quiz
$quiz = $objDOM->getElementsByTagName("quiz");
foreach ($quiz as $quiz_data){
/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
$question = $objDOM->getElementsByTagName("question");
//looping if tag config have more than one
foreach ($question as $data) {
	//print_r($question);
    $questiontext = $data->getAttribute('type');
	//print_r($type_question);
	if($questiontext == "shortanswer"){
		//////
		$questiontext = $data->getElementsByTagName("name");
		foreach ($questiontext as $text) {
        //print_r($text->nodeValue);    
		$str = $text->nodeValue;
		//echo '>'.$str;
		//$a = strip_tags($str);
	    $mainArrayNameQuestion[] = trim($str);	
		//echo '<br>';
		}
		////////////////////////////////////////////////////////////////////////
		$questiontext = $data->getElementsByTagName("questiontext");
		foreach ($questiontext as $text) {
        //print_r($text->nodeValue);    
		$str = $text->nodeValue;
		$a = strip_tags($str);
	    $mainArrayQuestion[] = trim($a);
		$categoryQuestion[] = $category;
		//echo '<br>';
		}
		/////////////////////////////////////////////////////////////////////////
		$answer = $data->getElementsByTagName("answer");
		foreach ($answer as $text) {
			$questiontext = $text->getAttribute('fraction');
        if($questiontext == "100"){
		//print_r($text->nodeValue); 
	    $mainArrayAnswer[] = $text->nodeValue;			
		//echo '<br>';
		}
		}
	}else if($questiontext == "category"){
		$questiontext = $data->getElementsByTagName("category");
		foreach ($questiontext as $text) {
		$str = $text->nodeValue;
		$str = str_ireplace('$course$/top/','',$str);
	    //$mainArrayNameQuestion[] = trim($str);	
		//if (contains(trim($str),"")){
			 $category = trim($str);
			   //echo $str;
			   //echo '<br>';
		 //  }
	}
	}
}
}
//var_dump($mainArrayQuestion);
for($i=1; $i<=count($mainArrayQuestion); $i++){
	$ans = trim($mainArrayAnswer[$i-1]);
	$objPHPExcel->getActiveSheet()->setCellValue('A'.($i+1), $i)
	                              ->setCellValue('B'.($i+1), $categoryQuestion[$i-1])
	                              ->setCellValue('C'.($i+1), $mainArrayNameQuestion[$i-1])
    							  ->setCellValue('D'.($i+1), $mainArrayQuestion[$i-1])
						   	      ->setCellValue('E'.($i+1), $ans);								  
}
//print_r($objPHPExcel);
//////////////////////////////////////////////////////////////////
//print_r($objPHPExcel);
//Dynamic name, the combination of date and time
/*if (count($mainArrayQuestion) > 0){
$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
toDownloadCurrentFile($filename);
}*/
////////////////////////////////////////////////////////////////////////////
//echo count($mainArrayQuestion);
if(count($mainArrayQuestion)<1){
	errorTypeCategory($ErrorMsg);
}else{
	$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
	global $array_filename;
	$array_filename[] = $filename;
	}
///////////////////////////////////////////////////////////////////////////
//header("Content-type: application/xlsx");
//header("Content-Disposition: attachment;filename= Converted_files/".$filename);
//toDownloadCurrentFile(str_replace('.php', '.xlsx', "Converted_files/".$filename));
//header('Content-type: application/vnd.ms-excel');
//header('Content-Disposition: attachment; filename='.$filename);
//$objWriter->save("php://output");
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function convertFileFromXmlToExcel_Order($pathFile,$objPHPExcel, $Qtypr,$ErrorMsg){
$categoryQuestion = [];
$category = "";
$mainArrayNameQuestion = []; 
$mainArrayQuestion = [];
$mainArrayAnswer = array();
$mainArrayTrueAnswer = [];
$objDOM = new DOMDocument();
$objDOM->load($pathFile);
//Find Tag element "quiz" and return the element to variable $quiz
$quiz = $objDOM->getElementsByTagName("quiz");
foreach ($quiz as $quiz_data){
/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
$question = $objDOM->getElementsByTagName("question");
//looping if tag config have more than one
$indexAnswerForQuestion = 0;
foreach ($question as $data) {
	//print_r($question);
    $questiontext = $data->getAttribute('type');
	//print_r($type_question);
	$index = 1;
	//$TrueAnswer = "";
	if($questiontext == "ordering"){
		//////
		$questiontext = $data->getElementsByTagName("name");
		foreach ($questiontext as $text) {
        //print_r($text->nodeValue);    
		$str = $text->nodeValue;
		//echo '>'.$str;
		//$a = strip_tags($str);
	    $mainArrayNameQuestion[] = trim($str);	
		//echo '<br>';
		}
		////////////////////////////////////////////////////////////////////////
		$questiontext = $data->getElementsByTagName("questiontext");
		foreach ($questiontext as $text) {
        //print_r($text->nodeValue);    
		$str = $text->nodeValue;
		$a = strip_tags($str);
	    $mainArrayQuestion[] = trim($a);	
		$categoryQuestion[] = $category;
		//echo '<br>';
		}
		/////////////////////////////////////////////////////////////////////////
		//echo intval($floatValue);    // Returns 4
		$answer = $data->getElementsByTagName("answer");
		foreach ($answer as $text) {
			$orderNumber = $text->getAttribute('fraction');
			$valAnswer = $text->nodeValue;
		    $fq = strip_tags($valAnswer);
			$mainArrayAnswer[$indexAnswerForQuestion][] = trim($fq);
		}
		$indexAnswerForQuestion++;
	}else if($questiontext == "category"){
		$questiontext = $data->getElementsByTagName("category");
		foreach ($questiontext as $text) {
		$str = $text->nodeValue;
		$str = str_ireplace('$course$/top/','',$str);
	    //$mainArrayNameQuestion[] = trim($str);	
		//if (contains(trim($str),"TF")){
			 $category = trim($str);
			   //echo $str;
			   //echo '<br>';
		//   }
	}
	}
}
}
// Report all errors except E_NOTICE   
error_reporting(E_ALL ^ E_NOTICE);  
for($i=1; $i<=count($mainArrayQuestion); $i++){
	try {
	$objPHPExcel->getActiveSheet()->setCellValue('A'.($i+1), $i)
	                              ->setCellValue('B'.($i+1), $categoryQuestion[$i-1])
	                              ->setCellValue('C'.($i+1), $mainArrayNameQuestion[$i-1])
    							  ->setCellValue('D'.($i+1), $mainArrayQuestion[$i-1])
						   	      ->setCellValue('E'.($i+1), $mainArrayAnswer[$i-1][0])
							      ->setCellValue('F'.($i+1), $mainArrayAnswer[$i-1][1])
							      ->setCellValue('G'.($i+1), $mainArrayAnswer[$i-1][2])
							      ->setCellValue('H'.($i+1), $mainArrayAnswer[$i-1][3])
							      ->setCellValue('I'.($i+1), $mainArrayAnswer[$i-1][4])
								  ->setCellValue('J'.($i+1), $mainArrayAnswer[$i-1][5])
								  ->setCellValue('K'.($i+1), $mainArrayAnswer[$i-1][6])
								  ->setCellValue('L'.($i+1), $mainArrayAnswer[$i-1][7])
								  ->setCellValue('M'.($i+1), $mainArrayAnswer[$i-1][8])
								  ->setCellValue('N'.($i+1), $mainArrayAnswer[$i-1][9]);
	}catch(Exception $e) {
		echo 'Array out of bound...';
		}
}
//////////////////////////////////////////////////////////////////
/*if (count($mainArrayQuestion) > 0){
$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
toDownloadCurrentFile($filename);
}*/
////////////////////////////////////////////////////////////////////////////
//echo count($mainArrayQuestion);
if(count($mainArrayQuestion)<1){
	errorTypeCategory($ErrorMsg);
}else{
	$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
	global $array_filename;
	$array_filename[] = $filename;
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
function toDownloadCurrentFile($filename){
error_reporting(E_ALL);
ini_set('display_errors', '1');
//echo "<br>";
//echo '<a id="linkfiletoDownload'.$filename.'" href="Converted_files/'.$filename.'">>>> Click here to Download the file ('.$filename.').</a>';
//echo "<br>";
echo "<br>";
echo "<h1 style='background-color:green;'>تم تحويل الملف بنجاح.</h1>";
echo "<br>";
//echo '<iframe style="display: none;" src="multiple_downfile.php?text='.$filename.'">/iframe>';
global $array_filename;
//echo $array_filename[0];
//echo count($array_filename);
///////////////////////////////////////////////////////ZIP FILEs;
$fileZipName = date('d-m-Y_H-i-s');
$files = $array_filename;
$zipname = 'Converted_files/'.$fileZipName.'.zip';
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
foreach ($files as $file) {
  $zip->addFile("Converted_files/".$file);
}
$isend = $zip->close();
//////////////////////////////////////////////////////////
echo 'يتم الأن معالجة الملف الرجاء الإنتظار قليلاً... <br>';
echo '<a id="linkfiletoDownload" href="'.$zipname.'">>>> Click here to Download the file ('.$zipname.').</a>';
echo '<br> يتم الأن تنزيل الملف <br>';
//////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////
/*$linkNameis = "linkfiletoDownload".$filename;*/
echo "
<script type=\"text/javascript\">
setTimeout(function(){
document.getElementById('linkfiletoDownload').click();
alert('تم تصدير الملف بنجاح');
window.location.href = window.location.pathname;
},3000);
</script>
";
///////////////////////////////////////////////////////////////////////////////////////////////////////////
/*$file = 'Converted_files/'.$filename;
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
exit();*/
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
function errorTypeCategory($ErrorMsg){
	echo "<h1 style='background-color:red;'>".$ErrorMsg."</h1>";
}
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////Upload File and Run Function/////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_FILES['my_file'])){
	  $selectOption = $_POST['type_question'];
      $errors= array();
      $file_name = $_FILES['my_file']['name'];
      $file_size = $_FILES['my_file']['size'];
      $file_tmp = $_FILES['my_file']['tmp_name'];
      $file_type = $_FILES['my_file']['type'];
      //$file_ext = strtolower(end(explode('.',$file_name)));
      $path = pathinfo($file_name);
      $extensions= "xml";
      $errors = "";
      if($file_type == $extensions){
         $errors = "extension not allowed, please choose a xml or MXL file.";
      }else{
		  echo '<li>إسم الملف: '.$file_name.'</li>';
		  echo '<li>حجم الملف: '.$file_size.'</li>';
		  echo '<li>نوع الملف: '.$file_type.'</li>';
	  }
      
      /*if($file_size > 2097152) {
         $errors ='File size must be excately 2 MB';
      }*/
      
      if(empty($errors)==true) {
         /*$resultName = (string)(substr($file_name, 0, 30)."_".date('d-m-Y_H-i-s'));
		 echo $resultName;
          move_uploaded_file($file_tmp,"Uploaded_files/".$resultName);
		 $path = "Uploaded_files/".$resultName;*/
		 $path = $file_tmp;
		 if($selectOption != "--"){
			 iniValue($selectOption, $path);
		 }else{
			 echo "<h1 style='background-color:red;'>Please, Select type of question, and try again...</h1>";
		 }
      }else{
         print_r($errors);
      }
   }
///////////////////////////////////////////////////////////////////////////////////
function isArabic($string ,$ans){
	   $str = $string;
	   if (preg_match('/[اأإء-ي]/ui', $str)) {
		   if (strpos("true",trim($ans)) !== false){
			   return "صح";
		   }else{
			   return "خطأ";
		   }
		} else {
			return $str;
		}
}
///////////////////////////////////////////////////////////////////////////////////
function contains($haystack, $needle, $caseSensitive = false) {
    return $caseSensitive ?
            (strpos($haystack, $needle) === FALSE ? FALSE : TRUE):
            (stripos($haystack, $needle) === FALSE ? FALSE : TRUE);
}
/////////////////////////////////////////////////////////////////////////////////////
function deleteFilesAfter24Hours(){
	$path = 'Converted_files/';
if ($handle = opendir($path)) {
    while (false !== ($file = readdir($handle))) { 
        $filelastmodified = filemtime($path . $file);
        //24 hours in a day * 3600 seconds per hour
		//24*3600
		if(file_exists($path . $file) && $file != ".." && $file != "."){
		//echo (time() - $filelastmodified).'>'.$path . $file."<br>";
        if((time() - $filelastmodified) > 500){
				//echo $path . $file;
				unlink($path . $file);
        }else{
			//echo "no delete";
		}
	}
    }
    closedir($handle); 
}
}
/////////////////////////////////////////////////////////////////////////////////////
/*
- The function of this program is to convert XML files in moodle platform format into excel.
- Islamic University - Gaza.
- Developed by: Abd Alaziz M. Alswasis.
- @2021-2022
*/
?>