<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbonl;

/**
 * @property int $id
 * @property int $author_id
 *
 * @property string $name
 *
 * @property Carbon $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @property-read Author $author
 */
class Product extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'author_id',
        'name',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'date:Y-m-d'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
