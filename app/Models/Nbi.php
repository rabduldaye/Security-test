<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nbi extends Model
{
    use HasFactory;
    
    public function getNBIAttribute()
    {
        $nbi = floatval($this->nbiraw * 100);

        return "{$nbi}%";
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
