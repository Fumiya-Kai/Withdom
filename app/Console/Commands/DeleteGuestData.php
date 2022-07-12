<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\User;
use Illuminate\Console\Command;

class DeleteGuestData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delguest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'DeleteGuestData';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::find(1)->teams()->delete();
        User::find(1)->teams()->detach();
        Article::where('user_id', '=', 1)->delete();

        return 0;
    }
}
