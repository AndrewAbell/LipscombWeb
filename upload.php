<?php
if (isset($_POST['submit'])) {
	$file = $_FILES['file'];

	//Collecting inforamtion on the file being submitted
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	//Getting file type extension
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	//File types to allow
	$allowed = array('xls', 'xlt', 'xlm', 'xlsx', 'xlsm', 'xltx', 'xltm');

	//Checks size of file and assigns unique id number to file when uploaded
	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if($fileSize < 100000000) {
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				header("Location: index.html?uploadsuccess");
			}else {
				echo "Your file is too big!";
			}
		}else {
			echo "There was an error uplading your file";
		}
	}else {
		echo "You cannot upload files of this type!";
	}

}