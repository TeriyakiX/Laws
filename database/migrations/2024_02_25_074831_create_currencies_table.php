<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('currency_name');
            $table->string('currency_symbol');
            $table->string('currency');
            $table->timestamps();
        });

        $this->init();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }

    public function init(): void
    {

        \App\Models\Currency::create([
                                         'country' => 'russia',
                                         'currency_name' => 'Российский рубль',
                                         'currency_symbol' => '₽',
                                         'currency' => 'RUB',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'united_states',
                                         'currency_name' => 'Доллар США',
                                         'currency_symbol' => '$',
                                         'currency' => 'USD',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'european_union',
                                         'currency_name' => 'Евро',
                                         'currency_symbol' => '€',
                                         'currency' => 'EUR',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'united_kingdom',
                                         'currency_name' => 'Фунт стерлингов',
                                         'currency_symbol' => '£',
                                         'currency' => 'GBP',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'switzerland',
                                         'currency_name' => 'Швейцарский франк',
                                         'currency_symbol' => '₣',
                                         'currency' => 'CHF',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'canada',
                                         'currency_name' => 'Канадский доллар',
                                         'currency_symbol' => '$',
                                         'currency' => 'CAD',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'australia',
                                         'currency_name' => 'Австралийский доллар',
                                         'currency_symbol' => '$',
                                         'currency' => 'AUD',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'singapore',
                                         'currency_name' => 'Сингапурский доллар',
                                         'currency_symbol' => '$',
                                         'currency' => 'SGD',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'bulgaria',
                                         'currency_name' => 'Болгарский лев',
                                         'currency_symbol' => 'лв',
                                         'currency' => 'BGN',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'azerbaijan',
                                         'currency_name' => 'Азербайджанский манат',
                                         'currency_symbol' => '₼',
                                         'currency' => 'AZN',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'belarus',
                                         'currency_name' => 'Белорусский рубль',
                                         'currency_symbol' => 'Br',
                                         'currency' => 'BYN',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'georgia',
                                         'currency_name' => 'Грузинский лари',
                                         'currency_symbol' => '₾',
                                         'currency' => 'GEL',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'united_arab_emirates',
                                         'currency_name' => 'Дирхам (ОАЭ)',
                                         'currency_symbol' => 'Dh',
                                         'currency' => 'AED',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'israel',
                                         'currency_name' => 'Израильский шекель',
                                         'currency_symbol' => '₪',
                                         'currency' => 'ILS',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'poland',
                                         'currency_name' => 'Польский злотый',
                                         'currency_symbol' => 'zł',
                                         'currency' => 'PLN',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'turkey',
                                         'currency_name' => 'Турецкая лира',
                                         'currency_symbol' => '₺',
                                         'currency' => 'TRY',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'china',
                                         'currency_name' => 'Китайские юани',
                                         'currency_symbol' => '¥',
                                         'currency' => 'CNY',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'hong_kong',
                                         'currency_name' => 'Гонконгский доллар',
                                         'currency_symbol' => '$',
                                         'currency' => 'HKD',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'sweden',
                                         'currency_name' => 'Шведская крона',
                                         'currency_symbol' => 'kr',
                                         'currency' => 'SEK',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'czech_republic',
                                         'currency_name' => 'Чешская крона',
                                         'currency_symbol' => 'Kč',
                                         'currency' => 'CZK',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'thailand',
                                         'currency_name' => 'Тайский бат',
                                         'currency_symbol' => 'THB',
                                         'currency' => 'THB',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'india',
                                         'currency_name' => 'Индийская рупия',
                                         'currency_symbol' => '₹',
                                         'currency' => 'INR',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'japan',
                                         'currency_name' => 'Японская иена',
                                         'currency_symbol' => '¥',
                                         'currency' => 'JPY',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'hungary',
                                         'currency_name' => 'Венгерский форинт',
                                         'currency_symbol' => 'Ft',
                                         'currency' => 'HUF',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'kazakhstan',
                                         'currency_name' => 'Казахстанский тенге',
                                         'currency_symbol' => '₸',
                                         'currency' => 'KZT',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'armenia',
                                         'currency_name' => 'Армянский драм',
                                         'currency_symbol' => 'AMD',
                                         'currency' => 'AMD',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'south_korea',
                                         'currency_name' => 'Южнокорейская вона',
                                         'currency_symbol' => '₩',
                                         'currency' => 'KRW',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'indonesia',
                                         'currency_name' => 'Индонезийская рупия',
                                         'currency_symbol' => 'Rp',
                                         'currency' => 'IDR',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'vietnam',
                                         'currency_name' => 'Вьетнамский донг',
                                         'currency_symbol' => '₫',
                                         'currency' => 'VND',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'norway',
                                         'currency_name' => 'Норвежская крона',
                                         'currency_symbol' => 'kr',
                                         'currency' => 'NOK',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'brazil',
                                         'currency_name' => 'Бразильский реал',
                                         'currency_symbol' => '$',
                                         'currency' => 'BRL',
                                     ]);

        \App\Models\Currency::create([
                                         'country' => 'tajikistan',
                                         'currency_name' => 'Таджикский сомони',
                                         'currency_symbol' => 'с.',
                                         'currency' => 'TJS',
                                     ]);

    }

};
