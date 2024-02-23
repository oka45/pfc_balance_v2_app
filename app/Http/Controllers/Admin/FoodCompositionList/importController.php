<?php

namespace App\Http\Controllers\Admin\FoodCompositionList;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\FoodCompositionList\ImportRequest;
use App\Services\FoodCompositionListService;
use App\Services\FoodCompositionListHistoryService;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;

class importController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ImportRequest $request, XlsxReader $xlsx_reader, FoodCompositionListService $food_composition_list_service, FoodCompositionListHistoryService $food_composition_list_history_service)
    {
        $file = $request->file('food_composition_list_file');
        try {
            // 食品成分表の「表全体」タブを配列で取得
            $lists = $xlsx_reader->load($file->getRealPath())->getSheetByName('表全体')->toArray();
            $file_name = $file->getClientOriginalName();

            // 食品成分表ファイルを保存
            $file->storeAs('private/food_composition_list_files', $file_name);

            DB::beginTransaction();
            $food_composition_list_service->importFoodCompositionList($lists);
            $food_composition_list_history_service->importFoodCompositionListHistory($file_name, $lists);
            DB::commit();
            $message = '食品成分表のインポートに成功しました';
        } catch (\Exception $e) {
            DB::rollBack();
            Log::warning($e->getMessage());
            $message = '食品成分表のインポートに失敗しました';
        }

        return redirect()->route('admin.food_composition_list.index')->with('food_composition_list.message', $message);
    }

}
