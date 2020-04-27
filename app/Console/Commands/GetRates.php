<?php

namespace App\Console\Commands;

use App\Services\RateGetter;
use Exception;
use Illuminate\Console\Command;

class GetRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:rates {base=USD}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rates get every hour from https://exchangeratesapi.io';

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
     * @return mixed
     */
    public function handle()
    {
        $this->line("Getting rates...");

        try {
            $currencyGetter = new RateGetter($this->argument('base'));
            $currencyGetter->getRates();

        } catch (Exception $exception) {
            $this->error('Something went wrong, ' . $exception->getMessage());
        }
    }
}
