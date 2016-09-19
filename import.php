<?php  

//connect to the database 
$connect = mysql_connect("localhost","root",""); 
mysql_select_db("magento_import",$connect); //select the table 

// 
if(isset($_FILES['csv']['name'])){

$fileName = $_FILES['csv']['name'];
  $empty_space = '/ /';
  $replace = '-';
  $fileName = preg_replace($empty_space,$replace,$fileName);
  $tmpName = $_FILES['csv']['tmp_name'];
  $fileSize = $_FILES['csv']['size'];
  $fileType = $_FILES['csv']['type'];
	$dir = 'magento_import/';
	if(!is_dir($dir))
	{
	mkdir('magento_import/');
	}
	$filePath = $dir. $fileName;; 
		$result = move_uploaded_file($tmpName, $filePath);
		 chmod($filePath,0777);
	//	 $file_handle = fopen("toners.csv", "r");
	 $uploaded_file = $dir.$fileName;
	
	$file_handle = fopen($uploaded_file, "r");
	
		//print_r($file_handle);	
	while(!feof($file_handle) ) {
		
	$arr = fgetcsv($file_handle, 1024);
	//print_r($arr);
			$val1 = explode(';',$arr[1]);
			//print_r($val1);
			$string= "";
			foreach($val1 as $cat) {
     $cat = trim($cat);
	
	$val2 = explode(',',$cat);

	$val23 = explode(' ',$val2[0]);
	
	 $prefix = $val23[0];
	 
	      foreach($val2 as $cat2) {
			  if (strpos($cat2, $prefix) !== false) {
				   $cat2 = trim($cat2);
			  }else{
				   
				   $cat2 = $prefix." ".trim($cat2);
			  }

			  
			   $string .= $cat2.',';
		  }
		 
	
}
 echo $string;

		   echo "<br/>";
			//die;
		 //mysql_query("INSERT INTO category(`oem_brand`,`model_number`)VALUES('".addslashes($arr[0])."','".addslashes($arr[1])."')");

	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CSV</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  Choose your csv file: <br />
  <input name="csv" type="file" id="csv" />
  <input type="submit" name="Submit" value="Submit" />
</form>
</body>
</html>
