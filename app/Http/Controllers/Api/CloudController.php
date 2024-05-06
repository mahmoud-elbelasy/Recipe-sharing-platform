<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecipeRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use Illuminate\Http\Request;

class CloudController extends Controller
{
    public function upload(StoreRecipeRequest $request){
        // dd($request);

        $path = "laravel-cloud";
        $file = $request->file('image');
        $randomId = rand(100000,999999);
        $fileName = "image_". $randomId . $file->getClientOriginalExtension();
        $publicId = date('Y-m-d H:i:s'). '_' . $fileName;
        $upload = Cloudinary::upload($request->file('image')->getRealPath(),
        [
            "public_id" => $publicId,
            "folder" => $path
        ])->getSecurePath();
        
        return $upload;
        
    }
}
