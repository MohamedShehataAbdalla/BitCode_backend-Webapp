<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


/**
 *
 */
trait UploadAttachmentTrait
{

    public function uploadAttachment(Request  $request, $fieldName = 'attachment' , $folderName, $oldAttachment = ""){

        if ($request->hasFile($fieldName))
        {
            $file = $request->file($fieldName);

            if (Storage::disk('uploads')->exists($oldAttachment)) {
                Storage::disk('uploads')->delete($oldAttachment);
            }

            // $attachmentName = Str::random() . '.' . $file->getClientOriginalExtension();
            $attachmentName = $request->name . time() . '.' . $file->getClientOriginalExtension();
            $store_attachment =  $file->StoreAs($folderName, $attachmentName , 'uploads');
            // $store_attachment =  Storage::disk('uploads')->putFileAs($folderName, $file , $attachmentName);
        }
        else
        {
            $store_attachment = $oldAttachment;
        }

        return $store_attachment;

    }


    public function deleteAttachment($oldAttachment = ""){

        if (Storage::disk('uploads')->exists($oldAttachment)) {
            return Storage::disk('uploads')->delete($oldAttachment);
        }

    }



}
