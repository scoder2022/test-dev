<?php

namespace App\Services;

use App\Repositories\NewsRepository;
use Illuminate\Http\Request;
use App\Events\NewsCreated;
use App\Events\NewsUpdated;
use App\Jobs\ShareNewsToSocialPlatforms;
use Illuminate\Support\Facades\Cache;

class NewsService
{
    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }


    public function getAll(Request $request, string $countryCode, string $langCode)
    {
        return $this->newsRepository->getAll($request, $countryCode, $langCode);
    }


    public function find(int $id, string $countryCode, string $langCode)
    {
        return $this->newsRepository->find($id, $countryCode, $langCode);
    }


    public function create(array $data)
    {
        $news = $this->newsRepository->create($data);

        event(new NewsCreated($news));
        dispatch(new ShareNewsToSocialPlatforms($news));

        $this->newsRepository->clearCache();

        return $news;
    }


    public function update(int $id, array $data)
    {
        $news = $this->newsRepository->update($id, $data);

        event(new NewsUpdated($news));
        dispatch(new ShareNewsToSocialPlatforms($news));

        $this->newsRepository->clearCache();

        return $news;
    }


    public function delete(int $id)
    {
        $news = $this->newsRepository->findById($id);

        if ($news) {
            $this->newsRepository->delete($news);
            $this->newsRepository->clearCache();
        }
    }
    
}
