<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaturePark extends Model
{
    /** @use HasFactory<\Database\Factories\NatureParkFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'group_id',
        'state',
    ];

    /**
     * Get the group that owns the nature park.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Get the parts assigned to this nature park.
     */
    public function parts()
    {
        return $this->belongsToMany(Parts::class, 'nature_park_part')
            ->withPivot('status', 'completed_at')
            ->withTimestamps();
    }
}
