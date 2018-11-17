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

    public function getValueAttribute($value)
    {
        if (in_array($this->type, ['array', 'object'])) {
            return json_decode(json_decode($value));
        }
        return $this->attributes['value'];
    }

    public function setValueAttribute($value)
    {
        if (in_array($this->type, ['array', 'object'])) {
            return json_encode($this->attributes['value']);
        }
        return $this->attributes['value'];
    }
}
