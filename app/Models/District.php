<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class District extends Model
{
    use HasFactory, Searchable;


    
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name
        ];
    }
}
