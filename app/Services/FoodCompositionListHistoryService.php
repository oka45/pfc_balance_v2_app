<?php

namespace App\Services;

use App\Models\FoodCompositionListHistory;
use Carbon\Carbon;

class FoodCompositionListHistoryService
{
    public function importFoodCompositionListHistory($file_name, $lists)
    {
        $food_composition_list_history = new FoodCompositionListHistory();
        $food_composition_list_history->file_name = $file_name;
        $food_composition_list_history->food_composition_list_created_date = $this->encodeUpdateDate($lists);
        $food_composition_list_history->save();
    }

    // 食品成分表の更新日を文字列から日付へ変換
    private function encodeUpdateDate($lists)
    {
        // 食品成分表から更新日を取得
        $update_date = $lists[0][61];
        preg_match('/(\d+)年(\d+)月(\d+)/', $update_date, $matches);

        return  Carbon::createMidnightDate($matches[1], $matches[2], $matches[3])->format('Y-m-d');
    }
}
