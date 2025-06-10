<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NewsRepository
{
    public function getAll(Request $request, string $countryCode, string $langCode)
    {
        // Create a cache key from country, language, and hashed full URL (for filters + pagination)
        $cacheKey = 'news_list_' . $countryCode . '_' . $langCode . '_' . md5($request->fullUrl());

        return Cache::tags(['news'])->remember($cacheKey, 60, function () use ($request, $countryCode, $langCode) {
            $query = News::with(['category', 'country', 'language'])
                ->whereHas('country', fn ($q) => $q->where('code', $countryCode))
                ->whereHas('language', fn ($q) => $q->where('code', $langCode));

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->get('category_id'));
            }

            if ($request->filled('search')) {
                $query->where('title', 'like', '%' . $request->get('search') . '%');
            }

            return $query->paginate(10);
        });
    }

    public function find(int $id, string $countryCode, string $langCode)
    {
        $cacheKey = 'news_show_' . $id . '_' . $countryCode . '_' . $langCode;

        return Cache::tags(['news'])->remember($cacheKey, 60, function () use ($id, $countryCode, $langCode) {
            return News::with(['category', 'country', 'language'])
                ->where('id', $id)
                ->whereHas('country', fn ($q) => $q->where('code', $countryCode))
                ->whereHas('language', fn ($q) => $q->where('code', $langCode))
                ->first();
        });
    }

    public function findById(int $id): ?News
    {
        return News::find($id);
    }

    public function create(array $data): News
    {
        return News::create($data);
    }

    public function update(int $id, array $data): News
    {
        $news = News::findOrFail($id);
        $news->update($data);
        return $news;
    }

    public function delete(News $news): bool
    {
        return $news->delete();
    }

    /**
     * Safely clear only news-related cache using tags.
     */
    public function clearCache(): void
    {
        Cache::tags(['news'])->flush(); // ✅ Safe: clears only tagged cache
    }
}
