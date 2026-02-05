<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\Part;

class PartAnswerController extends Controller
{
    public function index(Quest $quest, Part $part)
    {
        $answers = $part->answers()->with('user')->latest()->get();
        return view('admin.parts.answers', compact('part', 'answers'));
    }
}

