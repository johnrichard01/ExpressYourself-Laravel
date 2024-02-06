<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'category',
        'description',
        'thumbnail',
        'about',
        'user_id'
    ];
    public function scopeFilter($query, array $filters){
        if ($filters['category'] ?? false) {
            $query->where('category', 'like', '%' . request('category') . '%');
        }
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('category', 'like', '%' . request('search') . '%');
        }
    }
    //relationship to user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
