<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\DateConverter;

class Question extends Model
{
  protected $guarded = ['id'];
  
  protected $fillable = ['question_text', 'correct_answer', 'score'];
  
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  
  use DateConverter;
    
}
