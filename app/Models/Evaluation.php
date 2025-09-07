<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = ['subject_id', 'item_id', 'evaluator_id', 'status', 'total_score', 'started_at', 'completed_at'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function evaluator()
    {
        return $this->belongsTo(\App\Models\User::class, 'evaluator_id');
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
