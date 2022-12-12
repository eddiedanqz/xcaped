<?php 
namespace App\Traits;

use Intervention\Image\Facades\Image;

/**
 * Trait UploadAble
 * @package App\Traits
 */
trait ImageUploader
{
 public function uploadImage($file,$width,$height)
    {
        $filename = time().'.' . explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
        //
        \Image::make($request->profilePhoto)->resize($width, $height)->save(public_path('user/profile/').$filename);

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