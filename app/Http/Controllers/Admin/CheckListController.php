<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Models\Currency;
use Illuminate\Http\Request;

class CheckListController extends Controller
{
    public function index()
    {
        $admin = Auth()->user();
        $checklist = Checklist::all();
        return view('admin/checklist/index', compact( 'admin', 'checklist'));
    }

    public function updateForm(Request $request)
    {
        $admin = Auth()->user();
        $checklist = Checklist::find($request->id);
        return view('admin.checklist.update', compact('checklist', 'admin'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|integer',
            'checklist_id' => 'required|integer',
            'name' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'finished' => 'nullable|between:0,1',
            'for_myself' => 'nullable|between:0,1',
        ]);
        $checklist = Checklist::find($validated['checklist_id']);
        $data = $request->only(['user_id', 'name', 'date', 'finished', 'for_myself']);
        $checklist->fill($data);
        $checklist->save();
        return redirect('admin/checklist');
    }

    public function delete(Request $request)
    {
        $checklist = Checklist::find($request->id);
        $checklist->delete();
        $message = 'Вы удалили ' . $checklist->name . '(' . $request->id . ')';
        $admin = Auth()->user();
        return view('admin/checklist/message', compact('message' ,'admin'));
    }
}
