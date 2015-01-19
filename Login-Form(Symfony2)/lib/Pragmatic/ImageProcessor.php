<?php
namespace Pragmatic;

class ImageProcessor {
	
	public static function resize ( $imageFile, $newWidth, $newHeight, $newFileName ) {
		
		if ( !file_exists($imageFile) ) {
			throw new \Exception("File $imageFile does not exist");
		}
		
		$imageData = self::readImageFile($imageFile);
		$newSize = self::calcualteSize($imageData, $newWidth, $newHeight);
		
		$newImage = self::resizeImage($imageData, $newSize, $newWidth, $newHeight);
		
		self::writeImageFile($newImage, $newFileName);
		
	}
	
	protected static function resizeImage($imageData, $newSize, $newWidth, $newHeight) {
		
		$newimg = imagecreatetruecolor( $newWidth, $newHeight); 
		imagefill($newimg, 0, 0, 0xffffff);
		
		$palsize = ImageColorsTotal($imageData['resource']);
		for ($i = 0; $i < $palsize; $i++)
		{ 
			$colors = ImageColorsForIndex($imageData['resource'], $i);   
			ImageColorAllocate($newimg, $colors['red'], $colors['green'], $colors['blue']);
		} 
		
		imagecopyresized($newimg, $imageData['resource'], ($newWidth - $newSize['width']) / 2 , ($newHeight - $newSize['height']) / 2, 0, 0, $newSize['width'], $newSize['height'], $imageData['width'], $imageData['height']);
		
		return $newimg;
	}


	protected static function calcualteSize( $imageData, $newWidth ,$newHeight ) {
		$ratio = $imageData['width'] / $imageData['height'];
		
		if ( $imageData['width'] > $imageData['height'] ) {	
			$newHeight = $newWidth / $ratio;
		} else {
			$newWidth = $newHeight * $ratio;
		}
		
		return array(
			'width' => $newWidth,
			'height' => $newHeight
		);
		
	}
	
	protected static function getImageInfo( $filename ) {
		return getimagesize($filename);
	}
	
	protected static function readImageFile( $filename ) {
		$info = self::getImageInfo( $filename );
		$type = $info[2];
		$width = $info[0];
		$height = $info[1];
		
		$gdImage = null;
		
		switch ( $type ) {
			case IMAGETYPE_BMP:
			case IMAGETYPE_WBMP:
				$gdImage = imagecreatefromwbmp($filename);
				break;
			case IMAGETYPE_GIF:
				$gdImage = imagecreatefromgif($filename);
				break;
			case IMAGETYPE_JPEG:
			case IMAGETYPE_JPEG2000:
				$gdImage = imagecreatefromjpeg($filename);
				break;
			case IMAGETYPE_PNG:
				$gdImage = imagecreatefrompng($filename);
				break;
			default:
				throw new Exception("Image type not supported");
		}
		
		return array(
			'resource' => $gdImage,
			'type' => $type,
			'width' => $width,
			'height' => $height
		);
		
	}
	
	protected static function writeImageFile( $image, $filename ) {
		imagejpeg($image,$filename); 
	}
	
}

