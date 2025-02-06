<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'title' , 'description', 'price', 'address', 
        'type', 'status', 'quartos', 'banheiros', 'area'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function favoritedBy(){
        return $this->belongsToMany(User::class, 'favorites');
    }
}
