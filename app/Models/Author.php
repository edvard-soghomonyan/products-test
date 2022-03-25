<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 *
 * @property string $name
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Product[] $products
 */
class Author extends Model
{
    use HasFactory;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'author_id');
    }
}
