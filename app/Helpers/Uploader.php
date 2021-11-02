<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class Uploader
{
	/**
     * upload setting for the current upload
     * load from config("upload.fieldname")
     * @var array
     */
	private $settings = [];

	/**
     * current uploading file
     * @var file
     */
	private $file = null;

	/**
     * max file size allowed for upload // in kilobyte
     * @var int|float
     */
	private $maxFileSize = 30720; //(3mb)

	/**
     * list of file extension allowed
	 * separated by comma
     * @var string
     */
	private $allowedExtensions = "jpg,png,jpeg,gif,pdf,txt,csv,xlsx";

	/**
     * current upload file name
     * @var string
     */
	private $fileName = "";

	/**
     * string that is prepended to the file name
     * @var string
     */
	private $filenamePrefix = "";

	/**
     * max number of files allowed for upload
     * @var int
     */
	private $fileLimit = 3;


	/**
     * Directory name where file will be uploaded
     * @var string
     */
	private $uploadDir = "";

	/**
     * Directory name where file will be uploaded
     * @var string
     */
	private $tempDir = "uploads/temp/";

	/**
     * Format in which uploaded files will be saved
     * @var string
     */
	private $filenameType = "random";

	/**
     * return full url of the uploaded file.
	 * @example http://localhost/radapp/uploads/photo/filename.jpg 
     * @var bool
     */
	private $returnFullPath = false;

	/**
     * current file index being uploaded
     * @var int
     */
	private $fileIndex = 0;

	/**
     * Http Request
     * @var \Illuminate\Http\Request
     */
	private $request = null;

	/**
     * list of uploaded files by url
     * @var array
     */
	public $uploadedFiles = [];

	public $hasErrors = false;

	public $errors = array();

	public $fieldName = "";

	function __construct($fieldName = null)
	{
		$this->fieldName = $fieldName;

		//get the current upload setting for the upload field
		$this->settings = $settings = config("upload.$fieldName");
		
		if (empty($settings)) {
			throw new \Exception("No Upload settings found for the field $fieldName");
		}
		
		$this->tempDir = config("upload.tempDir");

		$this->allowedExtensions = $settings["extensions"];
		$this->maxFileSize = intval($settings["max_file_size"]) * 1024; //in kilobyte
		$this->returnFullPath = $settings["return_full_path"];
		$this->filenamePrefix = $settings["filename_prefix"];
		$this->fileLimit = intval($settings["limit"]);
		$this->uploadDir = $settings["upload_dir"];
		$this->filenameType = $settings["file_name_type"];

		$uploadDir = public_path($this->uploadDir);
		$this->makeDir($uploadDir); //create directory if not exist
	}

	/**
     * Handle the file upload
	 * Support multitple file upload
	 * @method string upload
	 * @param string $fieldName
     * @return \Illuminate\Http\Response
     */
	function validate(Request $request)
	{
		$errors = [];
		$this->request = $request;
		if (!$this->request->hasFile("file")) {
			$errors[] = "no file selected for upload";
		}

		$rules = [
			"file.*" => "file|required|max:{$this->maxFileSize}|mimes:{$this->allowedExtensions}",
		];

		$validator = Validator::make($this->request->all(), $rules);

		if ($validator->fails()) {
			$errors[] = validationErrorsToString($validator->errors());
		}
		
		if ($validator->fails()) {
			$errors[] = $validator->errors();
		}

		$files = $request->file('file');

		if (!is_array($files)) {
			$files = array($files);
		}

		if (count($files) > $this->fileLimit) {
			$errors[] = "Maximum number of files ({$this->fileLimit}) exceeded";
		}
		return $errors;
	}


	/**
     * Handle the file upload
	 * Support multitple file upload
	 * @method string upload
	 * @param string $fieldName
     * @return \Illuminate\Http\Response
     */
	function upload(Request $request)
	{
		$this->request = $request;
		$files = $request->file('file');
		if (!is_array($files)) {
			$files = array($files);
		}
		$tempDir = public_path($this->tempDir);
		$this->makeDir($tempDir); //create directory if not exist
		$i = 0;
		foreach ($files as $file) {
			$i++;
			$this->file = $file;
			$this->fileIndex = $i;

			$uploadedFile = $this->saveFile();
			$this->uploadedFiles[] = $uploadedFile;
		}
		return $this->uploadedFiles;
	}

	/**
     * Handle the file upload to s3 bucket
	 * Support multitple file upload
	 * @method string upload
	 * @param string $fieldName
     * @return \Illuminate\Http\Response
     */
	function s3upload(Request $request)
	{
		$this->request = $request;
		$files = $request->file('file');
		if (!is_array($files)) {
			$files = array($files);
		}
		$i = 0;
		foreach ($files as $file) {
			$i++;
			$this->file = $file;
			$this->fileIndex = $i;
			$fileName = $this->uploadDir . "/" . $this->getFileName();
			$s3 = Storage::disk('s3');
			$uploaded = $s3->put($fileName, file_get_contents($file), 'public');
			if($uploaded){
				$uploadedFile = Storage::disk('s3')->url($fileName);
				$this->uploadedFiles[] = $uploadedFile;
			}
		}
		return $this->uploadedFiles;
	}
	
	/**
     * Save the uploaded file to a directory
	 * @method string saveFile
     * @return string
     */
	public function moveUploadedFiles($file)
	{
		$file = trim($file);
		if($file){
			$tmpFile = public_path($file);
			if(File::exists($tmpFile)){
				$fileName = basename($tmpFile);
				$newFilePath = $this->path_combine([$this->uploadDir, $fileName]);
				$newFile = public_path($newFilePath);
				$movedFile = File::move($tmpFile, $newFile);
				if($movedFile){
					if ($this->isImage($newFile)) {
						$this->resizeImage($newFile);
					}
					if ($this->returnFullPath) {
						return url($newFilePath);
					}
					return $newFilePath;
				}
			}
		}
		return $file;
	}

	/**
     * Save the uploaded file to a directory
	 * @method string saveFile
     * @return string
     */
	private function saveFile()
	{
		$this->fileName =  $this->getFileName();
		$uploadDir = public_path($this->tempDir);
		$this->file->move($uploadDir, $this->fileName);
		return $this->path_combine([$this->tempDir, $this->fileName]);
	}

	/**
     * Merge array of paths to a url
	 * 
	 * @method string saveFile
	 * @param array $arrPaths
	 * @param string $separator
     * @return string
     */
	private function path_combine($arrPaths, $separator = "/")
	{
		$paths = [];
		foreach ($arrPaths as $path) {
			$path = str_replace('/', $separator, $path);
			$path = str_replace('\\', $separator, $path);
			$paths[] = trim($path, $separator);
		}
		return join($separator, $paths);
	}
	/**
	 * Resizes a image using the Intervention Image package.
	 * save the thumb images to a directory
	 * @method void resizeImage
	 * @param string $file
	 * @return void
	 */
	private function resizeImage($file)
	{
		if (!empty($this->settings["image_resize"])) {

			$resizeSettings = $this->settings["image_resize"];
			$uploadDir = $this->uploadDir;
			foreach ($resizeSettings as $resizeName => $setting) {
				
				$image = Image::make($file);
				
				$width = $setting["width"] ?? $image->width();
				$height = $setting["height"] ?? $image->height();
				$mode = $setting["mode"];
				
				if($mode == "contain"){
					if($image->width() < $width){
						$width = $image->width();
					}

					if($image->height() < $height){
						$height = $image->height();
					}

					// resize the image to a width or height and constrain aspect ratio
					$image->resize($width, $height, function ($constraint) {
						$constraint->aspectRatio();
					});
				}
				elseif($mode == "cover"){
					// resize the image to a width and height
					$image->resize($width, $height);
				}
				
				$imgDir = public_path("$uploadDir/$resizeName");

				$this->makeDir($imgDir); //create directory if not exist
				$filename = basename($file);
				$image->save("$imgDir/$filename");
			}
		}
	}

	private function makeDir($dirPath) {
		if (!File::isDirectory($dirPath)) {
			File::makeDirectory($dirPath, 0775, true);
		}
	}
	
	/**
	 * Generate new file name for the uploaded file
	 * @method string  getFileName
	 * @return string
	 */
	private function getFileName()
	{
		$filename = "";
		$filenameType = $this->filenameType;
		if ($filenameType == "random") {
			$filename = Str::uuid()->toString();
		} else if ($filenameType == "date") {
			$filename = date('Y-m-d-H-i-s') . "-{$this->fileIndex}";
		} else if ($filenameType == "filecount") {
			$filename = $this->getDirFileCount($this->uploadDir) + 1;
		} else if ($filenameType == "timestamp") {
			$filename = time() . "-" . $this->fileIndex;
		} else if ($filenameType == "original") {
			$fileNameWithExtension = basename($this->file->getClientOriginalName()) . $this->fileIndex;
			$filename = pathinfo($fileNameWithExtension, PATHINFO_FILENAME); //get filename without extension
		}
		$extension = $this->file->getClientOriginalExtension();
		return "{$this->filenamePrefix}$filename.$extension";
	}

	/**
	 * Check if current uploading file is image
	 * @method string  isImage
	 * @return bool
	 */
	private function isImage($file)
	{
		$imgExtensions = ["jpg", "png", "gif", "jpeg"];
		$paths = pathinfo($file);
		$fileExtension = strtolower($paths["extension"]);
		return in_array($fileExtension, $imgExtensions);
	}

	/**
	 * Get number of files in a directory
	 * @method string  isImage
	 * @param string  dirpath
	 * @return int
	 */
	private function getDirFileCount($dirpath)
	{
		$filecount = 0;
		$files = glob($dirpath . "*");
		if ($files) {
			$filecount = count($files);
		}
		return $filecount;
	}
}
