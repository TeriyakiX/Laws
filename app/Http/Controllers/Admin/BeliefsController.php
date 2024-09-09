<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Belief;
use Illuminate\Http\Request;

class BeliefsController extends Controller
{
    public function index()
    {
        $admin = Auth()->user();
        $beliefs = Belief::all();
        return view('admin/beliefs/index', compact( 'admin', 'beliefs'));
    }

    public function createForm()
    {
        $admin = Auth()->user();
        return view('admin.beliefs.create', compact('admin'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            //'name' => 'nullable',
            'field1' => 'nullable',
            'field2' => 'nullable',
            'field3' => 'nullable',
            'field4' => 'nullable',
            'field5' => 'nullable',
            'user_id' => 'nullable|integer',
            'start_date' => 'nullable|date',
            'last_complate_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'percent' => 'nullable|integer',
            'is_сontinues' => 'nullable|between:0,1',
        ]);

        $fields = collect($request->all())
            ->filter(function ($value, $key) {
                return str_starts_with($key, 'field');
            })->filter()->values();
        $validated['name'] = json_decode($fields->toJson(), true);
        //$validated['name'] = $fields->toJson();
        //$validated['name'] = json_decode($request->input('name'), true);
        Belief::create($validated);
        return redirect('admin/beliefs');
    }

    public function updateForm(Request $request)
    {
        $admin = Auth()->user();
        $bel = Belief::find($request->id);
        return view('admin.beliefs.update', compact('bel', 'admin'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
//            'name' => 'nullable|json',
            'field1' => 'nullable',
            'field2' => 'nullable',
            'field3' => 'nullable',
            'field4' => 'nullable',
            'field5' => 'nullable',
            'user_id' => 'nullable|integer',
            'bel_id' => 'nullable|integer',
            'start_date' => 'nullable|date',
            'last_complate_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'percent' => 'nullable|integer',
            'is_сontinues' => 'nullable|between:0,1',
        ]);
        $bel = Belief::find($validated['bel_id']);
        $fields = collect($request->all())
            ->filter(function ($value, $key) {
                return str_starts_with($key, 'field');
            })->filter()->values();
        $data = $request->only(['user_id', 'start_date', 'last_complate_date', 'end_date', 'percent', 'is_сontinues']);
        $data['name'] = json_decode($fields->toJson(), true);
        $bel->fill($data);
        $bel->save();
        return redirect('admin/beliefs');
    }

    public function delete(Request $request)
    {
        $bel = Belief::find($request->id);
        $bel->delete();
        $message = 'Вы удалили убеждение ' . $request->id;
        $admin = Auth()->user();
        return view('admin.beliefs.message', compact('message' ,'admin'));
    }
}
