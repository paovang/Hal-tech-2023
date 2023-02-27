<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
// use Laravel\Scout\Attributes\SearchUsingPrefix;

class Province extends Model
{
    use HasFactory, Searchable;



    // public function searchableAs(): string
    // {
    //     return 'name';
    // }

    

    #[SearchUsingPrefix(['id'])]
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name
        ];
    }


    public function district()
    {
        return $this->hasMany(District::class);
    }

}
