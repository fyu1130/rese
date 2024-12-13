<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleBasedEmailVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // 未ログインユーザーはログインページにリダイレクト
        if (!$user) {
            return redirect('/login')->withErrors(['message' => 'ログインしてください。']);
        }

        // 管理者と店舗代表者はメール認証をスキップ
        if (isset($user->role) && ($user->role->name === 'admin' || $user->role->name === 'shop_manager')) {
            return $next($request);
        }

        // 一般ユーザーでメール未認証の場合はメール認証ページにリダイレクト
        if (!$user->hasVerifiedEmail()) {
            if (!$request->is('email/verify', 'logout')) {
                return redirect()->route('verification.notice');
            }
        }

        return $next($request);
    }

}