<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Book;
use App\Models\User;
use App\Policies\BookPolicy;
use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Password;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
    //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
//        Gate::define('update-book',function(User $user,Book $book){
//            return $book->user()->is($user);
//        });

//        Password::defaults(fn()=>
//            Password::min(8)
//                ->unCompromied()
//            Password::min(8)
//                ->numbers()
//                ->mixedCase()
//                ->symbols()
//        );
    }
}
