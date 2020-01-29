<?php

namespace App\Console;

use App\Etherium\Responses\Block;
use App\Facades\Etherium;
use App\Models\Wallet;
use App\Services\TransactionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Ratchet\Client\WebSocket;
use React\EventLoop\LoopInterface;
use function Ratchet\Client\connect;

class StartWebsocketConnector extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket:connect';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->output->text('Start listening ws server');
        $this->updateServiceState();
        $this->connect();
    }

    private function updateServiceState()
    {
        Wallet::all()->each(function (Wallet $wallet) {
            $balance = Etherium::getBalance($wallet->address);

            $wallet->balance = $balance;
            $wallet->save();

            Redis::connection()->set('eth_wallet_' . $wallet->address, $wallet->address);
        });
    }

    private function connect()
    {
        connect($this->getWsApiUri())->then(function(WebSocket $conn) {
            $this->output->success('Connection was successful');

            $conn->on('message', function($message) use ($conn) {
                $this->onMessage($message);
            });

            $this->sendRequest($conn);
        }, function ($e) {
            $this->output->error("Could not connect: {$e->getMessage()}");
        });
    }

    /**
     * @param $message
     */
    private function onMessage($message)
    {
        $response = json_decode($message, true);

        if (isset($response['params'])) {
            $blockHash = $response['params']['result']['hash'];
            $blockNumber = $response['params']['result']['number'];
            $blockResponse = Etherium::getBlock($blockHash);
            $transactions = $blockResponse['transactions'];
            $block = new Block($blockHash, $blockNumber, $transactions);

            (new TransactionService($block))->parseTransactions();
        }

    }

    private function sendRequest($conn)
    {
        $conn->send(
            json_encode(['jsonrpc' => "2.0", "id" => 1, "method" => "eth_subscribe", "params" => ["newHeads"]])
        );
    }

    private function getWsApiUri()
    {
        $config = config('etherium');
        $defaultProvider = $config['default_driver'];

        $providerConfig = config("etherium.{$defaultProvider}");

        return sprintf(
            'wss://%s.%s/%s'
            , $providerConfig['network'],
            $providerConfig['ws_uri'],
            $providerConfig['project_id']
        );
    }
}
