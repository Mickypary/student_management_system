<?php

		$dirname = 'uploads/';
		$filename = $dirname.basename($_FILES['image']['name']);
		$type = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
		// echo $type;

		if (isset($_POST['submit'])) {
			// echo $filename;
			// die();
			$checkFileSize = getimagesize($_FILES['image']['tmp_name']);
			if ($checkFileSize != false) {
				echo 'ok size'.$checkFileSize['mime'];
				// move_uploaded_file($_FILES['image']['tmp_name'], $filename);
				// move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$_FILES['image']['name']);
				if (file_exists('uploads/'.$_FILES['image']['name'])) {
					echo "File Already Exist";
				}else {
					if ($type != 'png') {
						echo 'File Type Not Allowed';
					}else {
						if (move_uploaded_file($_FILES['image']['tmp_name'], $filename)) {
						echo "Pary Welldone";
					}
					
				}
				}
				
				// var_dump($checkFileSize);
			}else {
				echo 'Not an Image';
			}
		}else {
			echo 'Not working...';
		}