<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reserve;
use App\Mail\ReservationReminderMail;
use Illuminate\Support\Facades\Mail;

class SendReservationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '予約リマインダーを送信する';

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
        $today = now()->startOfDay();
        $reservations = Reserve::whereDate('date', $today)->get();

        foreach ($reservations as $reservation) {
            Mail::to($reservation->user->email)->send(new ReservationReminderMail($reservation));
        }

        $this->info('リマインダーを送信しました！');
    }
}
