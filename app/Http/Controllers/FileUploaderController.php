<?php
namespace App\Http\Controllers;

use App\Helpers\Uploader;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class FileUploaderController extends Controller
{
	/**
     * Handle the file upload
	 * Support multitple file upload
	 * @method string upload
	 * @param string $fieldName
     * @return \Illuminate\Http\Response
     */
	function upload(Request $request, $fieldName = null)
	{
		$uploader = new Uploader($fieldName);
		$errors = $uploader->validate($request);
		if(!empty($errors)){
			return $this->reject($errors, 400);
		}

		$uploader->upload($request);
		return $uploader->uploadedFiles;
	}

	/**
     * Handle the file upload
	 * Support multitple file upload
	 * @method string upload
	 * @param string $fieldName
     * @return \Illuminate\Http\Response
     */
	function s3upload(Request $request, $fieldName = null)
	{
		$uploader = new Uploader($fieldName);
		$errors = $uploader->validate($request);
		if(!empty($errors)){
			return $this->reject($errors, 400);
		}
		$uploader->s3upload($request);
		return $uploader->uploadedFiles;
	}

	
	/**
     * remove uploaded file from temp directory
	 * @method string upload
	 * @param string $fieldName
     * @return \Illuminate\Http\Response
     */
	function remove_temp_file(Request $request)
	{
		if($request->temp_file){
			$file = $request->temp_file;
			$filename = basename($file);
			$tempDir = config("upload.tempDir");
			$fullName = public_path("$tempDir/$filename");
			if(File::exists($fullName)){
				File::delete($fullName);
				return $this->respond("File deleted");
			}
		}
		return $this->reject("Invalid temp file", 400);
	}
}
