<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationAnalysis extends Model
{
    protected $table = 'evaluation_analysis';
    protected $fillable = [
        'evaluation_id',
        'prompt',
        'analysis',
    ];
}
