<?php

namespace App\Http\Controllers;

use Gate;
use App\Models\Quest;
use App\Http\Requests\StoreQuestRequest;
use App\Http\Requests\UpdateQuestRequest;
use function Laravel\Prompts\error;


class QuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quests = Quest::latest()->get();
        return view('quest.index', compact('quests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quest.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestRequest $request)
    {


        $validated = $request->validated();

        $quest = Quest::create($validated);


        $quest->save();


        return redirect()->route('quests.index', ['quest' => $quest->id])
            ->with('success', 'Quest created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Quest $quest)
    {
        $firstPart = $quest->parts()->orderBy('order_index')->first();

        return view('quest.show', compact('quest', 'firstPart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quest $quest)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestRequest $request, Quest $quest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quest $quest)
    {
        //
    }

    /**
     * Change activity of quest
     */
    public function changeQuestActivity(Quest $quest)
    {
        $quest->is_active = $quest->is_active ? 0 : 1;
        $quest->save();

        return redirect()->route('quests.index', ['quest' => $quest->id])
            ->with('success', 'Quest created successfully!');

    }
}
