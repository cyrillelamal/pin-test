<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * @property int|null $id
 * @property string $article
 * @property string $name
 * @property Status $status
 * @property array $data also known as attributes.
 */
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $attributes = [
        'data' => '{}',
    ];

    protected $casts = [
        'data' => 'json',
    ];

    protected $fillable = [
        'article',
        'name',
        'status',
        'data',
    ];

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', Status::AVAILABLE);
    }

    public function status(): Attribute
    {
        return new Attribute(
            get: fn(string|Status $status) => is_string($status) ? Status::from($status) : $status,
        );
    }
}
