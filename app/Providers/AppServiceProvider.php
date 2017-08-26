<?php

namespace App\Providers;

use Dingo\Api\Transformer\Adapter\Fractal;
use League\Fractal\Manager;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Dingo\Api\Contract\Debug\ExceptionHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(ExceptionHandler $handler)
    {
        $this->app['Dingo\Api\Transformer\Factory']->setAdapter(function () {
            return new Fractal(new Manager, 'include', ',', false);
        });

        $handler->register(function(ModelNotFoundException $e){
            throw new NotFoundHttpException('Resource not found.');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
