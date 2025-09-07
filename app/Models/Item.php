<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['title', 'description', 'order', 'created_by', 'subject_id'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
