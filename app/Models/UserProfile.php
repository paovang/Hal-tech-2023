<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;


    public function getImageAttribute(){
        return config('services.file_path.user_profile') . $this->attributes['image'];
    }
}
