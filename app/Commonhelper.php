<?php

namespace App;
use Storage;
use Image;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use File;
use Config;
use Mail;
use App\Models\Role;
use App\Models\Notification;
use App\Events\MyEvent;
use Pusher\Pusher;
use Log;
use FFMpeg;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use VideoThumbnail;
use FFMpeg\Coordinate\TimeCode;

class Commonhelper
{
    public static function uploadFile1($image, $path, $thumbnailPath = NULL, $resizeH = 100, $resizeW = 100,$isResize = false)
	{
		try {
			$imagename 	= time() . Str::random(5) . '.' . $image->extension();
			$input['imagename'] = time() . Str::random(5) . '.' . $image->extension();

			// Create thumbnail
			if ($thumbnailPath) {
				$destinationPath = public_path($thumbnailPath);
				if (!file_exists($destinationPath)) {
					mkdir($destinationPath, 0777, true);
				}
				$img = Image::make($image->path());
				$img->resize($resizeH, $resizeW, function ($constraint) {
					$constraint->aspectRatio();
				})->save($destinationPath . '/' . $imagename);
			}

			// Upload file
			if ($path) {
				$destinationPath = public_path($path);
				if (!file_exists($destinationPath)) {

					mkdir($destinationPath, 0777, true);
				}
                if($isResize){
                    $img = Image::make($image->path());
                    $img->resize($resizeH, $resizeW, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $imagename);
                }
                else{
                    $image->move($destinationPath, $imagename);
                }
			}

           return $imagename;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
	public static function uploadFileWithThumbnail($request, $filename, $path, $thumbnailPath = NULL, $resizeH = 100, $resizeW = 100, $oldFileName = NULL)
	{
		try {
			$image	= $request->file($filename);
			$imagename 	= time() . Str::random(5) . '.' . $image->extension();
			$input['imagename'] = time() . Str::random(5) . '.' . $image->extension();


			//Delete old file
			if ($oldFileName) {
				if (file_exists(public_path($path . $oldFileName))) {
					self::deleteFile(public_path($path . $oldFileName));
				}
				if (file_exists(public_path($thumbnailPath . $oldFileName))) {
					self::deleteFile(public_path($thumbnailPath . $oldFileName));
				}
			}

			// Create thumbnail
			if ($thumbnailPath) {
				$destinationPath = public_path($thumbnailPath);
				if (!file_exists($destinationPath)) {
					mkdir($destinationPath, 0777, true);
				}
				$img = Image::make($image->path());

				$img->resize($resizeH, $resizeW, function ($constraint) {
					$constraint->aspectRatio();
				})->save($destinationPath . '/' . $imagename);
			}

			// Upload file
			if ($path) {
				$destinationPath = public_path($path);
				if (!file_exists($destinationPath)) {

					mkdir($destinationPath, 0777, true);
				}
				$image->move($destinationPath, $imagename);
			}

           return $imagename;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
    public static function uploadAjaxFileWithThumbnail($request, $filename, $path, $thumbnailPath = NULL, $resizeH = 100, $resizeW = 100, $oldFileName = NULL)
	{
		try {
			$image		= $request->file($filename);
			$imagename 	= time() . Str::random(5) . '.' . $image->extension();
			$input['imagename'] = time() . Str::random(5) . '.' . $image->extension();

			//Delete old file
			if ($oldFileName) {
				if (file_exists(public_path($path . $oldFileName))) {
					self::deleteFile(public_path($path . $oldFileName));
				}
				if (file_exists(public_path($thumbnailPath . $oldFileName))) {
					self::deleteFile(public_path($thumbnailPath . $oldFileName));
				}
			}

			// Create thumbnail
			if ($thumbnailPath) {
				$destinationPath	= public_path($thumbnailPath);
				if (!file_exists($destinationPath)) {
					mkdir($destinationPath, 0777, true);
				}
				$img = Image::make($image->path());
				$img->resize($resizeH, $resizeW, function ($constraint) {
					$constraint->aspectRatio();
				})->save($destinationPath . '/' . $imagename);
			}

			// Upload file
			if ($path) {
				$destinationPath = public_path($path);
				if (!file_exists($destinationPath)) {
					mkdir($destinationPath, 0777, true);
				}
				$image->move($destinationPath, $imagename);
			}

			$message = "Image Upload successful";

			return response()->json([
				'code'		=> 200,
				'message'	=> $message,
				'imagename' => $imagename
			]);
			//return self::apiresponse(1,$message,$imageNameArr);
		} catch (\Exception $e) {
			return response()->json([
				'code'		=> 400,
				'message'	=> $e->getMessage(),
				'imagename' => ""
			]);
			// return self::apiresponse(0,$e->getMessage());
		}
	}
	public static function uploadMultipleFileWithThumbnail($request, $filename, $path, $thumbnailPath = NULL, $resizeH = 100, $resizeW = 100)
	{
		try {
			$nameImages = array();
			$image		= $request->file($filename);

			foreach ($request->file($filename) as $image) {
				$imagename 	= time() . Str::random(5) . '.' . $image->extension();

				// Create thumbnail
				if ($thumbnailPath) {
					$destinationPathThum = public_path($thumbnailPath);
					if (!file_exists($destinationPathThum)) {
						mkdir($destinationPathThum, 0777, true);
					}
					$img = Image::make($image->path());
					$img->resize($resizeH, $resizeW, function ($constraint) {
						$constraint->aspectRatio();
					})->save($destinationPathThum . '/' . $imagename);
				}

				// Upload Origin file
				if ($path) {
					$destinationPath = public_path($path);
					if (!file_exists($destinationPath)) {
						mkdir($destinationPath, 0777, true);
					}
					$image->move($destinationPath, $imagename);
				}
				$nameImages[] = array(
					"image" => $imagename
				);
			}
            return $nameImages;
			//$message = "Image Upload successful";
			//return array('code' => 200, 'message' => "", 'data' => $nameImages);
			//return response()->json(['code' => 200, 'message' => "", 'data' => $nameImages]);
		} catch (\Exception $e) {
			//return response()->json(['code' => 400, 'message' => $e->getMessage(), 'data' => array()]);
            return $e->getMessage();
		}
	}
    public static function imageUpload($path,$request_image,$is_image = null) {

		if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        if ($is_image) {
            Commonhelper::deleteFile('uploads/' . $path . $is_image);
            Commonhelper::deleteFile('uploads/' . $path.'original/'. $is_image);
        }
        list($width, $height) = getimagesize($request_image);

        $commonfilename = rand(100000, 999999) . time();
        $extension = $request_image->getClientOriginalExtension();


        //Upload Image
        $image = Commonhelper::uploadFile($path, $request_image, $commonfilename, $extension);

        if ($request_image->getSize() > 1048576) { //1 MB

            Commonhelper::resizeImage($request_image, $path, $commonfilename . "." . $extension, 700);
        }
        else{
            Commonhelper::uploadFile($path, $request_image, $commonfilename, $extension);
        }

		return $image;
	}
    public static function uploadFile($target_dir,$file,$commonfilename,$extension) {

		//list($width,$height)=getimagesize($file);
		//$extension = $file->getClientOriginalExtension();
		//$commonfilename = rand(100000, 999999).time();
		/* if($filename){
			$filename = $filename. ".".$extension;
		}else{
			$filename = $commonfilename. ".".$extension;
		} */

		$filename = $commonfilename. ".".$extension;
		Storage::disk(Config::get('constants.DISK'))->put($target_dir.$filename, file_get_contents($file), 'public');

		return $filename;
	}
    public static function resizeImage($file,$thumnfolder,$filename,$size = 100) {

		try{
		  $img = Image::make($file->getRealPath());
		  $img->resize($size, null, function ($constraint) {
			  $constraint->aspectRatio();
		  });
		  Storage::disk(Config::get('constants.DISK'))->put($thumnfolder.$filename, $img->stream(), 'public');
		}catch(\Exception $e){
			return ApiresponseController::apiresponse(0,$e->getMessage());
		}
	  }
	public static function deleteFile($filePath)
	{
		unlink($filePath);
	}

	public static function deleteDirectory($directoryPath)
	{
		if (file_exists($directoryPath)) {
			File::deleteDirectory($directoryPath);
		}
		return true;
	}

	public static function dateFormatChange($date, $returnTime = false)
	{
		if ($returnTime) {
			return date('m-d-Y H:i:s', strtotime($date));
		} else {
			return date('m-d-Y', strtotime($date));
		}
	}

    public static function dateDMYFormat($date, $returnTime = false)
	{
		if ($returnTime) {
			return date('d/m/Y H:i:s', strtotime($date));
		} else {
			return date('d/m/Y', strtotime($date));
		}
	}
	public static function apiresponse($code = 1, $message = "success", $content = null)
	{
		if ($code == 1) {
			$status = 200;
		} elseif ($code == 2) {
			$status = 999;
		} elseif ($code == 3) {
			$status = 400;
		} else {
			$status = 404;
		}
		if (is_array($content) && count($content) == 0) {
			$content = [];
		} else {
			if ($content == null) {
				$content = null;
			}
		}
		$interResponse = array(
			'code'		=> $status,
			'message'	=> $message,
			'data'		=> $content
		);
		$response = new Response($interResponse);
		return $response;
	}
	public static function sendmail($toemail, $data, $template, $subject) {
		$from 	= Config::get('constants.MAIL_FROM_ADDRESS');
		$appname = Config::get('constants.APP_NAME');

		Mail::send($template, $data, function($message) use ($toemail,$appname,$subject,$data) {
			$message->to($toemail, $appname)
			->subject($subject);
		});
	}
    public static function calPercentage($count, $total) {
        $count1 = $count / $total;
        $count2 = $count1 * 100;
        $count = number_format($count2, 0);

        return $count;
    }
    public static function calAvg($total, $count) {
        $count = $total / $count;
        $avg = number_format($count, 1);
        return $avg;
    }
    /* public static function becomePractitioner($total, $count) {
        $count = $total / $count;
        $avg = number_format($count, 1);
        return $avg;
    }
    public static function becomeVendor($total, $count) {
        $count = $total / $count;
        $avg = number_format($count, 1);
        return $avg;
    } */
    public static function getstripeLoginLink($stripe_connect_id)
	{
		if($stripe_connect_id != ''){
			$stripe = new \Stripe\StripeClient(Config::get('constants.STRIPE_SECRET'));
			$response = $stripe->accounts->createLoginLink(
				$stripe_connect_id
			);
			return $response['url'];
		}
	}
    public static function generatetoken()
	{
		return md5(uniqid(mt_rand(), true));
	}
	public static function generateRandomString($length = 8) {
		$characters 		= '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@(){}';
		$charactersLength 	= strlen($characters);
		$randomString 		= '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
    public static function getProductImages() {

	}
	public static function compressImageVideo($type,$file,$path, $setKiloBitrate = 600)
	{

		$s3Directory = 'images/';
        $filename    =  $file->getClientOriginalName();
        $extension   =  $file->extension();
        $arrayFileName = explode(".", $file->getClientOriginalName());
        $s3FilePath = $s3Directory. $arrayFileName[0] . date('his') . '.' . $extension;
        $imageName = $arrayFileName[0] . date('his') . '.png';
        $storage_path_full = '/'.$filename;

        $destinationPath = public_path($path);
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
		if($type == 'video'){

			/*Uploded Into S3 Bucket*/
			Storage::disk('s3')->put($s3FilePath, file_get_contents($file));

			$videoPath = $file->getPathname();
			
			// Use FFmpeg to extract the thumbnail from the video
		    $ffmpeg = \FFMpeg\FFMpeg::create();
		    $video = $ffmpeg->open($videoPath);
		    $frame = $video->frame(TimeCode::fromSeconds(2));
		    $frame->save($destinationPath.$imageName);

			Image::make($destinationPath.$imageName)->resize(1080, 1080, function ($constraint) {
			      $constraint->aspectRatio();
			      $constraint->upsize();
			    })->save($destinationPath.$imageName);

			/*Uploded Video Path*/
			$videoPath = Storage::disk('s3')->url($s3FilePath);
			
			Storage::disk('s3')->put($s3Directory.$imageName, file_get_contents($destinationPath.$imageName));

			/*Get Image Path*/
			$imagePath = Storage::disk('s3')->url($s3Directory.$imageName);

			self::deleteFile($destinationPath . $imageName);

			//comment by dipali gupta
			// $localVideo =  Storage::disk('public')->put($storage_path_full, file_get_contents($file));
			//end comment by dipali gupta

			/*Get Video Dimension*/
			/* $ffprobe = FFMpeg\FFProbe::create();
			$dimension = $ffprobe
				->streams(public_path('storage').'/'.$filename) // extracts streams informations
				->videos()                      // filters video streams
				->first()                       // returns the first video stream
				->getDimensions();

			$width = $dimension->getWidth();
			$height = $dimension->getHeight(); */

			//comment by dipali gupta
			/*Upload Video to S3 after resize*/
			// FFMpeg::fromDisk('public')->open($filename)
			// ->resize(1080, 1080)
			// ->export()
			// ->toDisk('s3')
			// ->inFormat((new X264('libmp3lame', 'libx264'))->setKiloBitrate($setKiloBitrate))
			// ->save($s3FilePath);

			// /*Uploded Video Path*/
			// $videoPath = Storage::disk('s3')->url($s3FilePath);

			// /*Get Flash Image from video*/
			// VideoThumbnail::createThumbnail($videoPath,$destinationPath,$imageName,10,600,600);
			// /*Upload Image to S3 From Storage*/
			// Storage::disk('s3')->put($s3Directory.$imageName, file_get_contents($destinationPath . $imageName));

			// /*Get Image Path*/
			// $imagePath = Storage::disk('s3')->url($s3Directory.$imageName);

			// /*Delete Video & Image From Storage*/
			// Storage::disk('public')->delete($filename);

			// self::deleteFile($destinationPath . $imageName);
			// end comment by dipali gupta
			return array('imageName' => $imageName,'videoPath' => $videoPath,'imagePath' => $imagePath);
		}
		if($type == 'image'){

			if ($path) {
				$imageName = $arrayFileName[0] . date('his') . '.' . $extension;
                $img = Image::make($file->path());
                $destinationPath = public_path($path);
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
				$fileSize = $file->getSize();
				if($fileSize > 1000000){
					$img->resize(1000, 1000, function ($constraint) {
						$constraint->aspectRatio();
					});
				}
               	$img->save($destinationPath . '/' . $imageName);
				/*Upload Image to S3 From Storage*/
				Storage::disk('s3')->put($s3Directory.$imageName, file_get_contents($destinationPath . '/' . $imageName));

				/*Get Image Path*/
				$imagePath = Storage::disk('s3')->url($s3Directory.$imageName);
                self::deleteFile($destinationPath . '/' . $imageName);
				return array('imageName' => $imageName,'imagePath' => $imagePath);
            }
		}
	}
}
