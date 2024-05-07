<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;

use App\Http\Requests\CurrencyRequest;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurrencyController extends BaseController
{
    public function index(Request $request)
    {
        $currency = Currency::all();
        return $this->sendResponse(CurrencyResource::collection($currency), 'Successfully.');
    }

    public function create(CurrencyRequest $request)
    {
        $data = $request->validated();
        $currency = Currency::create($data);
        return $this->sendResponse(CurrencyResource::make($currency), 'Successfully.');
    }


    public function update($id, CurrencyRequest $request)
    {
        $currency = Currency::findOrFail($id);
        $data = $request->validated();
        $currency->update($data);
        return $this->sendResponse(CurrencyResource::make($currency), 'Successfully.');
    }

    public function delete($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();
        return $this->sendResponse('Deleted', 'Successfully.');
    }

}
