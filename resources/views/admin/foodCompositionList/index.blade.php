<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('食品構成表') }}
        </h2>
    </x-slot>
    <div class="container" style="color: white;">
        <form action="{{ route('admin.food_composition_list.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" id="food_composition_list_file" name="food_composition_list_file" class="">
            <button type="submit">食品構成表のインポート</button>
        </form>
        <table class="container text-center"> 
            <thead>
                <tr>
                    <th>食品名</th>
                    <th>プロテイン</th>
                    <th>炭水化物</th>
                    <th>脂質</th>
                    <th>食塩</th>
                    <th>100gあたりのカロリー</th>
                </tr>
            </thead>
            <tbody>
                @foreach($food_composition_lists as $food_composition_list)
                    <tr>
                        <td>{{ $food_composition_list->food_name }}</td>
                        <td>{{ $food_composition_list->protein }}</td>
                        <td>{{ $food_composition_list->carbohydrate }}</td>
                        <td>{{ $food_composition_list->fat }}</td>
                        <td>{{ $food_composition_list->salt_equivalents }}</td>
                        <td>{{ $food_composition_list->calorie }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-white">
            {{ $food_composition_lists->links() }}
        </div>
    <div>
</x-app-layout>