<?php

namespace App\Actions\Fortify;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Stripe\Customer;
use Stripe\Stripe;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input)
    {
        // Stripe APIキーを設定
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Stripeで顧客を作成
        $customer = Customer::create([
            'name' => $input['name'],
            'email' => $input['email'],
        ]);

        // デフォルトの役割を取得
        $defaultRole = Role::where('name', 'user')->first();

        // 新しいユーザーを作成
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'stripe_customer_id' => $customer->id,
            'role_id' => $defaultRole->id, // デフォルトの役割IDを設定
        ]);
    }
}
