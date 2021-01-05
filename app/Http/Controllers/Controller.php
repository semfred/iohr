<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\File;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile($uploadfile, $type = 'A')
    {
        $file = new File();
        $file->type = $uploadfile->extension();
        if($folder = checkType($type))
        {
            $file->path = Storage::disk('public')->putFileAs(
                $folder, $uploadfile , Auth::user()->id . '_' . Carbon::now()->format('ymdss') . '_' . $type . '.' . $uploadfile->extension()
            );
        } else {
            return false;
        }

        $file->mimetype = $uploadfile->getClientMimeType();

        $file->upload_by = Auth::user()->id;
        $file->modified_by = Auth::user()->id;

        $file->save();

        return $file;
    }
}
