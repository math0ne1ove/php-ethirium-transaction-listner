<?php

namespace App\Services;

class EthCurrencyConverter
{
    const WEI = 'wei',
        GWEI = 'gwei',
        ETH = 'eth';

    const WEI_IN_ETH = 1000000000000000000,
        GWEI_IN_ETH = 1000000000;

    public static function convert(float $value, string $from, string $to)
    {
        if ($from === $to) {
            throw new \LogicException('Arguments $from, $to should not be equal');
        }

        $availableArgs = [
            self::WEI,
            self::GWEI,
            self::ETH,
        ];

        if (!in_array($from, $availableArgs) || !in_array($to, $availableArgs)) {
            throw new \InvalidArgumentException('Arguments passed incorrectly');
        }

        $method = $from . 'To' . ucfirst($to);

        return call_user_func('self::' .  $method, $value);
    }

    /**
     * @param float $value
     * @return float
     */
    private static function weiToGwei(float $value)
    {
        return round(floatval($value/self::GWEI_IN_ETH), 6);
    }

    /**
     * @param float $value
     * @return float
     */
    private static function gweiToWei(float $value)
    {
        return round(floatval($value*self::GWEI_IN_ETH));
    }

    /**
     * @param float $value
     * @return float
     */
    private static function weiToEth(float $value)
    {
        return round(floatval($value/self::WEI_IN_ETH), 6);
    }

    /**
     * @param float $value
     * @return float
     */
    private static function gweiToEth(float $value)
    {
        return round(floatval($value/self::GWEI_IN_ETH), 6);
    }

    /**
     * @param float $value
     * @return false|float
     */
    private function ethToGwei(float $value)
    {
        return round(floatval($value*self::GWEI_IN_ETH));
    }

    /**
     * @param float $value
     * @return false|float
     */
    private function ethToWei(float $value)
    {
        return round(floatval($value*self::WEI_IN_ETH));
    }
}
