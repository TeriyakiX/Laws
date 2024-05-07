<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;

use App\Http\Requests\BankRequest;
use App\Http\Resources\BankResource;
use App\Models\Bank;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends BaseController
{
    public function index(Request $request)
    {
        $user = $request->user();
        $banks = Bank::where('user_id', $user->id)->get();
        return $this->sendResponse(BankResource::collection($banks), 'Successfully.');
    }

    public function create(BankRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $bank = Bank::create($data);
        return $this->sendResponse(BankResource::make($bank), 'Successfully created.');
    }


    public function update($id, BankRequest $request)
    {
        $bank = Bank::findOrFail($id);
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $bank->update($data);
        return $this->sendResponse(BankResource::make($bank), 'Successfully updated.');
    }

    public function delete($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();
        return $this->sendResponse('Deleted', 'Successfully.');
    }

}
