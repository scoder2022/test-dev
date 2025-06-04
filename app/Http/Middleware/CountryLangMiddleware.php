<?php

namespace App\Http\Middleware;

use App\Models\Country;
use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountryLangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next)
    {
        $country = Country::where('code', $request->header('x-country-code'))->first();
        $language = Language::where('code', $request->header('x-lang-code'))->first();

        if (!$country || !$language) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $request->merge([
            'country_id' => $country->id,
            'language_id' => $language->id,
        ]);

        return $next($request);
    }


}
