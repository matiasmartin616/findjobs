<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joblisting extends Model
{
    use HasFactory;
    /* protected $fillable = ['title', 'description', 'company', 'location', 'website', 'email', 'tags']; */

    public function scopeFilter($query, array $filters) {
        if(!empty($filters['tag'])) {
            $query->where('tags', 'like', '%'. request('tag').'%');
        }

        if(!empty($filters['search'])) {
            $query->where('title', 'like', '%'. request('search').'%')
                ->orWhere('tags', 'like', '%'. request('search').'%')
                ->orWhere('description', 'like', '%'. request('search').'%');
        }
    }

    //related to user
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
