<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // Nešto potrebno da form bude uspješan
    // Pravi je u AppServiceProvider.php
    /* protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags']; */


    // Tag filter
    public function scopeFilter($query, array $filters){
        // if there is not a tag, do what is in here
        // ?? - Returns the value of $x.
        //The value of $x is expr1 if expr1 exists, and is not NULL.
        //If expr1 does not exist, or is NULL, the value of $x is expr2.
        if($filters['tag'] ?? false){
            $query->where('tags', 'like', '%'. request('tag'). '%');
        }

        if($filters['search'] ?? false){
            // Search for the search term in the title
            // % prije i % poslije su da laravel prepozna bilo što
            // prije i poslije tražene riječi, ako sam dobro skužio
            $query->where('title', 'like', '%'. request('search'). '%')
                ->orWhere('description', 'like', '%'. request('search'). '%')
                ->orWhere('tags', 'like', '%'. request('search'). '%');
        }
    }

    // Define Relationship to User (User.php)
    // The relationship is 'Belongs to'
    // Because a listing belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
