<?php 

namespace App\Helper;
use File;
use Illuminate\Http\UploadedFile;
use Image;
use Request;
use Storage;

class Filemgr {

	public static function deletefiletemp($file,$directory)
	{
		$filepath = $directory .'/'. $file ;
		 
		$disk = Storage::disk('local'); //APFix use the disk throughout the process so we can move files if needed
		
		  
		if (!$disk->exists($filepath)) {
			return ['success' => false,'message' => 'File not found'];
		}
		
		
		if($disk->has($filepath))
		{
			return ['success' => $disk->delete($filepath),'message'=>''];
		}
		

		
	}

	public static function deletefile($file,$directory)
	{
		$filepath = $directory .'/'. $file ;
		$disk = Storage::disk('local'); //APFix use the disk throughout the process so we can move files if needed
		if (!$disk->exists($filepath)) {
			return ['success' => false,'message' => 'File not found'];
		}
		if($disk->has($filepath))
		{
			return $disk->delete($filepath);
		}
		
	}

	public static function move($file,$frompath,$topath)
	{
		$moving_file = $frompath .'/'. $file ;
		$destination_file = $topath .'/'. $file ;
		$disk = Storage::disk('local'); //APFix use the disk throughout the process so we can move files if needed

		// dd($disk->exists($moving_file));
		if (!$disk->exists($moving_file)) {
			return false;
		}
		if($disk->exists($destination_file))
		{
			$new_file = date('ymdiG') . $file;
			$destination_file = $topath .'/'. $new_file ;
		}

		return $disk->move($moving_file,$destination_file);
		
	}

	public static function filesize($file,$directory)
	{
		$filepath = $directory .'/'. $file ;
		$disk = Storage::disk('local'); //APFix use the disk throughout the process so we can move files if needed
		if($disk->has($filepath))
		{
			return $disk->size($filepath);
		}

		return 0;
		
	}
	public static function uploadFile($fileField, $directory,$disk='local')
	{
		$disk = Storage::disk($disk); //APFix use the disk throughout the process so we can move files if needed
		$file = Request::file($fileField);
		if( !isset( $file ) )
			return ['success' => false,'message' => 'Please select a file to upload.'];

		$extension = $file->getClientOriginalExtension();
		$filename = date('ymdiG') . '_' . static::sanitiseFilename( $file->getClientOriginalName(), $extension );

		if ($directory=='' || empty($directory)) 
		{
			$filepath = $filename;
		}else{

			$filepath = $directory . '/' . $filename;
		}

		$disk->put($filepath, File::get($file));

		if( ! $disk->exists($filepath) )
			return ['success'=>false,'message'=>'There was a problem uploading the file'];

		return [
			'success' => true,
			'message' => 'File successfully uploaded: '.$filename,
			'filename' => $filename,
			'filepath' => $filepath
		];
	}

	public static function copyfile($url,$directory)
	{
		$disk = Storage::disk('local'); //APFix use the disk throughout the process so we can move files if needed
		if( empty( $url ) )
		return false;

		$directory = 'box/'.$directory;
		if (!$disk->exists($directory)) {
			$disk->makeDirectory($directory); 
		}
		$fileContents = file_get_contents($url);

		$filename = mt_rand(6,6).date('ymdiG') . '.jpg';
        $file = 'tmp/' . $filename;
        file_put_contents($file, $fileContents);
        $uploaded_file = new UploadedFile($file, $filename);
        $filepath = $directory. '/' .$filename ;
        $disk->put($filepath, File::get($file));
		
		return $filename;
		 
	}
	public static function uploadFile_watermark($fileField, $directory)
	{
		$disk = Storage::disk('local'); //APFix use the disk throughout the process so we can move files if needed
		$file = Request::file($fileField);
		if( !isset( $file ) )
			return ['success' => false,'message' => 'Please select a file to upload.'];
		$extension = $file->getClientOriginalExtension();
		$filename = date('ymdiG') . '_' . static::sanitiseFilename( $file->getClientOriginalName(), $extension );

		$filepath = $directory . '/' . $filename;


		$disk->put($filepath, File::get($file));
		
		$siteconfig = \App\Models\Siteconfig::find(1);							
		$waterMarkUrl = (empty($siteconfig->watermark) || !$disk->exists('config/'.$siteconfig->watermark))? 'default/watermark.png': 'images/config/'.$siteconfig->watermark;

		// $image = Image::make($waterMarkUrl)->resize(122,78)->save($waterMarkUrl);
		$image = Image::make('images/'.$filepath)->insert($waterMarkUrl, 'center', 5, 5)->save('images/'.$filepath);
		
		 
		if( ! $disk->exists($filepath) )
			return ['success'=>false,'message'=>'There was a problem uploading the file'];

		return [
			'success' => true,
			'message' => 'File successfully uploaded: '.$filename,
			'filename' => $filename,
			'filepath' => $filepath
		];
	}
	/**
	 * Sanitise a filename for use in code.
	 * @param  string $filename Name of the file
	 * @return string           Cleaned Filename
	 */
	public static function sanitiseFilename($filename=null)
	{
		// Remove anything which isn't a word, whitespace, number
		// or any of the following caracters -_~,;:[]().
		$filename = preg_replace("([^\w\d\-_~,;:\[\]\(\).])", '', $filename);
		// Remove any runs of periods
		$filename = preg_replace("([\.]{2,})", '', $filename);

		return $filename;
	}

	/**
	 * Remove the file extension from a filename
	 * @param  string $filename
	 * @param  string $extension File extension without the dot
	 * @return string            resulting filename without extension
	 */
	public static function removeFileExtension($filename, $extension)
	{
		return substr( $filename, 0, ( -1 - strlen($extension) ) );
	}

	public static function sanitiseAndRemoveFileExtension($filename, $extension)
	{
		$_filename = Static::removeFileExtension( $filename, $extension );
		return Static::sanitiseFilename( $_filename );
	}

	public static function getfile($file_path)
	{
		$adapter = Storage::disk('local')->getDriver()->getAdapter();

		$command = $adapter->getClient()->getCommand('GetObject', [
	        'Bucket' => $adapter->getBucket(),
	        'Key'    => $adapter->getPathPrefix().$file_path
	    ]);

	    $request = $adapter->getClient()->createPresignedRequest($command, '+10 minute');
	    $str =  (string) $request->getUri();

	    return $str;

	}

	public static function get_file($file_path)
	{
		return Storage::disk('local')->get($file_path);
		 
	   

	}
}
