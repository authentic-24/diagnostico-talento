<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['item_id', 'text', 'type', 'options', 'order', 'required'];

    protected $casts = [
        'options' => 'array',
        'required' => 'boolean',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
