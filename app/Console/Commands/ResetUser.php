<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ResetUserStatus extends Command
{
    protected $signature = 'user:reset-status';
    protected $description = 'Reset user status to available';

    public function handle()
    {
        User::query()->update(['status' => 0]);
        $this->info('All user statuses have been reset to available');
    }
};
