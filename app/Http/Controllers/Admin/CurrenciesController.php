<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Belief;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Http\Request;

class CurrenciesController extends Controller
{
    public function index()
    {
        $admin = Auth()->user();
        $curs = Currency::all();
        return view('admin/currencie/index', compact( 'admin', 'curs'));
    }

    public function createForm()
    {
        $admin = Auth()->user();
        return view('admin.currencie.create', compact('admin'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'country' => 'nullable|string|max:255',
            'currency_name' => 'nullable|string|max:255',
            'currency_symbol' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:255',
        ]);
        Currency::create($validated);
        return redirect('admin/currencies');
    }

    public function updateForm(Request $request)
    {
        $admin = Auth()->user();
        $cur = Currency::find($request->id);
        return view('admin.currencie.update', compact('cur', 'admin'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'country' => 'nullable|string|max:255',
            'cur_id' => 'required|integer',
            'currency_name' => 'nullable|string|max:255',
            'currency_symbol' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:255',
        ]);
        $cur = Currency::find($validated['cur_id']);
        if($validated['country'])
        {
            $cur->country = $validated['country'];
        }
        if($validated['currency_name'])
        {
            $cur->currency_name = $validated['currency_name'];
        }
        if($validated['currency_symbol'])
        {
            $cur->currency_symbol = $validated['currency_symbol'];
        }
        if($validated['currency'])
        {
            $cur->currency = $validated['currency'];
        }
        $cur->save();
        return redirect('admin/currencies');
    }

    public function delete(Request $request)
    {
        $cur = Currency::find($request->id);
        $cur->delete();
        $message = 'Вы удалили ' . $cur->currency_name . '(' . $request->id . ')';
        $admin = Auth()->user();
        return view('admin/currencie/message', compact('message' ,'admin'));
    }
}
