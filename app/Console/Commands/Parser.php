<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\DataParser;
use Illuminate\Support\Carbon;
use IMDB;
use Illuminate\Support\Facades\Storage;

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
    protected $description = 'Information parsing ';

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
        include 'imdb.class.php';

        $url = "https://www.imdb.com/title/{$this->option('id')}";

        $IMDB = new IMDB($url);
        if ($IMDB->isReady) {

            $parsedData = [];
            $parsedData['title'] = $IMDB->getTitle();
            $parsedData['coverImage'] = $IMDB->getPoster($sSize = 'small', $bDownload = false);

            $url = $parsedData['coverImage'];
            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            Storage::put($name, $contents);

            $parsedData['releaseDate'] = $IMDB->getReleaseDate();
            $parsedData['rating'] = $IMDB->getRating();
            $parsedData['director'] = $IMDB->getDirector();

            //CATEGORIES
            $parsedData['category'] = [];
            foreach (explode(' / ', $IMDB->getGenre()) as $row) {
                array_push($parsedData['category'], $row);
            }
            $parsedData['category'] = json_encode($parsedData['category']);

            //RELEASEDATE
            $parsedData['releaseDate'] = [];
            foreach (explode(' ', $IMDB->getReleaseDate()) as $row) {
                array_push($parsedData['releaseDate'], $row);
            }
            //REMOVE LAST ELEMENT-COUNTRY
            array_pop($parsedData['releaseDate']);
            //PARSE TO TIMESTAMP
            $parsedData['releaseDate'] = Carbon::parse(implode("-", $parsedData['releaseDate']));

            DataParser::create($parsedData);

        }
    }
}
