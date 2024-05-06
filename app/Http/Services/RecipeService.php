<?php

namespace App\Http\Services;

use App\Http\Controllers\Api\CloudController;
use App\Models\recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RecipeService
{
    
    public function index($request){
        return recipe::all();
    }
    public function show($id)
    {
        return recipe::find($id);
    }

    public function store($request, $image_url){
        $user = Auth::user();

        $recipe = Recipe::create([
       
            'components' => $request->components,
            'description' => $request->description,
            'image' => $image_url,
            'user_id'=>$user->id
          
        ]);

        return $recipe;

    }

}
