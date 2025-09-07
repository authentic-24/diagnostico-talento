<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'company', 'position', 'email', 'notes', 'evaluation_prompt_id'];
    public function prompt()
    {
        return $this->belongsTo(EvaluationPrompt::class, 'evaluation_prompt_id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
