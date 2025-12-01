<?php

namespace App\Models;

use App\Enums\QuestCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    /** @use HasFactory<\Database\Factories\QuestFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'difficulty_level',
        'category',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'category' => QuestCategory::class,
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the parts for the quest.
     */
    public function parts()
    {
        return $this->hasMany(Parts::class);
    }
}
