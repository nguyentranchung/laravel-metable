<?php

namespace NguyenTranChung\Metable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Meta extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['key', 'value', 'type'];
    protected $guarded = [];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
