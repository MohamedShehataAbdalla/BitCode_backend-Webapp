<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


/**
 *
 */
trait DownloadAttachmentTrait
{

    public function downloadAttachment(Request  $request){

        $download_attachment = '';
        if (Storage::disk('uploads')->exists($request->attachment)) {

            $download_attachment = Storage::disk('uploads')->download($request->attachment);

        }

        return $download_attachment;

    }


}
