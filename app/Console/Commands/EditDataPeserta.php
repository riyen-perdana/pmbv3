<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Peserta;
use Illuminate\Support\Facades\DB;

class EditDataPeserta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:edit-data-peserta';

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
        DB::beginTransaction();
        $peserta = Peserta::where('pin', '=', '992614812')->first();
        try {
            $peserta->update([
                'password' => bcrypt('100102'),
            ]);

            DB::commit();
            echo 'success';

        } catch (\Throwable $th) {
            DB::rollBack();
            echo $th->getMessage();
        }
    }
}
