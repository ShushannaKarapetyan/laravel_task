<?php

namespace App\Services;

use App\Movie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use IMDB;
use Exception;

class ImdbParser
{

    protected $imdb;

    /**
     * ImdbParser constructor.
     * @param $titleId
     * @throws Exception
     */
    public function __construct($titleId)
    {

        try {
            $imdb = new IMDB("https://www.imdb.com/title/{$titleId}");
        } catch (Exception $exception) {
            throw new Exception('Movie was not found!');
        }

        if (!$imdb->isReady) {
            throw new Exception('Movie was not found!');
        }

        $this->imdb = $imdb;
    }

    public function parse()
    {
        $releaseDateData = explode(' (', $this->imdb->getReleaseDate());
        $releaseDate = isset($releaseDateData[0]) ? Carbon::createFromFormat('d M Y', $releaseDateData[0]) : null;
        $releaseDateCountry = isset($releaseDateData[1]) ? str_replace(')', '', $releaseDateData[1]) : null;
        $categories = json_encode(explode(' / ', $this->imdb->getGenre()));

        $url = $this->imdb->getPoster('small', false);

        if ($url && $url !== '') {
            $contents = file_get_contents($url);
            $explodedImageName = explode('.', substr($url, strrpos($url, '/')));
            $extension = end($explodedImageName);
            $path = "public/covers/" . Str::random(40) . ".{$extension}";

            Storage::put($path, $contents);
        }

        $movie = Movie::create([
            'title' => $this->imdb->getTitle(true),
            'cover_image' => @$path,
            'release_date' => $releaseDate,
            'release_date_country' => $releaseDateCountry,
            'rating' => $this->imdb->getRating(),
            'category' => $categories,
            'director' => $this->imdb->getDirector(),
        ]);

        return $movie;
    }
}
