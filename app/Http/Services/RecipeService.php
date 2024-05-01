<?php

namespace App\Http\Services;

use App\Models\recipe;
use Illuminate\Http\Request;


class RecipeService
{
    public function index($request){
        return recipe::all();
    }
    public function show($id)
    {
        return recipe::find($id);
    }

    public function store($request){
        $cloudinaryImage = $request->image->storeonCloudinary;
    }

}
