<?php

namespace RrKhatri\Keywordable\Traits;

use RrKhatri\Keywordable\Models\Keyword;

trait Keywordable
{
    public function keywords()
    {
        return $this->morphMany(Keyword::class, 'subject');
    }

    public function removeKeywords(...$keywords)
    {
        if (count($keywords)) {
            $this->keywords()->whereIn('keyword', $keywords)->delete();
        } elseif (is_string($keywords)) {
            $this->keywords()->where('keyword', $keywords)->delete();
        } else {
            $this->keywords()->delete();
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
            $keywordsToBeCreated = [];

            $this->keywords()->delete();

            foreach ($keywords as $index => $keyword) {
                if (!$keyword || blank($keyword) || !trim($keyword)) {
                    unset($keywords[$index]);
                }
            }

            $keywords = array_unique($keywords);

            foreach ($keywords as $keyword) {
                $keywordsToBeCreated[] = [
                    'subject_type' => self::class,
                    'subject_id'   => $this->id,
                    'keyword'      => $keyword,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
            }

            $this->keywords()->insert($keywordsToBeCreated);
        }
    }
}
