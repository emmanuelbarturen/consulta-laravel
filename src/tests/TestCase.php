<?php

namespace Consulta\Laravel\Test;

use Consulta\Laravel\Consulta;
use Consulta\Laravel\ConsultaServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;


/**
 * Class TestCase
 * @package Consulta\Laravel\Test
 */
class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [ConsultaServiceProvider::class];
    }

    /**
     * Load package alias
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Consulta' => Consulta::class,
        ];
    }
}
