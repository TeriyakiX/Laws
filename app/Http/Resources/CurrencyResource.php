<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ru' => [
                'id' => $this->id,
                'country' => $this->country,
                'currency_name' => $this->currency_name_ru,
                'currency_symbol' => $this->currency_symbol,
                'currency' => $this->currency,
            ],
            'en' => [
                'id' => $this->id,
                'country' => $this->country,
                'currency_name' => $this->currency_name_en,
                'currency_symbol' => $this->currency_symbol,
                'currency' => $this->currency,
            ],
            'zh' => [
                'id' => $this->id,
                'country' => $this->country,
                'currency_name' => $this->currency_name_zh,
                'currency_symbol' => $this->currency_symbol,
                'currency' => $this->currency,
            ],
        ];
    }
}
