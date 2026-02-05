<?php
//namespace App\Models;
//
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
//
//class Answer extends Model
//{
//    use HasFactory;
//    protected $fillable = [
//        'part_id', 'user_id', 'answer_text',
//    ];
//
//    public function part() {
//        return $this->belongsTo(Part::class);
//    }
//    public function user() {
//        return $this->belongsTo(User::class);
//    }
//}
//


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['part_id', 'user_id', 'answer_text'];

    // Een antwoord hoort bij een stap
    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    // Een antwoord hoort bij een leerling
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
