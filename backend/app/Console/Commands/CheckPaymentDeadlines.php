<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckPaymentDeadlines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-payment-deadlines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $payments = Payment::where('status', '!=', false)->get();
        $now = Carbon::now(); // Corrected syntax
    
        foreach ($payments as $payment) {
            $createdAt = Carbon::parse($payment->created_at);
            $notificationDays = null;
    
            switch ($payment->status) {
                case 1:
                    $notificationDays = 30;
                    break;
                case 2:
                    $notificationDays = 30;
                    break;
                case 3:
                    $notificationDays = 180;
                    break;
                case 4:
                    $notificationDays = 365;
                    break;
            }
    
            $deadline = $createdAt->addDays($notificationDays);
            $threeDaysBeforeDeadline = $deadline->subDays(3);
    
            if ($now->gte($threeDaysBeforeDeadline) && $now->lt($deadline)) {
                Notification::create([
                    'type' => 'payment_deadline',
                    'post_id' => $payment->id,
                    'message' => 'Payment deadline approaching for payment ID ' . $payment->id,
                    'user_id' => $payment->user_id,
                    'status' => false,
                ]);
    
                // Optionally, send the notification to the user
                // $this->sendNotification($payment->user_id, 'Payment deadline approaching for your payment.');
            }
        }
    
        $this->info('Payment deadlines checked and notifications created.');
    }
}