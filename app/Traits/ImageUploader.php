<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use File;
/**
 * Trait UploadAble
 * @package App\Traits
 */
trait ImageUploader
{
    /**
     * @param null $folder
     * @param string $disk
     * @param null $filename
     * @return false|string
     */ //file,size,
    public function uploadOne($file,$width,$height,$path)
    {
        //dd($file);
        //dd($width );
        //dd($height );
         //get filename with extension
         $filenameWithExt = $file->getClientOriginalName();
         //get filename
         $getfilename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
         //get extension
         $extension =$file->getClientOriginalExtension();
         //filename to store
         $fileName= $getfilename.'_'.time().'.'.$extension;
         //$path = ;
         //dd($path);
         $image  = \Image::make($file)->resize($width, $height)->save(public_path('user/'.$path.'/').$fileName);


       // dd($fileNameToStore);
        return $fileName;

    }

    public function uploadImage($file,$width,$height,$path)
      {
        $filename = time().'.' . explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
        //
        \Image::make($file)->resize($width, $height)->save(public_path('user/'.$path.'/').$filename);

        return $filename;
    }

    public function nativeUpload($filePath,$path)
    {
      $fileArray = explode('/',$filePath);
      $size = sizeof($fileArray);
      $filename = time().$fileArray[$size -1];
      $file = $filePath;

       \Image::make($file)->save(public_path('user/'.$path.'/').$filename);
    //  \File::put(public_path('user/'.$path.'/'). time().$filename, $filePath);
    // Storage::putFileAs('uploads', $filePath, time().$filename
    // );

      return $filename;
  }

    /**
     * @param null $path
     * @param string $disk
     */
    public function deleteImage($path)
    {
        @unlink($path);
    }
}
