<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Ethereum\EthereumAddress;
use App\Models\Ethereum\EthereumWallet;

class EthereumSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ethereum:schedule';

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
        $addresses = EthereumAddress::all();

        foreach($addresses as $aData) {
            $chain    = 'ethereum';
            $network  = config('keys.ethereum.network');
            $address  = $aData['address'];
            $endPoint = "blockchain-data/{$chain}/{$network}/addresses/{$address}";
            $response = Http::cryptoapi()->get($endPoint);
            $jsonData = $response->json();

            if (!isset($jsonData['error'])) {
                $item = $jsonData['data']['item'];
                $rlt  = EthereumWallet::updateOrCreate(
                    [
                        'address' => $aData['address']
                    ],
                    [
                        'transactionsCount'        => $item['transactionsCount'],
                        'confirmed_balance_amount' => $item['confirmedBalance']['amount'],
                        'confirmed_balance_unit'   => $item['confirmedBalance']['unit'],
                        'received_amount'          => $item['totalReceived']['amount'],
                        'received_unit'            => $item['totalReceived']['unit'],
                        'spent_amount'             => $item['totalSpent']['amount'],
                        'spent_unit'               => $item['totalSpent']['unit'],
                        'incomeTransactions'       => $item['incomingTransactionsCount'],
                        'outgoingTransactions'     => $item['outgoingTransactionsCount']
                    ]
                );
            }
        }

        return 0;
    }
}
