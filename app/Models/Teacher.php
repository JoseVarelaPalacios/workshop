<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ['name','last_name','country_id'];

    public function courses(): BelongsToMany{
        return $this->belongsToMany(Course::class);
    }
    public function country(): BelongsTo {
        return $this->belongsTo(Country::class);
    }
}
