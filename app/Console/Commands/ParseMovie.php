<?php

namespace App\Console\Commands;

use App\Services\ImdbParser;
use Exception;
use Illuminate\Console\Command;

class ParseMovie extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:movie {titleId : The ID of the movie title}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse a movie from https://www.imdb.com';

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
        $this->line("Parsing the movie...");

        try {
            $imdbParser = new ImdbParser($this->argument('titleId'));
            $movie = $imdbParser->parse();
            $this->info("{$movie->title} parsed!");
        } catch (Exception $exception) {
            $this->error('Something went wrong, ' . $exception->getMessage());
        }
    }
}
