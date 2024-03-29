<?php

namespace RrKhatri\Keywordable\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = [
        'keyword', 'subject_id', 'subject_type',
    ];

    public function keywordable()
    {
        return $this->morphTo();
    }
}
