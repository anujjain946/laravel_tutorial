<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\CountryCheck;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        #Check Global Middleware

        #$middleware->append(\App\Http\Middleware\CheckAge::class);
                                #OR
        #$middleware->append(CheckAge::class);


        $middleware->appendToGroup('check1',[
            CheckAge::class,
            CountryCheck::class
        ]);

        // $middleware->alias([
        //     'check.age' => \App\Http\Middleware\CheckAge::class,
        // ]);

        // $middleware->group('web', [
        //     \App\Http\Middleware\CheckAge::class,
        // ]);


       
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
