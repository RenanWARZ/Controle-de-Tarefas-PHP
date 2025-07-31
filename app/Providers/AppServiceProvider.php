<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Auth;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if(Auth::check()){
        $qtdeNotificacoes = Notificacao::where('usuario_id', Auth::user()->id)->where('lida', 0)->count();
        $view->with('qtdeNotificacoes', $qtdeNotificacoes);
    }
});
    }
}
