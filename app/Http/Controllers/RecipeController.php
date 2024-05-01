<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Services\RecipeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    private RecipeService $recipeService;
    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    public function index(Request $request)
    {
        return $this->recipeService->index($request);
    }

    public function show($id){
       return $this->recipeService->show($id);
    }

    public function create(StoreRecipeRequest $request){
        // return Auth::guard('api')->user()->id;

       $this->recipeService->store($request);
    }

    public function fetchIP(Request $request)
    {
        return $request->ip();
    }
}
