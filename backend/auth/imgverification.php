<?php


/**
 * Validates the given image
 *
 * @param array $image Image to be processed 
 * @param string $ismultiple Prefix of image name before the actual name - Defaults to IMG-
 * 
 * @return string $newname Returns the renamed image
 */
function image_verification(array $image, ?bool $ismultiple = false): bool
{
	$allowedExt = array("jpg", "jpeg", "png"); //Allowed Formats

	if ($ismultiple) {
		$limit = count(array_filter($image['name']));


		foreach ($image['name'] as $key => $var) {

			if (! isset($image)) {
				echo <<<END
					<script type ="text/JavaScript">  
					alert("ERROR. No Image Uploaded.")
					</script>
				END;
				return false;
			}

			if ($image['error'][$key] == 4) {
				$limit+=1;
				continue;
			}

			if (! ($image['error'][$key] == 0)) {
				return false;
			}

			if ($image['size'][$key] > 5000000) { 
				echo <<<END
				<script type ="text/JavaScript">  
				alert("ERROR. File size exceeds the maximum.")
				</script>
				END;
				return false;
			}

			$imgAllowed = pathinfo($image['name'][$key], PATHINFO_EXTENSION);
			$toLower = strtolower($imgAllowed);
			
			if (! in_array($toLower, $allowedExt)) {
				echo <<<END
				<script type ="text/JavaScript">  
				alert("ERROR. Wrong Image Type.")
				</script>
				END;
				return false;
			}

			if (($limit - 1) == $key) {
				return true;
			}
		}
	} else {
		if (! isset($image)) {
			echo <<<END
				<script type ="text/JavaScript">  
				alert("ERROR. No Image Uploaded.")
				</script>
			END;
			return false;
			
		}

		if (! $image['error'] == 0) {
			return false;
		}

		if ($image['size'] > 5000000) { 
			echo <<<END
			<script type ="text/JavaScript">  
			alert("ERROR. File size exceeds the maximum.")
			</script>
			END;
			return false;
		}

		$imgAllowed = pathinfo($image['name'], PATHINFO_EXTENSION);
		$toLower = strtolower($imgAllowed);

		if (! in_array($toLower, $allowedExt)) {
			echo <<<END
			<script type ="text/JavaScript">  
			alert("ERROR. Wrong Image Type.")
			</script>
			END;
			return false;
		}

		return true;
	}
}


/**
 * Renames the uploaded image 
 *
 * @param array $image Image to be renamed
 * @param string $prefix Prefix of image name before the actual name - Defaults to IMG-
 * 
 * @return string $newname Returns the renamed image
 */
function rename_image($image, ?string $prefix = "IMG-")
{

	$image['tmp_name'];
	$extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
	$newname = uniqid($prefix, true) . '.' . $extension;

	return $newname;
}