<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use  App\ProductType;
use  App\Cart;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('header',function($view){
            $loai_sanpham=ProductType::all();
            $view->with('loai_sp',$loai_sanpham);

        });

        view()->composer('header',function($view){
            if(Session('cart')){
                $old_cart=Session::get('cart');
                $cart=new Cart($old_cart); 
                $view->with(['cart'=>$cart,'product_cart'=>$cart->items,
            'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
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
