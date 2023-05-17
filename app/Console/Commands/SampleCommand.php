<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sampleCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sampleCommand';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        echo 'でぃすこまんどいずさんぷる.';
    }
}
