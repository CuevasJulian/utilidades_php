<?php

header('Access-Control-Allow-Origin: *');

$url = $_POST["url"];
$html = get_meta_tags($url);
$fileContent = file_get_contents($url);
$keys = array_keys($html);

$imgArray = array();
$titleArray = array();

$pattern = "/<img (.*?)>/";
$patternTitle = "/<(h1|h2|h3) (.*?)>(.*?)<\/(h1|h2|h3)>/";

preg_match_all($pattern, $fileContent,$matchs);
preg_match_all($patternTitle, $fileContent,$matchsTitles);

for($i = 0 ; $i < count($matchs[0]) ; $i++){
	$tagTemp = $matchs[0][$i];
	$tempPattern = "/src=\"(.*?)\"/";
	preg_match($tempPattern, $tagTemp,$tempMatchs);
	if(substr($tempMatchs[1],0,4) == "http" || substr($tempMatchs[1],0,5) == "https"){
		array_push($imgArray, $tempMatchs[1]);
	}
}

for($i = 0 ; $i < count($matchsTitles[3]) ; $i++){

	$tagTemp = $matchsTitles[3][$i];
	$patternText = "/^[A\-Za\-z\.\w ]/";
	if(preg_match($patternText, $tagTemp)){
		//echo $tagTemp."\r\n";
		array_push($titleArray, $tagTemp);
	}else{
		$patternALink = "/<a (.*?)>(.*?)<\/a>/";
		preg_match_all($patternALink, $tagTemp,$textLink);
		//echo $textLink[2][0]."\r\n";

		$patternImg = "/<img (.*?)>/";

		if(!preg_match($patternImg, $textLink[2][0])){
			array_push($titleArray, $textLink[2][0]);
		}
	}
	
	

	//array_push($titleArray, $tagTemp);
	
}

$img = "";
if(array_key_exists("twitter:image:src", $html)){
	array_push($imgArray, $html["twitter:image:src"]);
}
if(array_key_exists("twitter:image", $html)){
	array_push($imgArray, $html["twitter:image"]);
}
if(array_key_exists("og:image", $html)){
	array_push($imgArray, $html["og:image"]);
}

if($img == ""){
	$img = $imgArray;
}

if($html["title"] == "" || $html["title"] == null){
	$obj = ["titulo" => $titleArray , "descripcion" => $html["description"] , "imagen" => $img];
}else{
	array_push($titleArray, $html["title"]);
	$obj = ["titulo" => $titleArray , "descripcion" => $html["description"] , "imagen" => $img];
}



echo json_encode($obj);


?>