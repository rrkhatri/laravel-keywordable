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
        $keywords = $this->getKeywords($keywords);

        return $query->whereHas('keywords', function ($q) use ($keywords) {
            $q->where('keyword', 'regexp', $keywords);
        });
    }

    public function scopeOrHavingKeywords($query, ...$keywords)
    {
        $keywords = $this->getKeywords($keywords);

        return $query->orWhereHas('keywords', function ($q) use ($keywords) {
            $q->where('keyword', 'regexp', $keywords);
        });
    }

    public function scopeHavingStrictKeywords($query, ...$keywords)
    {
        $keywords = $this->getKeywords($keywords);

        foreach ($keywords as $keyword) {
            $query->whereHas('keywords', function ($q) use ($keyword) {
                $q->where('keyword', $keyword);
            });
        }

        return $query;
    }

    public function scopeOrHavingStrictKeywords($query, ...$keywords)
    {
        $keywords = $this->getKeywords($keywords);

        $query->orWhere(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->whereHas('keywords', function ($q) use ($keyword) {
                    $q->where('keyword', $keyword);
                });
            }
        });

        return $query;
    }

    /**
     * @param array|string $keywords
     */
    public function syncKeywords(...$keywords)
    {
        $keywords = $this->getKeywords($keywords);

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

    public function getKeywords($keywords)
    {
        if (is_array($keywords) && count($keywords) == 1) {
            $keywords = $keywords[0];
        }

        return $keywords;
    }
}
