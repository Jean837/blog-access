<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'post_id',
        'user_id',
        'parent_id',
        'is_approved'
    ];

    // Relation : auteur du commentaire
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relation : article
    public function post() {
        return $this->belongsTo(Post::class);
    }

    // Relation : commentaire parent
    public function parent() {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relation : réponses à ce commentaire
    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id')
                    ->where('is_approved', true)
                    ->with('user')
                    ->orderBy('created_at', 'asc');
    }
}