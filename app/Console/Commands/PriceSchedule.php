<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Price;
use Illuminate\Support\Facades\Http;

class PriceSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'price:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $prices = Price::all();

        foreach ($prices as $price) {
            $from     = $price->from;
            $endPoint = "https://min-api.cryptocompare.com/data/price?fsym=$from&tsyms=USD";
            $response = Http::get($endPoint);
            $jsonData = $response->json();

            if (isset($jsonData['USD'])) {
                Price::updateOrCreate(
                    [
                        'from' => $from
                    ],
                    [
                        'value' => $jsonData['USD']
                    ]
                );
            }
        }

        return 0;
    }
}
