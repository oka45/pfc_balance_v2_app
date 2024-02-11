<?php

namespace App\Http\Controllers\Admin\FoodCompositionList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FoodCompositionList;

class createController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $file_name = $request->file('food_composition_list_file')->getClientOriginalName();
        $request->file('food_composition_list_file')->storeAs('food_composition_lists', $file_name);

        return redirect()->route('admin.food_composition_list.index');
    }
}
