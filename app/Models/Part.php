<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    /** @use HasFactory<\Database\Factories\PartFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'quest_id',
        'order_index',
        'name',
        'description',
        'media_url',
        'success_condition',
    ];

    /**
     * Get the quest that owns the part.
     */
    public function quest()
    {
        return $this->belongsTo(Quest::class);
    }

    /**
     * Get the nature parks that have this part.
     */
    public function natureParks()
    {
        return $this->belongsToMany(NaturePark::class, 'nature_park_part')
            ->withPivot('status', 'completed_at')
            ->withTimestamps();
    }
}
