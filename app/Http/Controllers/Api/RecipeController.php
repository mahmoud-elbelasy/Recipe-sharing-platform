<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Services\RecipeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    private CloudController $cloudController;
    private RecipeService $recipeService;
    public function __construct(RecipeService $recipeService, CloudController $cloudController)
    {
        $this->recipeService = $recipeService;
        $this->cloudController = $cloudController;
    }

    public function index(Request $request)
    {
        return $this->recipeService->index($request);
    }

    public function show($id){
       return $this->recipeService->show($id);
    }

    public function store(StoreRecipeRequest $request){
     
        $image_url = $this->cloudController->upload($request);
       
       return $this->recipeService->store($request, $image_url);
    }

    public function fetchIP(Request $request)
    {
        return $request->ip();
    }
}
