<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmails extends Command
{
    protected $signature = 'send:welcome-emails';
    protected $description = 'Send welcome emails to all registered users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new WelcomeMail($user));
        }

        $this->info('Welcome emails sent to all registered users.');
    }
}