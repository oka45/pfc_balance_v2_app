<?php

namespace App\Services;

use App\Models\FoodCompositionList;
use Illuminate\Support\Str;

class FoodCompositionListService
{
    public function importFoodCompositionList($lists)
    {
        // 食品成分表を全削除
        FoodCompositionList::query()->delete();

        $save_data_list = $this->convert($lists);
        // インポートされた新しい食品成分表をDBに保存
        // 12行目から食品の成分がはじまる
        foreach ($save_data_list as $index => $save_data) {
            $food_composition_list = new FoodCompositionList();
            $food_composition_list->id = $index + 1;
            $food_composition_list->food_name = $save_data['food_name'];
            $food_composition_list->calorie = $save_data['calorie'];
            $food_composition_list->protein = $save_data['protein'];
            $food_composition_list->fat = $save_data['fat'];
            $food_composition_list->carbohydrate = $save_data['carbohydrate'];
            $food_composition_list->salt_equivalents = $save_data['salt_equivalents'];
            $food_composition_list->save();
        }
    }

    // 食品成分表の成分に文字列が指定される場合は文字列に変換
    private function encodeComposition($lists)
    {
        $pattan = '/[()]/';

        $encode_composition = Str::replaceMatches(
            pattern: $pattan,
            replace: '',
            subject: $lists
        );

        return  (float) $encode_composition;
    }

    // 食品成分表の不要なデータを削除
    private function convert($lists)
    {
        $data = [];
        // 要素の添字が12から食品の成分がはじまる
        for ($i = 12; $i < count($lists); $i++) {
            $tmp = [];
            // 食品名
            $tmp['food_name'] = $lists[$i][3];
            // カロリー
            $tmp['calorie'] = $this->encodeComposition($lists[$i][6]);
            // タンパク質
            $tmp['protein'] = $this->encodeComposition($lists[$i][9]);
            // 脂質
            $tmp['fat'] = $this->encodeComposition($lists[$i][12]);
            // 炭水化物
            $tmp['carbohydrate'] = $this->encodeComposition($lists[$i][20]);
            // 食塩
            $tmp['salt_equivalents'] = $this->encodeComposition($lists[$i][60]);

            $data[] = $tmp;
        }

        return $data;
    }
}
