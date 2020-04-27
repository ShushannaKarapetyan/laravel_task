<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;

class LocaleController extends Controller
{
    /**
     * @param string $locale
     * @return RedirectResponse
     */
    public function setLocale($locale = 'en')
    {
        if (!in_array($locale, ['en', 'ru'])) {
            $locale = 'en';
        }

        Cookie::queue('locale', $locale, 24000);

        return back();
    }
}
