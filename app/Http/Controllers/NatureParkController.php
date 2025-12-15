<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\NaturePark;
use App\Models\Part;
use App\Models\Quest;
use Gate;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreNatureParkRequest;
use App\Http\Requests\UpdateNatureParkRequest;

class NatureParkController extends Controller
{
    public function slideshow()
    {
        $parks = NaturePark::orderByDesc('state')->limit(5)->get();
        $natureFiles = File::files(public_path('natuurgebied-progression'));
        $natureImages = [];

        foreach ($natureFiles as $file) {
            $natureImages[] = $file->getFilename();
        }

        return view('home', compact('parks', 'natureImages'));
    }

    /**
     * See current pending quests for the group.
     */
    public function quests(naturePark $naturePark)
    {
        Gate::authorize('view', $naturePark);

        // get all connected quest parts via the nature park with their quest information
        $allParts = $naturePark->parts()
            ->with('quest')
            ->get();

        // Group parts by quest and filter out inactive quests or quests without pending parts
        $quests = $allParts->groupBy('quest_id')
            ->map(function ($questParts) {
                $quest = $questParts->first()->quest;

                // Get the total number of parts in the quest
                $totalParts = $quest->parts()->count();

                // Count completed parts (those with status = 'completed')
                $completedParts = $questParts->where('pivot.status', 'completed')->count();

                // Get pending parts for display
                $pendingParts = $questParts->where('pivot.status', 'pending');

                // Get the first pending part (sorted by order_index)
                $firstPendingPart = $pendingParts->sortBy('order_index')->first();

                return [
                    'quest' => $quest,
                    'parts' => $questParts,
                    'pending_parts' => $pendingParts,
                    'first_pending_part' => $firstPendingPart,
                    'total' => $totalParts,
                    'completed' => $completedParts,
                    'has_pending' => $pendingParts->count() > 0,
                ];
            })
            ->filter(function ($questData) {
                // Only include quests that are active AND have at least one pending part
                return $questData['quest']->is_active && $questData['has_pending'];
            });


        return view('groups.quests', compact('quests', 'naturePark'));
    }

    function questShow(NaturePark $naturePark, Quest $quest)
    {
        Gate::authorize('view', $naturePark);

        // Get the current pending part for this quest in the nature park
        $part = $naturePark->parts()
            ->where('quest_id', $quest->id)
            ->wherePivot('status', 'pending')
            ->orderBy('order_index')
            ->first();

        return view('groups.quest-show', compact('naturePark', 'quest', 'part'));
    }

    public function questPart(NaturePark $naturePark, Quest $quest, Part $part)
    {
        Gate::authorize('view', $naturePark);

        // check if the part belongs to the quest
        if ($part->quest_id !== $quest->id) {
            abort(404, 'Part does not belong to the specified quest.');
        }
        // check if the part is assigned to the nature park and is pending
        $part = $naturePark->parts()
            ->where('parts.id', $part->id)
            ->wherePivot('status', 'pending')
            ->first();
        if ($part == null) {
            abort('404');
        }
        return view('groups.quest-part', compact('naturePark', 'quest', 'part'));
    }

    public function goToNextPart(NaturePark $naturePark, Quest $quest, Part $part)
    {
        $naturePark->parts()->updateExistingPivot($part->id, ['status' => 'completed']);

        $newPart = Part::where('quest_id', $quest->id)
            ->where('id', '>', $part->id)
            ->orderBy('id')
            ->first();

        if ($newPart) {
            $naturePark->parts()->attach($newPart->id, ['status' => 'pending']);
        }

        if ($part->success_condition !== 'done' && !empty($newPart)) {
            return redirect()->route('nature.quests.parts', [
                'naturePark' => $naturePark->id,
                'quest' => $quest->id,
                'part' => $newPart->id,
            ]);
        } else {
            auth()->user()->update(['onboarding_completed' => true]);

            $naturePark->increment('state');

            return redirect()->route('home');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNatureParkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NaturePark $naturePark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NaturePark $naturePark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNatureParkRequest $request, NaturePark $naturePark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NaturePark $naturePark)
    {
        //
    }
}
