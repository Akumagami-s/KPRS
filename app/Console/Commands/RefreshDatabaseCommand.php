<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Detailkpr;

class RefreshDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for migrate fresh then run the seeder.';

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
        Log::info("Menjalankan update tunggakan");

        Detailkpr::select('id', 'nama', 'jml_angs', 'angs_ke', 'angsuran_masuk', 'tunggakan', 'jml_tunggakan')
            ->each(function ($kpr) {
                if ($kpr->angs_ke != $kpr->angsuran_masuk) {
                    // $tunggakan = $kpr->tunggakan + 1;
                    // $jml_tunggakan = $kpr->jml_angs * $tunggakan;
                    // $angs_ke = $kpr->angs_ke + 1;

                    // DB::beginTransaction();
                    // try {
                    //     $kpr->update([
                    //         'angs_ke' => $angs_ke,
                    //         'tunggakan' => $tunggakan,
                    //         'jml_tunggakan' => $jml_tunggakan,
                    //     ]);
                    //     DB::commit();
                    // } catch (\Exception $e) {
                    //     Log::info($e->getMessage());
                    //     DB::rollback();
                    // }
                }
            });

        Log::info("Update berhasil");
    }
}
