<?php

namespace App\Http\Controllers;
use App\Helpers\Uploader;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use App\Recipients\EmailRecipient;
use App\Notifications\RecordActionMail;
class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	/**
	 * List of supported export format
	 * @var string
	 */
	protected $exportFormats = ['pdf', 'csv', 'excel', 'print'];
	
	/**
	 * Get current request export format from GET
	 * @example /products/index?export=csv
	 * @return string
	 */
	public function getExportFormat(){
		$format = request()->export ?? '';
		return in_array(strtolower($format), $this->exportFormats) ? $format: null;
	}

	/**
	 * Redirect to a page with success message
	 * If request is ajax then output success message without redirect
	 * @return \Illuminate\Http\Response
	 */
	public function redirect($url, $msg=null){
		if(request()->ajax()){
			return $msg;
		}
		return redirect($url)->with('success', $msg);
	}

	/**
	 * Redirect to a intended page  with success message
	 * If request is ajax then output success message without redirect
	 * @return \Illuminate\Http\Response
	 */
	public function redirectIntended($url, $msg=null){
		if(request()->ajax()){
			return $msg;
		}
		return redirect()->intended($url);
	}

	/**
	 * Render page view
	 * Render page section without layout if request is ajax
	 * @return \Illuminate\View\View
	 */
	public function renderView($view, $data=null){
		if (request()->ajax()) {
			$format = request()->format ?? "";
			if(strtolower($format) == "json"){
				return $data;
			}
			return View::make($view)->with($data)->renderSections()['content'];
		}
		return view($view)->with($data);
	}

	/**
	 * Return success Http response (200)
	 * @return \Illuminate\Http\Response
	 */
	public function respond($data){
		return $data;
	}

	/**
	 * Return failed Http response
	 * @return \Illuminate\Http\Response
	 */
	public function reject($msg, $status_code = 500){
		return response($msg, $status_code);
	}
	
	/**
	 * Move uploaded files from temp directory to new directory when form submit is submitted
	 * @param string $files //uploaded files names
	 * @param string $fieldname //fieldname for the uploaded file
	 * @return string
	 */
	function moveUploadedFiles($files, $fieldname){
		if($files){
			$uploader = new Uploader($fieldname);
			$arrFiles = explode(",", $files);
			$uploadedFiles = [];
			foreach($arrFiles as $file){
				if(stripos($file, config("upload.tempDir")) > -1){
					//move only files in temp directory
					$uploadedFiles[] = $uploader->moveUploadedFiles($file);
				}
				else{
					$uploadedFiles[] = $file;
				}
			}
			return implode(",", $uploadedFiles);
		}
		return null;
	}

	/**
	 * Convinient function to delete files associated with record when deleted
	 * @param string $fileNames // can be separated by comma
	 * @return void
	 */
	public function deleteRecordFiles($fileNames, $fieldName){
		try{
			$filesToBeDeleted = explode(",", $fileNames);
			$imgThumbDirs = ["small", "medium", "large"];

			$uploadSettings = config("upload.$fieldName");
			if($uploadSettings){
				$imgThumbDirs = array_keys($uploadSettings["image_resize"]);
			}


			$imgExts = ["jpg", "png", "jpeg"];
			foreach($filesToBeDeleted as $file){
				$fullPath = public_path() . "/" . $file;
				if(File::exists($fullPath)){
					File::delete($fullPath);
					$isImg = (in_array(File::extension($fullPath), $imgExts) ? true : false);
					if($isImg){
						foreach($imgThumbDirs as $dir){
							$paths = explode("/", $fullPath);
							$lastpath = count($paths) - 1;
							array_splice($paths, $lastpath, 0, $dir);
							$thumbFullPath = implode("/", $paths);
							if(File::exists($thumbFullPath)){
								File::delete($thumbFullPath);
							}
						}
					}
				}
			}
		}
		catch(Exception $e){
			throw $e;
		}
	}
	
	/**
	 * Serialize form data with array values to string
	 * @param array $arr //Request data
	 * @return array
	 */
	function normalizeFormData($arr){
		foreach($arr as $key => $val){
			if(is_array($val)){
				$arr[$key] = implode(",", $val);
			}
		}
		return $arr;
	}

	/**
	 * Send mail to system admin on record action such as Insert| Delete | Update
	 * @param 
	 * @return void
	 */
	public function sendRecordActionMail($receiver, $subject, $message, $recordLink = null){
		try{
			$recipient = new EmailRecipient($receiver);
			$recipient->notify(new RecordActionMail($subject, $message, $recordLink));
		}
		catch(Exception $e){
			throw $e;
		}
	}
}