<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportBlogs extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'blog_id',
        'reason',
        'status'
    ];
    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }
    public function blogs()
    {
        $this->belongsTo(Blogs::class, 'blog_id');
    }
}
