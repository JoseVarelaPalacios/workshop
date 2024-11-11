<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name','duration','description','mode','start_date',
    'finish_date','cost','image'];
    public function teachers() : BelongsToMany{
        return $this->belongsToMany(Teacher::class);
    }
}
