<?php

const DIR_IMAGE_REVIEW = DIR_IMAGE . 'reviews/';

class ModelToolReviewext extends Model {

	public function resize($filename, $folder) {
		if (!is_file(DIR_IMAGE_REVIEW . $filename) || substr(str_replace('\\', '/', realpath(DIR_IMAGE_REVIEW . $filename)), 0, strlen(DIR_IMAGE_REVIEW)) != DIR_IMAGE_REVIEW) {
			return false;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$image_old = $filename;
		$image_new = $folder . token(32) . '.' . $extension;

		if (!is_file(DIR_IMAGE_REVIEW . $image_new)) {
			list($width, $height, $image_type) = getimagesize(DIR_IMAGE_REVIEW . $image_old);
				 
			if (!in_array($image_type, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF))) { 
				unlink(DIR_IMAGE_REVIEW . $image_old);
				return false;
			}

			$image = new Image(DIR_IMAGE_REVIEW . $image_old);
			$image->resize($width, $height);
			$image->save(DIR_IMAGE_REVIEW . $image_new);
			unlink(DIR_IMAGE_REVIEW . $image_old);
		}
		
		return $image_new;
	}
	

}
