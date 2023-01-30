<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


/**
 *
 */
trait UploadImageTrait
{

    public function uploadImage(Request  $request, $fieldName = 'image' , $folderName, $oldImage = ""){

        if ($request->hasFile($fieldName))
        {
            $file = $request->file($fieldName);

            if (Storage::disk('images')->exists($oldImage)) {
                Storage::disk('images')->delete($oldImage);
            }

            $imageName = Str::random() . '.' . $file->getClientOriginalExtension();
            $store_image =  $file->StoreAs($folderName, $imageName , 'images');
            // $store_image =  Storage::disk('images')->putFileAs($folderName, $file , $imageName);
        }
        else
        {
            $store_image = $oldImage;
        }

        return $store_image;

    }


    public function deleteImage($oldImage = ""){

        if (Storage::disk('images')->exists($oldImage)) {
            return Storage::disk('images')->delete($oldImage);
        }

    }



}
