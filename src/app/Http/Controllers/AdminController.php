<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Requests\SendEmailRequest;
use App\Http\Requests\CreateShopManagerRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminToUserMail;

class AdminController extends Controller
{
    public function index()
    {
        $shopManagers = User::with('shops')
        ->where('role_id', Role::where('name', 'shop_manager')->first()->id)
        ->get();
        return view('admin.shops.index', compact('shopManagers'));
    }
    public function store()
    {
        $shops=Shop::all();
        return view('admin.shops.create_shop_manager', compact('shops'));
    }
    public function create(CreateShopManagerRequest $request)
    {
        $validated = $request->validated();

        $shopManagerRole = Role::where('name', 'shop_manager')->first();

        $shopManager = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role_id' => $shopManagerRole->id,
        ]);
        // 店舗にマネージャーを割り当て
        Shop::where('id', $validated['shop_id'])->update(['manager_id' => $shopManager->id]);

        return redirect()->route('admin.users.create')->with('status', '店舗代表者を作成しました。');
    }
    public function createEmail()
    {
        // 全ユーザを取得
        $users = User::all();
        return view('admin.create-email', compact('users'));
    }

    public function sendEmail(SendEmailRequest $request)
    {
        $validated = $request->validated();

        // メール送信処理
        $recipients = User::whereIn('id', $validated['recipients'])->get();

        foreach ($recipients as $recipient) {
            Mail::to($recipient->email)->send(new AdminToUserMail($validated['subject'], $validated['message']));
        }

        return redirect()->route('admin.email.create')->with('status', 'メールを送信しました。');
    }

}