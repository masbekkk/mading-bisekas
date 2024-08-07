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

    public function handle(): void
    {
        $current = Carbon::now();
        $madings = Mading::all();
        foreach ($madings as $mading) {
            $length = $mading->tanggal->diffInDays($current);
            $status = $mading->status;
            $newStatus = $status; // Initialize with the current status

            switch ($status) {
                case 'Tagihan DP':
                    if ($length > 1)
                        $newStatus = 'FPP';
                    break;
                case 'FPP':
                    if ($length > 4)
                        $newStatus = 'Pengadaan';
                    break;
                case 'Pengadaan':
                    if ($length > 30)
                        $newStatus = 'Running';
                    break;
                case 'Running':
                    if ($length > 1)
                        $newStatus = 'RETUR';
                    break;
                case 'RETUR':
                    if ($length > 1)
                        $newStatus = 'BAST';
                    break;
                case 'BAST':
                    if ($length > 30)
                        $newStatus = 'Invoice';
                    break;
                case 'Invoice':
                    if ($length > 1)
                        $newStatus = 'Lunas';
                    break;
                    // Uncomment and implement if needed
                    // case 'Lunas':
                    //     // Some logic for Lunas status
                    //     break;
            }

            if ($newStatus !== $status) {
                $mading->status = $newStatus;
                $mading->save();
            }
        }
    }
}
