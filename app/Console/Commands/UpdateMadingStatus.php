<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mading;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateMadingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:mading-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of Madings';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $current = Carbon::now();
        $madings = Mading::all();
        Log::info('updating status color at: ' . Carbon::now());
        foreach ($madings as $mading) {
            $madingTanggal = Carbon::parse($mading->tanggal);
            $length = $madingTanggal->diffInDays($current);
            $status = $mading->status;
            $newStatus = $status; // Initialize with the current status
            $color = $mading->status_color;

            switch ($status) {
                case 'Tagihan DP':
                    if ($length >= 3)
                        $color = 'dark';
                    elseif ($length >= 2)
                        $color = 'danger';
                    // $newStatus = 'FPP';
                    break;
                case 'FPP':
                    if ($length >= 3)
                        $color = 'dark';
                    elseif ($length >= 2)
                        $color = 'danger';
                    // if ($length > 4)
                    //     $newStatus = 'Pengadaan';
                    break;
                case 'Time Schedule':
                    if ($length >= 3)
                        $color = 'dark';
                    elseif ($length >= 2)
                        $color = 'danger';
                    // if ($length > 4)
                    //     $newStatus = 'Pengadaan';
                    break;
                case 'Pengadaan':
                    if ($length >= 3)
                        $color = 'dark';
                    elseif ($length >= 2)
                        $color = 'danger';
                    // if ($length > 30)
                    //     $newStatus = 'Running';
                    break;
                case 'Pengadaan':
                    if ($length >= 3)
                        $color = 'dark';
                    elseif ($length >= 2)
                        $color = 'danger';
                    // if ($length > 30)
                    //     $newStatus = 'Running';
                    break;
                case 'Running':
                    // if ($length > 1)
                    //     $newStatus = 'RETUR';
                    break;
                case 'Finish':
                    if ($length >= 3)
                        $color = 'dark';
                    elseif ($length >= 2)
                        $color = 'danger';
                    // if ($length > 1)
                    //     $newStatus = 'BAST';
                    break;
                case 'RETUR':
                    if ($length >= 3)
                        $color = 'dark';
                    elseif ($length >= 2)
                        $color = 'danger';
                    // if ($length > 30)
                    //     $newStatus = 'Invoice';
                    break;
                case 'Invoice':
                    if ($length >= 31)
                        $color = 'dark';
                    elseif ($length >= 30)
                        $color = 'danger';
                    // if ($length > 1)
                    //     $newStatus = 'Lunas';
                    break;
                case 'Invoice':
                    if ($length >= 31)
                        $color = 'dark';
                    elseif ($length >= 30)
                        $color = 'danger';
                    // if ($length > 1)
                    //     $newStatus = 'Lunas';
                    break;
                    // Uncomment and implement if needed
                    // case 'Lunas':
                    //     // Some logic for Lunas status
                    //     break;
            }


            // if ($newStatus !== $status) {
            $mading->status_color = $color;
            $mading->save();
            // }
        }

        return Command::SUCCESS;
    }
}
