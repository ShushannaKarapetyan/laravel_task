<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\DataParser;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use IMDB;

class Parser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:imdb {--id=id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Information parsing';

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
     * @throws Exception
     */
    public function handle()
    {
        $url = "https://www.imdb.com/title/{$this->option('id')}";

        $IMDB = new IMDB($url);

        if ($IMDB->isReady) {

            $parsedData['title'] = $IMDB->getTitle();
            $parsedData['coverImage'] = $IMDB->getPoster($sSize = 'small', $bDownload = false);

            //SAVING THE IMAGE IN STORAGE
            $url = $parsedData['coverImage'];
            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            Storage::put($name, $contents);

            $parsedData['rating'] = $IMDB->getRating();
            $parsedData['director'] = $IMDB->getDirector();

            //CATEGORIES
            $parsedData['category'] = json_encode(explode(' / ', $IMDB->getGenre()));

            //RELEASEDATE
            $parsedData['releaseDate'] = explode(' ', $IMDB->getReleaseDate());

            //REMOVE LAST ELEMENT-COUNTRY
            array_pop($parsedData['releaseDate']);

            //PARSE TO TIMESTAMP
            $parsedData['releaseDate'] = Carbon::parse(implode("-", $parsedData['releaseDate']));

            DataParser::create($parsedData);

        }
    }
}
