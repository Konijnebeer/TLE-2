<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use App\Models\Part;
use App\Http\Requests\StoreQuestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestController extends Controller
{
    public function index()
    {
        $quests = Quest::latest()->paginate(10);
        return view('admin.quests.index', compact('quests'));
    }

    public function create()
    {
        return view('admin.quests.create');
    }

    public function store(StoreQuestRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($validated, $request) {
                $quest = Quest::create([
                    'name' => $validated['name'],
                    'description' => $validated['description'],
                    'difficulty_level' => $validated['difficulty_level'],
                    'category' => $validated['category'],
                    'is_active' => $request->has('is_active'),
                ]);

                $createdParts = [];
                if (isset($validated['parts'])) {
                    foreach ($validated['parts'] as $index => $partData) {
                        $createdParts[] = $quest->parts()->create([
                            'order_index' => $index + 1,
                            'name' => $partData['name'],
                            'description' => $partData['description'],
                            'type' => $partData['type'] ?? 'text',
                            'options' => $partData['options'] ?? null,
                            'correct_answer' => $partData['correct_answer'] ?? null,
                            'success_condition' => $partData['success_condition'] ?? 'done',
                        ]);
                    }
                }

                $natureParks = \App\Models\NaturePark::all();
                foreach ($natureParks as $naturePark) {
                    foreach ($createdParts as $part) {
                        $naturePark->parts()->attach($part->id, ['status' => 'pending']);
                    }
                }
            });

            return redirect()->route('admin.quests.index')->with('success', 'Quest succesvol opgeslagen!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Fout bij opslaan: ' . $e->getMessage()]);
        }
    }

    public function edit(Quest $quest)
    {
        $quest->load('parts');
        return view('admin.quests.edit', compact('quest'));
    }

    public function update(Request $request, Quest $quest)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'difficulty_level' => 'required|integer|min:1|max:5',
            'category' => 'required|string',
            'parts' => 'required|array|min:1',
            'parts.*.name' => 'required|string',
            'parts.*.description' => 'required|string',
            'parts.*.success_condition' => 'required|string',
        ]);

        try {
            DB::transaction(function () use ($validated, $request, $quest) {
                // 1. Update de basisgegevens
                $quest->update([
                    'name' => $validated['name'],
                    'description' => $validated['description'],
                    'difficulty_level' => $validated['difficulty_level'],
                    'category' => $validated['category'],
                    'is_active' => $request->has('is_active'),
                ]);

                // 2. Verwijder de oude stappen
                $quest->parts()->delete();

                // 3. Maak de nieuwe stappen aan en koppel ze direct weer aan de parken
                $natureParks = \App\Models\NaturePark::all();

                foreach ($validated['parts'] as $index => $partData) {
                    $newPart = $quest->parts()->create([
                        'order_index' => $index + 1,
                        'name' => $partData['name'],
                        'description' => $partData['description'],
                        'type' => $partData['type'] ?? 'text',
                        'options' => $partData['options'] ?? null,
                        'correct_answer' => $partData['correct_answer'] ?? null,
                        'success_condition' => $partData['success_condition'],
                    ]);

                    // Koppel elk nieuw part weer aan alle parken op 'pending'
                    foreach ($natureParks as $park) {
                        $park->parts()->attach($newPart->id, ['status' => 'pending']);
                    }
                }
            });

            return redirect()->route('admin.quests.show', $quest)->with('success', 'Quest bijgewerkt en opnieuw gekoppeld aan alle parken!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Fout bij updaten: ' . $e->getMessage()]);
        }
    }

    public function show(Quest $quest)
    {
        $quest->load('parts');

        if (request()->is('admin/quests/*')) {
            return view('admin.quests.show', compact('quest'));
        }

        $firstPart = $quest->parts()->orderBy('order_index')->first();
        return view('quest.show', compact('quest', 'firstPart'));
    }

    public function destroy(Quest $quest)
    {
        $quest->delete();
        return redirect()->route('admin.quests.index')->with('success', 'Quest verwijderd.');
    }
}
