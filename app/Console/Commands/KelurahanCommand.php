<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use App\Models\Kelurahan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class KelurahanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'createkelurahan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $data = Kelurahan::get()->map(function ($item) {
            $item->username = str_replace(' ', '_', strtolower($item->nama));
            $param['kelurahan_id'] = $item->id;
            $param['username'] = $item->username;
            return $param;
        });

        $role = Role::where('name', 'kelurahan')->first();
        foreach ($data as $item) {
            //create user
            $check = User::where('username', $item['username'])->first();
            if ($check == null) {
                $n = new User;
                $n->username = $item['username'];
                $n->password = Hash::make('bjmhebat');
                $n->name = $item['username'];
                $n->kelurahan_id = $item['kelurahan_id'];
                $n->save();

                $n->roles()->attach($role);
                $this->info("User created: {$item['username']}");
            } else {

                $this->info("User already exists: {$item['username']}");
            }
        }
    }
}
