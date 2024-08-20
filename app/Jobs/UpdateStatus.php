<?php

namespace App\Jobs;

use App\Models\Mading;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateStatus implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */

    public function handle()
    {
        $current = Carbon::now();
        $madings = Mading::all();
        foreach ($madings as $mading) {

            $madingTanggal = Carbon::parse($mading->tanggal);
            $length = $madingTanggal->diffInDays($current);
            $status = $mading->status;
            $newStatus = $status; // Initialize with the current status
            $color = $mading->status_color;

            switch ($status) {
                case 'Tagihan DP':
                    if ($length >= 2)
                        $color = 'danger';
                    elseif ($length >= 3)
                        $color = 'dark';
                    // $newStatus = 'FPP';
                    break;
                case 'FPP':
                    if ($length >= 2)
                        $color = 'danger';
                    elseif ($length >= 3)
                        $color = 'dark';
                    // if ($length > 4)
                    //     $newStatus = 'Pengadaan';
                    break;
                case 'Pengadaan':
                    if ($length >= 2)
                        $color = 'danger';
                    elseif ($length >= 3)
                        $color = 'dark';
                    // if ($length > 30)
                    //     $newStatus = 'Running';
                    break;
                case 'Running':
                    // if ($length > 1)
                    //     $newStatus = 'RETUR';
                    break;
                case 'Finish':
                    if ($length >= 2)
                        $color = 'danger';
                    elseif ($length >= 3)
                        $color = 'dark';
                    // if ($length > 1)
                    //     $newStatus = 'BAST';
                    break;
                case 'RETUR & BAST':
                    if ($length >= 2)
                        $color = 'danger';
                    elseif ($length >= 3)
                        $color = 'dark';
                    // if ($length > 30)
                    //     $newStatus = 'Invoice';
                    break;
                case 'Invoice':
                    if ($length >= 30)
                        $color = 'danger';
                    elseif ($length > 31)
                        $color = 'dark';
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

        // return Command::SUCCESS;
    }
}
