<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use Illuminate\Http\Request;

class CloudController extends Controller
{
    public function upload($request){

        $path = "laravel-cloud";
        $file = $request->file('image');
        $randomId = rand(100000,999999);
        $fileName = "image_". $randomId . $file->getClientOrignalExtension();
        $publicId = date('Y-m-d H:i:s'). '_' . $fileName;
        $upload = Cloudinary::upload($request->file('image')->getRealPath(),
        [
            "public_id" => $publicId,
            "folder" => $$path
        ])->getSecurePath();
        
        return $upload;
        
    }
}
