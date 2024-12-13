<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse {
            public function toResponse($request)
            {
                return view('verify-email'); // 登録後はメール確認ページにリダイレクト
            }
        });

        // ログイン後のリダイレクト設定
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                $user = $request->user();

                // ロールに応じてリダイレクト先を変更
                if ($user->role->name === 'admin') {
                    return redirect('/admin/shops'); // 管理者ダッシュボード
                }

                if ($user->role->name === 'shop_manager') {
                    return redirect('/shop-manager/shops'); // 店舗代表者ダッシュボード
                }

                return redirect('/'); // 一般ユーザーはホームページ
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::registerView(function () {
            return view('register');
        });
        Fortify::loginView(function () {
            return view('login');
        });
        Fortify::verifyEmailView(function () {
            return view('/thanks');
        });
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;
            return Limit::perMinute(10)->by($email . $request->ip());
        });
    }
}
