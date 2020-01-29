<?php

namespace App\Etherium;

use App\Etherium\Providers\Infura;
use Illuminate\Support\Manager;

class EhteriumManager extends Manager
{
    protected function createInfuraDriver()
    {
        $config = $this->app['config']['etherium.infura'];

        return new Infura($config);
    }

    /**
     * @inheritDoc
     */
    public function getDefaultDriver()
    {
        return $this->app['config']['etherium.default_driver'];
    }
}
