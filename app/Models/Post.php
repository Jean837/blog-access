<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasSlug;

    protected $fillable = [
        'title', 'slug', 'content', 'excerpt',
        'cover_image', 'video_url', 'video_file',
        'status', 'category_id', 'user_id', 'views'
    ];

    public function getSlugOptions(): SlugOptions {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // Retourne l'embed YouTube/Vimeo si c'est un lien
    public function getVideoEmbedUrl(): ?string {
        if (!$this->video_url) return null;

        // YouTube
        if (preg_match('/youtube\.com\/watch\?v=([^\&]+)/', $this->video_url, $m) ||
            preg_match('/youtu\.be\/([^\?]+)/', $this->video_url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }
        // Vimeo
        if (preg_match('/vimeo\.com\/(\d+)/', $this->video_url, $m)) {
            return 'https://player.vimeo.com/video/' . $m[1];
        }
        return null;
    }

    // Temps de lecture estimé (200 mots/min)
    public function getReadingTimeAttribute(): int 
    {
        $words = str_word_count(strip_tags($this->content));
        return max(1, (int) ceil($words / 200));
    }

    public function ratings() {
       return $this->hasMany(Rating::class);
    }

    public function averageRating(): float {
       return round($this->ratings()->avg('stars') ?? 0, 1);
    }

    public function userRating(): ?int {
       if (!auth()->check()) return null;
       return $this->ratings()->where('user_id', auth()->id())->value('stars');
    }

}