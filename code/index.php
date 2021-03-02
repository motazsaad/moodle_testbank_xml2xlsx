<html>
<!--/*
- The function of this program is to convert XML files in moodle platform format into excel.
- Islamic University - Gaza.
- Developed by: Abd Alaziz M. Alswasis.
- @2021-2022
*/-->
<body>
<center>
<br/><br/>
<form name="form" method="POST" action="" enctype="multipart/form-data" >
  <label for="cars">Choose the type of question:</label>
  <select name="type_question" id="cars">
    <option value="--">--</option>
    <option value="True-Flase">True or Flase</option>
    <option value="Multi-choice">Multi-choice</option>
    <option value="Matching">Matching</option>
	<option value="Random-Matching">Random-Matching</option>
    <option value="Order">Order</option>
    <option value="Exam">All</option>
  </select>
  <br><br>
<input type="file" name="my_file"/><br/><br/>
<input type="submit" name="submit" value="Upload"/>
</form>
</center>
</body>
</html>

<?php
/** Include PHPExcel */
require_once("Classes/PHPExcel.php");

//////////////////////////////////////////////////////////////////
function iniValue($typeQuestion , $path){
if(strlen($path) > 15){
	//echo "".strlen($path);
	echo "<br>";
//Create a P1HPExcel object
$objPHPExcel = new PHPExcel();

// Set default font
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(12);

//Rename the worksheet
$objPHPExcel->getActiveSheet()->setTitle('exam info');
//Set active worksheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

if (($typeQuestion == "True-Flase")){
//Set the first row as the header rows
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID')
							  ->setCellValue('B1', 'Category')
							  ->setCellValue('C1', 'Name Question')
							  ->setCellValue('D1', 'Question')
							  ->setCellValue('E1', 'Answer');
convertFileFromXmlToExcel_TrueFalse($path, $objPHPExcel, "TrueFlase");
}else if($typeQuestion == "Multi-choice"){
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID')
                              ->setCellValue('B1', 'Category')
                              ->setCellValue('C1', 'Name Question')
							  ->setCellValue('D1', 'Question')
							  ->setCellValue('E1', 'A1')
							  ->setCellValue('F1', 'A2')
							  ->setCellValue('G1', 'A3')
							  ->setCellValue('H1', 'A4')
							  ->setCellValue('I1', 'Answer');
convertFileFromXmlToExcel_MultiChoice($path, $objPHPExcel, "Multichoice");
}else if($typeQuestion == "Matching"){
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID')
                              ->setCellValue('B1', 'Category')
                              ->setCellValue('C1', 'Name Question')
							  ->setCellValue('D1', 'Question')
							  ->setCellValue('E1', 'True Answer')
							  ->setCellValue('F1', 'All Answer');
							  //->setCellValue('E1', 'A3')
							  //->setCellValue('F1', 'A4');
							  //->setCellValue('C1', 'answer');
convertFileFromXmlToExcel_Matching($path, $objPHPExcel, "Matching");
}else if($typeQuestion == "Random-Matching"){
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID')
                              ->setCellValue('B1', 'Category')
							  ->setCellValue('C1', 'Name Question')
							  ->setCellValue('D1', 'Question')
							  ->setCellValue('E1', 'Answer');
convertFileFromXmlToExcel_ShortAnswer($path, $objPHPExcel, "Random-Matching");
}else if($typeQuestion == "Order"){
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
convertFileFromXmlToExcel_Order($path, $objPHPExcel, "Order");
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else if($typeQuestion == "Exam"){

	//$qTypeIndex = 0
	for ($qTypeIndex = 1; $qTypeIndex <= 5; $qTypeIndex++) {
	if ($qTypeIndex == 1){
		////////////////////////////////////////////////////////////////////
	echo $qTypeIndex."- >>>>>>>>>>>>>>>>>>>>>>> True-Flase";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(12);
	$objPHPExcel->getActiveSheet()->setTitle('exam info');
	$objPHPExcel->setActiveSheetIndex(0);
////////////////////////////////////////////////////////////////////
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID')
							  ->setCellValue('B1', 'Category')
							  ->setCellValue('C1', 'Name Question')
							  ->setCellValue('D1', 'Question')
							  ->setCellValue('E1', 'Answer');
convertFileFromXmlToExcel_TrueFalse($path, $objPHPExcel, "TrueFlase");
}else if($qTypeIndex == 2){
	////////////////////////////////////////////////////////////////////
    echo $qTypeIndex."- >>>>>>>>>>>>>>>>>>>>>>> Multi-choice";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(12);
	$objPHPExcel->getActiveSheet()->setTitle('exam info');
	$objPHPExcel->setActiveSheetIndex(0);
////////////////////////////////////////////////////////////////////
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID')
                              ->setCellValue('B1', 'Category')
                              ->setCellValue('C1', 'Name Question')
							  ->setCellValue('D1', 'Question')
							  ->setCellValue('E1', 'A1')
							  ->setCellValue('F1', 'A2')
							  ->setCellValue('G1', 'A3')
							  ->setCellValue('H1', 'A4')
							  ->setCellValue('I1', 'Answer');
convertFileFromXmlToExcel_MultiChoice($path, $objPHPExcel, "Multichoice");
}else if($qTypeIndex == 3){
	////////////////////////////////////////////////////////////////////
	echo $qTypeIndex."- >>>>>>>>>>>>>>>>>>>>>>> Matching";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(12);
	$objPHPExcel->getActiveSheet()->setTitle('exam info');
	$objPHPExcel->setActiveSheetIndex(0);
////////////////////////////////////////////////////////////////////
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID')
                              ->setCellValue('B1', 'Category')
                              ->setCellValue('C1', 'Name Question')
							  ->setCellValue('D1', 'Question')
							  ->setCellValue('E1', 'True Answer')
							  ->setCellValue('F1', 'All Answer');
							  //->setCellValue('E1', 'A3')
							  //->setCellValue('F1', 'A4');
							  //->setCellValue('C1', 'answer');
convertFileFromXmlToExcel_Matching($path, $objPHPExcel, "Matching");
}else if($qTypeIndex == 4){
	////////////////////////////////////////////////////////////////////
	echo $qTypeIndex."- >>>>>>>>>>>>>>>>>>>>>>> Order";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(12);
	$objPHPExcel->getActiveSheet()->setTitle('exam info');
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
convertFileFromXmlToExcel_Order($path, $objPHPExcel, "Order");
}else if ($qTypeIndex == 5){
		////////////////////////////////////////////////////////////////////
	echo $qTypeIndex."- >>>>>>>>>>>>>>>>>>>>>>> ShortAnswer";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(12);
	$objPHPExcel->getActiveSheet()->setTitle('exam info');
	$objPHPExcel->setActiveSheetIndex(0);
////////////////////////////////////////////////////////////////////
//Set the first row as the header row
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID')
                              ->setCellValue('B1', 'Category')
							  ->setCellValue('C1', 'Name Question')
							  ->setCellValue('D1', 'Question')
							  ->setCellValue('E1', 'Answer');
convertFileFromXmlToExcel_ShortAnswer($path, $objPHPExcel, "Random-Matching");
}
	}
}
}else {
	echo "<h1 style='background-color:red;'>Please, Select the file to be converted...</h1>";	
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function convertFileFromXmlToExcel_TrueFalse($pathFile,$objPHPExcel, $Qtypr){
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
if (count($mainArrayQuestion) > 0){
$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
toDownloadCurrentFile($filename);
}
//header("Content-type: application/xlsx");
//header("Content-Disposition: attachment;filename= Converted_files/".$filename);
//toDownloadCurrentFile(str_replace('.php', '.xlsx', "Converted_files/".$filename));
//header('Content-type: application/vnd.ms-excel');
//header('Content-Disposition: attachment; filename='.$filename);
//$objWriter->save("php://output");
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function convertFileFromXmlToExcel_MultiChoice($pathFile,$objPHPExcel, $Qtypr){
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
foreach ($question as $data){
	//print_r($question);
    $questiontext = $data->getAttribute('type');
	//print_r($type_question);
	$index = 1;
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
				//echo '<br>';
				}
				$index++;
		}
		$indexAnswerForQuestion++;
	}else if($questiontext == "category"){
		$questiontext = $data->getElementsByTagName("category");
		foreach ($questiontext as $text) {
		$str = $text->nodeValue;
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
for($i=1; $i<=count($mainArrayQuestion); $i++){
	$objPHPExcel->getActiveSheet()->setCellValue('A'.($i+1), $i)
	                              ->setCellValue('B'.($i+1), $categoryQuestion[$i-1])
    							  ->setCellValue('C'.($i+1), $mainArrayNameQuestion[$i-1])
								  ->setCellValue('D'.($i+1), $mainArrayQuestion[$i-1])
						   	      ->setCellValue('E'.($i+1), $mainArrayAnswer[$i-1][0])
							      ->setCellValue('F'.($i+1), $mainArrayAnswer[$i-1][1])
							      ->setCellValue('G'.($i+1), $mainArrayAnswer[$i-1][2])
							      ->setCellValue('H'.($i+1), $mainArrayAnswer[$i-1][3])
							      ->setCellValue('I'.($i+1), $mainArrayTrueAnswer[$i-1]);								  
}
//////////////////////////////////////////////////////////////////
if (count($mainArrayQuestion) > 0){
$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
toDownloadCurrentFile($filename);
}
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function convertFileFromXmlToExcel_Matching($pathFile,$objPHPExcel, $Qtypr){
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
			$allAnswer = $allAnswer.",".$fq; 
			//$mainArrayAnswer[] = $fq;
		}
		
		for($i=1; $i<=$itemCount; $i++){
		$mainArrayAnswer[] = trim($allAnswer); 
		}
		
	}else if($questiontext == "category"){
		$questiontext = $data->getElementsByTagName("category");
		foreach ($questiontext as $text) {
		$str = $text->nodeValue;
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
if (count($mainArrayQuestion) > 0){
$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
toDownloadCurrentFile($filename);
}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function convertFileFromXmlToExcel_ShortAnswer($pathFile,$objPHPExcel, $Qtypr){
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
if (count($mainArrayQuestion) > 0){
$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
toDownloadCurrentFile($filename);
}
//header("Content-type: application/xlsx");
//header("Content-Disposition: attachment;filename= Converted_files/".$filename);
//toDownloadCurrentFile(str_replace('.php', '.xlsx', "Converted_files/".$filename));
//header('Content-type: application/vnd.ms-excel');
//header('Content-Disposition: attachment; filename='.$filename);
//$objWriter->save("php://output");
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function convertFileFromXmlToExcel_Order($pathFile,$objPHPExcel, $Qtypr){
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
if (count($mainArrayQuestion) > 0){
$filename = date('d-m-Y_H-i-s').$Qtypr.".xlsx";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', "Converted_files/".$filename));
toDownloadCurrentFile($filename);
}
}
//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
function toDownloadCurrentFile($filename){
echo "<br>";
echo '<a href="Converted_files/'.$filename.'">>>> Click here to open the file ('.$filename.').</a>';
echo "<br>";
echo "<br>";
echo "<h1 style='background-color:green;'>The file was successfully converted.</h1>";
echo "<br>";
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
		  echo '<li>File Name: '.$file_name.'</li>';
		  echo '<li>File Size: '.$file_size.'</li>';
		  echo '<li>File Type: '.$file_type.'</li>';
	  }
      
      /*if($file_size > 2097152) {
         $errors ='File size must be excately 2 MB';
      }*/
      
      if(empty($errors)==true) {
         $resultName = (string)(substr($file_name, 0, 30)."_".date('d-m-Y_H-i-s'));
		 echo $resultName;
         move_uploaded_file($file_tmp,"Uploaded_files/".$resultName);
		 $path = "Uploaded_files/".$resultName;
		 if($selectOption != "--"){
			 iniValue($selectOption, $path);
		 }else{
			 echo "<h1 style='background-color:red;'>Please, Select type of question, and try again...</h1>";
		 }
      }else{
         print_r($errors);
      }
   }
   
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
function contains($haystack, $needle, $caseSensitive = false) {
    return $caseSensitive ?
            (strpos($haystack, $needle) === FALSE ? FALSE : TRUE):
            (stripos($haystack, $needle) === FALSE ? FALSE : TRUE);
}
	//echo "test>>".(strpos("true",trim("true")) !== false);
	//echo ">>>".isArabic("      يشترط لصحة بيع المال عند اتحاد الجنس والعلة التقابض والحلول دون التماثل.","true");
/*
- The function of this program is to convert XML files in moodle platform format into excel.
- Islamic University - Gaza.
- Developed by: Abd Alaziz M. Alswasis.
- @2021-2022
*/
?>