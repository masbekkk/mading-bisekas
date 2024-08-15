<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mading;
use Carbon\Carbon;

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
        foreach ($madings as $mading) {

            $madingTanggal = Carbon::parse($mading->tanggal);
            $length = $madingTanggal->diffInDays($current);
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

        return Command::SUCCESS;
    }
}
