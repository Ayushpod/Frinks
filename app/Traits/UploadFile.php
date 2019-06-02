<?php	
namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadFile
{
    public function upload(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : str_random(25).$uploadedFile->getClientOriginalExtension();

        $file = $uploadedFile->storeAs($folder, $name, $disk);

        return $file;
    }
}