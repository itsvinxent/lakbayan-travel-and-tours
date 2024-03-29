<?php 



function image_verification($image, ?bool $ismultiple = false): bool{ 

	//echo '<br><br>'.print_r($image);

	if ($ismultiple == true){
		$limit = count(array_filter($image['name']));

		foreach ($image['name'] as $key => $var){
			if (isset($image)){
				// $imgName = $image['name'][$key];
				// $imgSize = $image['size'][$key];
				// $imgTemp = $image['tmp_name'][$key];
				// $imgError = $image['error'][$key];
			
				if ($image['error'][$key] === 0){
			
					if(!($image['size'][$key]> 5000000)){ //5 Mb MAX
						$imgAllowed = pathinfo($image['name'][$key], PATHINFO_EXTENSION); 
						$toLower = strtolower($imgAllowed);
						$allowedExt = array("jpg", "jpeg", "png"); //Allowed Formats
			
						if(in_array($toLower, $allowedExt)){
							// $updatedName = uniqid("PFP-", true).'.'.$toLower; //NAME TO PUT TO DATABASE
							// $uploadToFile = 'assets/'.$updatedName; //UPLOAD LOC
							
							// echo "<br> SUCCESS <br>";
							if(($limit-1) == $key) {
								//move_uploaded_file($imgTemp, $uploadToFile);
								return true;
								
							}
							
						}else {
							// echo "<br> WRONG TYPE";
							return false;
						}
					}else {
						// echo "<br> TOO BIG";
						return false;
					}
				}else {
					// echo "<br> ERROR";
					return false;
				}
			
			}else {
				// echo "<br> NO PHOTO";
				return false;
			}
		}
	}else {
		if (isset($image)){
			// $imgName = $image['name'][$key];
			// $imgSize = $image['size'][$key];
			// $imgTemp = $image['tmp_name'][$key];
			// $imgError = $image['error'][$key];
		
			if ($image['error'] === 0){
		
				if(!($image['size']> 5000000)){ //5 Mb MAX
					$imgAllowed = pathinfo($image['name'], PATHINFO_EXTENSION); 
					$toLower = strtolower($imgAllowed);
					$allowedExt = array("jpg", "jpeg", "png"); //Allowed Formats
		
					if(in_array($toLower, $allowedExt)){
						// $updatedName = uniqid("PFP-", true).'.'.$toLower; //NAME TO PUT TO DATABASE
						// $uploadToFile = 'assets/'.$updatedName; //UPLOAD LOC
						
						// echo "<br> SUCCESS <br>";
						//if(($limit-1) == $key) {
							//move_uploaded_file($imgTemp, $uploadToFile);
							return true;
							
						//}
						
					}else {
						// echo "<br> WRONG TYPE";
						return false;
					}
				}else {
					// echo "<br> TOO BIG";
					return false;
				}
			}else {
				// echo "<br> ERROR";
				return false;
			}
		
		}else {
			// echo "<br> NO PHOTO";
			return false;
		}

	}

}

function rename_image($image, ?string $prefix = "IMG-"){

	$image['tmp_name'];
	$extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
	$newname = uniqid($prefix, true).'.'.$extension;

	return $newname;
}

?>