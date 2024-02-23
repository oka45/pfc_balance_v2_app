<?php

namespace App\Http\Controllers\Admin\FoodCompositionList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FoodCompositionList;
use App\Models\FoodCompositionListHistory;

class indexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $food_composition_lists = FoodCompositionList::paginate(20);
        $food_composition_list_history = FoodCompositionListHistory::all();

        return view('admin.foodCompositionList.index')->with([
            'food_composition_lists' => $food_composition_lists,
            'food_composition_list_history' => $food_composition_list_history,
        ]);
    }
}
