<?php

namespace App\Providers;

use App\Mail\UserCreated;
use App\Mail\UserMailChange;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        User::created(function($user){

            retry(5, function() use ($user){

                Mail::to($user)->send(new UserCreated($user));

            }, 100);

        });

        User::updated(function($user){
            Mail::to($user)->send(new UserMailChange($user));
        });

        Product::updated(function($product){
            if($product->quantity == 0 && $product->isAvailable()){

                $product->status = Product::UNAVAILABLE_PRODUCT;

                $product->save();
            }
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
