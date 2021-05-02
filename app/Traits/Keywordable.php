<?php

use RrKhatri\App\Keyword;

trait Keywordable
{
    public function keywords()
    {
        return $this->morphMany(Keyword::class, 'subject');
    }

    public function deleteKeywords(...$keywords)
    {
        if (count($keywords)) {
            $this->keywords()->whereIn('keyword', $keywords)->delete();
        } else {
            $this->keywords()->where('keyword', $keywords)->delete();
        }
    }

    public function scopeHavingKeywords($query, ...$keywords)
    {
        return $query->whereHas('keywords', function ($q) use ($keywords) {
            $q->where('keyword', 'like', $keywords);
        });
    }

    public function scopeOrHavingKeywords($query, ...$keywords)
    {
        return $query->orWhereHas('keywords', function ($q) use ($keywords) {
            $q->where('keyword', 'like', $keywords);
        });
    }

    public function scopeHavingStrictKeywords($query, ...$keywords)
    {
        return $query->whereHas('keywords', function ($q) use ($keywords) {
            $q->where('keyword', $keywords);
        });
    }

    public function scopeOrHavingStrictKeywords($query, ...$keywords)
    {
        return $query->orWhereHas('keywords', function ($q) use ($keywords) {
            $q->where('keyword', $keywords);
        });
    }

    /**
     * @param array|string $keywords
     */
    public function syncKeywords(...$keywords)
    {
        if (is_string($keywords) && $keywords = trim($keywords)) {
            $keywords = explode(',', $keywords);
        }

        if (is_array($keywords)) {
            $this->keywords()->delete();

            foreach ($keywords as $index => $keyword) {
                if (! $keyword || blank($keyword) || ! trim($keyword)) {
                    unset($keywords[$index]);
                }
            }

            $keywords = array_unique($keywords);

            foreach ($keywords as $keyword) {
                $this->keywords()->create(['keyword' => $keyword]);
            }
        }
    }
}
