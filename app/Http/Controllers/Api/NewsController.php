<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Http\Resources\NewsResource;
use App\Models\News;

class NewsController extends Controller
{
    protected NewsService $newsService;


    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }



    public function index(Request $request)
    {
        $lang = $request->header('x-lang-code');
        $country = $request->header('x-country-code');

        if (!$lang || !$country) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $news = $this->newsService->getAll($request, $country, $lang);
        return NewsResource::collection($news);
    }


    public function store(StorePostRequest $request)
    {
        $news = $this->newsService->create($request->validated());
        return new NewsResource($news);
    }


    public function show(Request $request, $id)
    {
        $lang = $request->header('x-lang-code');
        $country = $request->header('x-country-code');

        if (!$lang || !$country) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $news = $this->newsService->find($id, $country, $lang);

        if (!$news) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return new NewsResource($news);
    }


    public function update(UpdatePostRequest $request, $id)
    {
        $news = $this->newsService->update($id, $request->validated());
        return new NewsResource($news);
    }


    public function destroy($id)
    {
        $this->newsService->delete($id);
        return response()->json(['message' => 'News Deleted successfully']);
    }
}
