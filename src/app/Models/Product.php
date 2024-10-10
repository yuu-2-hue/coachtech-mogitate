<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Season;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword))
        {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    }

    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }
}
