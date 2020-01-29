<?php


namespace App\Etherium\Providers;


use App\Etherium\EtheriumProvider;
use Datto\JsonRpc\Http\Client;
use Datto\JsonRpc\Http\Exceptions\HttpException;
use Datto\JsonRpc\Responses\ErrorResponse;
use ErrorException;
use Exception;
use Webmozart\Assert\Assert;

class Infura implements EtheriumProvider
{
    private $client;

    public function __construct($config)
    {
        $this->client = new Client($this->buildUri($config));
    }

    /**
     * @param string $address
     * @return float
     * @throws HttpException
     * @throws ErrorException
     * @throws Exception
     */
    public function getBalance(string $address): float
    {
        $this->client
            ->query('eth_getBalance', [$address, 'latest'], $reply)
            ->send();

        if ($reply instanceof ErrorResponse) {
            throw new Exception('Wallet address not found');
        }

        return floatval(hexdec($reply));
    }

    public function getBlock(string $hash): array
    {
        $this->client
            ->query('eth_getBlockByHash', [$hash, true], $reply)
            ->send();

        if ($reply instanceof ErrorResponse) {
            throw new Exception('Invalid hash');
        }

        return $reply;
    }

    private function buildUri(array $config)
    {
        Assert::keyExists($config, 'network');
        Assert::keyExists($config, 'base_uri');
        Assert::keyExists($config, 'project_id');
        return sprintf('https://%s.%s/%s', $config['network'], $config['base_uri'], $config['project_id']);
    }
}
