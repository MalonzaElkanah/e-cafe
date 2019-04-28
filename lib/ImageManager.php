<?php

class Imagemanager{
	private $type = '';
	private $uploadExtentions = array( 'png', 'jpg', 'jpeg', 'gif' );
	private $uploadTypes = array( 'image/gif', 'image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png' );
	private $image;
	private $name;
	public function __construct(){

	}
	/**
	* Load image from local file system
	* @param String $filepath
	* @return void
	*/
	public function loadFromFile( $filepath ) {
		$info = getimagesize( $filepath );
		$this->type = $info[2];
		if( $this->type == IMAGETYPE_JPEG ) {
			$this->image = imagecreatefromjpeg($filepath);
		}else if( $this->type == IMAGETYPE_GIF ) {
			$this->image = imagecreatefromgif($filepath);
		}
		else if( $this->type == IMAGETYPE_PNG ) {
			$this->image = imagecreatefrompng($filepath);
		}
	}

	/**
	* Get the image width
	* @return int
	*/
	public function getWidth(){
		return imagesx($this->image);
	}
	/**
	* Get the height of the image
	* @return int
	*/
	public function getHeight(){
		return imagesy($this->image);
	}

	/**
	* Resize the image
	* @param int $x width
	* @param int $y height
	* @return void
	*/
	public function resize( $x, $y ){
		$new = imagecreatetruecolor($x, $y);
		imagecopyresampled($new, $this->image, 0, 0, 0, 0, $x, $y,
		$this->getWidth(), $this->getHeight());
		$this->image = $new;
	}

	/**
	* Resize the image, scaling the width, based on a new height
	* @param int $height
	* @return void
	*/
	public function resizeScaleWidth( $height )	{
		$width = $this->getWidth() * ( $height / $this->getHeight() );
		$this->resize( $width, $height );
	}

	/**
	* Resize the image, scaling the height, based on a new width
	* @param int $width
	* @return void
	*/
	public function resizeScaleHeight( $width ){
		$height = $this->getHeight() * ( $width / $this->getWidth() );
		$this->resize( $width, $height );
	}

	/**
	* Scale an image
	* @param int $percentage
	* @return void
	*/
	public function scale( $percentage ){
		$width = $this->getWidth() * $percentage / 100;
		$height = $this->getheight() * $percentage / 100;
		$this->resize( $width, $height );
	}

	/**
	* Display the image to the browser - called before output is sent,
	exit() should be called straight after.
	* @return void
	*/
	public function display(){
		$type = '';

		if( $this->type == IMAGETYPE_JPEG ){
			$type = 'image/jpeg';
		}
		else if( $this->type == IMAGETYPE_GIF ){
			$type = 'image/gif';
		}
		else if( $this->type == IMAGETYPE_PNG ){
			$type = 'image/png';
		}

		header('Content-Type: ' . $type );

		if( $this->type == IMAGETYPE_JPEG ){
			imagejpeg( $this->image );
		}
		else if( $this->type == IMAGETYPE_GIF ){
			imagegif( $this->image );
		}
		else if( $this->type == IMAGETYPE_PNG ){
			imagepng( $this->image );
		}
	}

	/**
	* Load image from postdata
	* @param String $postfield the field the image was uploaded via
	* @param String $moveto the location for the upload
	* @param String $name_prefix a prefix for the filename
	* @return boolean
	*/
	public function loadFromPost( $postfield, $moveto, $name_prefix='')	{
		var_dump($_POST['fileUpload'] );
		//if( is_uploaded_file( $_FILES[ $postfield ]['tmp_name'] ) ){
			echo "string1";
			$i = strrpos( $_FILES[ $postfield ]['name'], '.');
			if (! $i )	{
				//'no extention';
				var_dump("expression0:");
				return false;
			} else {
				$l = strlen( $_FILES[ $postfield ]['name'] ) - $i;
				$ext = strtolower ( substr( $_FILES[ $postfield ] ['name'], $i+1, $l ) );
				var_dump("expression1:");
				if( in_array( $ext, $this->uploadExtentions ) ){
					var_dump("expression2:");
					if( in_array( $_FILES[ $postfield ]['type'], $this->uploadTypes ) ){
						var_dump("expression3:");
						$name = str_replace( ' ', '', $_FILES[$postfield ]['name'] );
						$this->name = $name_prefix . $name;
						$path = $moveto . $name_prefix.$name;
						move_uploaded_file( $_FILES[ $postfield ] ['tmp_name'] , $path );
						$this->loadFromFile( $path );
						return true;
					}else{
						// 'invalid type';
						return false;
					}
				}
				else{
					// 'invalid extention';
					return false;
				}
			}
		/*}else{
			// 'not uploaded file';
			return false;
		}*/
	}

	/**
	* Get the image name
	* @return String
	*/
	public function getName(){
		return $this->name;
	}

	/**
	* Save changes to an image e.g. after resize
	* @param String $location location of image
	* @param String $type type of the image
	* @param int $quality image quality /100
	* @return void
	*/
	public function save( $location, $type='', $quality=100 ){
		$type = ( $type == '' ) ? $this->type : $type;
		if( $type == IMAGETYPE_JPEG ){
			imagejpeg( $this->image, $location, $quality);
		}
		else if( $type == IMAGETYPE_GIF ) {
			imagegif( $this->image, $location );
		}
		else if( $type == IMAGETYPE_PNG ) {
			imagepng( $this->image, $location );
		}
	}
}
?>

