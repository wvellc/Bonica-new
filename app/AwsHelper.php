<?php

namespace App;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Storage;

class AWSHelper
{

	public static function uploadImageS3($request, $fileName, $path = '', $oldFileName = '')
	{
		$fileNameToStore	= '';
		if ($request->hasFile($fileName)) {
			if (!empty($oldFileName)) {
				self::deleteImageS3($oldFileName, $path);
			}
			$file 				= $request->file($fileName);
			$extension 			= $file->getClientOriginalExtension();
			$fileNameToStore 	= time() . rand() . '.' . $extension;
			$filePath 			= $path . $fileNameToStore . DIRECTORY_SEPARATOR;
			Storage::disk('s3')->put($filePath, file_get_contents($file));
		} else {
			if (!empty($oldFileName)) {
				$fileNameToStore = $oldFileName;
			}
		}
		return $fileNameToStore;
	}

	public static function deleteImageS3($fileName, $path)
	{
		if (!empty($fileName)) {
			$exists = Storage::disk('s3')->has($path . $fileName);
			if ($exists) {
				Storage::disk('s3')->delete($path . $fileName);
			}
		}
		return true;
	}
}