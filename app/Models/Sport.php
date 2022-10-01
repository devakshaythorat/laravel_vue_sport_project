<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id', 'status'];
    protected $attributes = [
        'status' => true
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = ucfirst($value);
    }
}
