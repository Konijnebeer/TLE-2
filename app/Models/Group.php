<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /** @use HasFactory<\Database\Factories\GroupFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'code',
        'code_expires_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'code_expires_at' => 'datetime',
        ];
    }

    /**
     * Get the users that belong to the group.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(GroupUser::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Get the nature parks for the group.
     */
    public function naturePark()
    {
        return $this->hasOne(NaturePark::class);
    }

    /**
     * Check if the class code has expired.
     */
    public function isCodeExpired(): bool
    {
        return $this->code_expires_at !== null && $this->code_expires_at->isPast();
    }

    /**
     * Expire the class code (set code and expires_at to null).
     */
    public function expireCode(): void
    {
        $this->update([
            'code' => null,
            'code_expires_at' => null
        ]);
    }
}
