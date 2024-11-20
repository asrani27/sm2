<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use App\Models\Suara;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SaksiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'createsaksi';

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
        $data = Suara::get()->map(function ($item) {
            $item->nama_kelurahan = $item->kelurahan == null ? null : str_replace(' ', '_', strtolower($item->kelurahan->nama));
            $item->username = $item->nama_kelurahan . '_' . $item->tps;
            $param['suara_id'] = $item->id;
            $param['username'] = $item->username;
            return $param;
        });

        $role = Role::where('name', 'saksi')->first();
        foreach ($data as $item) {
            //create user
            $check = User::where('username', $item['username'])->first();
            if ($check == null) {
                $n = new User;
                $n->username = $item['username'];
                $n->password = Hash::make('bjmhebat');
                $n->name = $item['username'];
                $n->suara_id = $item['suara_id'];
                $n->save();

                $n->roles()->attach($role);
                $this->info("User created: {$item['username']}");
            } else {

                $this->info("User already exists: {$item['username']}");
            }
        }
    }
}
