<?php

namespace App\Models;

use Core\LmsLite\Enums\CourseStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'date',
        'description',
        'content',
        'imageUrl',
        'level',
        'status',
        'meta',

        'category_slug',
        'teacher_id',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'status' => CourseStatus::class,
            'meta' => 'array',
        ];
    }

    protected function getKeyForSelectQuery()
    {
        return $this->slug;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_slug', 'slug');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
