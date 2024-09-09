<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ban;
use App\Models\Bank;
use App\Models\Belief;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $admin = Auth()->user();
        return view('admin.index', compact('admin'));
    }

    public function userIndex()
    {
        $users = User::all();
        $admin = Auth()->user();
        return view('admin.user.index', compact('users', 'admin'));
    }

//    public function userCreate()
//    {
//        $users = User::all();
//        return view('admin.user.create', compact('users'));
//    }

    public function UpdateForm(Request $request)
    {
        $user = User::findOrFail($request->id);
        $admin = Auth()->user();
        return view('admin.user.update', compact( 'user', 'admin'));
    }

    public function Update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
            'user_id' => 'required|integer',
            'email' => 'nullable|email',
        ]);
        $user = User::find($validated['user_id']);
        if($validated['name'])
        {
            $user->name = $validated['name'];
        }
        if($validated['email'])
        {
            $user->email = $validated['email'];
        }
        $user->save();
        return redirect('admin/user');
    }

    public function Delete(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
        $message = 'Вы удалили аккаунт пользователя ' . $user->name . '(' . $request->id . ')';
        $admin = Auth()->user();
        return view('admin/user/message', compact('message',  'admin'));
    }

    public function BanForm(Request $request)
    {
        $user = User::findOrFail($request->id);
        $message = $user->name . '(' . $request->id . ')';
        $user_id = $request->id;
        $admin = Auth()->user();
        return view('admin.user.ban', compact('message',  'user_id', 'admin'));
    }

    public function Ban(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'user_id' => 'required|integer|unique:bans,user_id',
            'reason' => 'nullable|string|max:255',
        ]);
        $validated['admin_id'] = Auth()->id();
        $user = User::find($validated['user_id']);
        $user['banned'] = 1;
        $user->save();
        Ban::create($validated);
        return redirect('admin/user');
    }

    public function UnBan(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user['banned'] = null;
        $user->save();
        $unban = Ban::where('user_id', $request->id);
        $unban->delete();
        $message = 'Вы разблокировали аккаунт пользователя ' . $user->name . '(' . $request->id . ')';
        $admin = Auth()->user();
        return view('admin/user/message', compact('message', 'admin'));
    }
}
