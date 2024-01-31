<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $auth = Auth::user();

        if (!$auth->is_admin) {
            $users = User::all();
            return redirect()->route('dashboard');
        }

        $delete_target_user = User::find($id);
        $delete_target_user->delete();

        return redirect()->route('admin.user.index');
    }
}
