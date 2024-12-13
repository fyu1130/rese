<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stripe\Stripe;
use Stripe\PaymentMethod;
use Stripe\Customer;

class CreateTestCustomer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:create-test-customer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a test customer in Stripe';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $customer = Customer::create([
                'name' => 'Test Customer',
                'email' => 'testcustomer@example.com',
                'description' => 'This is a test customer for testing payments.',
            ]);

            $this->info("Customer ID: " . $customer->id);
        } catch (\Exception $e) {
            $this->error("Error creating customer: " . $e->getMessage());
        }
        // テストカード情報を使用して決済手段を作成
        $paymentMethod = PaymentMethod::create([
            'type' => 'card',
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => 12,
                'exp_year' => 2024,
                'cvc' => '123',
            ],
        ]);
        // カスタマーIDを指定（例：cus_XXXXXX）
        $customerId = 'cus_XXXXXX';

        // 決済手段をカスタマーに関連付け
        $paymentMethod->attach(['customer' => $customerId]);

        // カスタマーのデフォルトの決済手段に設定
        $customer = Customer::update($customerId, [
            'invoice_settings' => [
                'default_payment_method' => $paymentMethod->id,
            ],
        ]);
    }
}
