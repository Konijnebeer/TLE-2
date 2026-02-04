<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\Quest;
//use App\Http\Requests\StoreQuestRequest;
//use App\Http\Requests\UpdateQuestRequest;
//
//class QuestController extends Controller
//{
//    /**
//     * Display a listing of the resource.
//     */
//    public function index()
//    {
//        return view('quest.index');
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     */
//    public function store(StoreQuestRequest $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     */
//    public function show(Quest $quest)
//    {
//        $firstPart = $quest->parts()->orderBy('order_index')->first();
//
//        return view('quest.show', compact('quest', 'firstPart'));
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit(Quest $quest)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(UpdateQuestRequest $request, Quest $quest)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(Quest $quest)
//    {
//        //
//    }
//}


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
        // De data ophalen die voldoet aan de regels in StoreQuestRequest
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($validated, $request) {
                // Maak de Quest aan
                $quest = Quest::create([
                    'name' => $validated['name'],
                    'description' => $validated['description'],
                    'difficulty_level' => $validated['difficulty_level'],
                    'category' => $validated['category'],
                    'is_active' => $request->has('is_active'),
                ]);

                // Voeg de onderdelen toe
                foreach ($validated['parts'] as $index => $partData) {
                    $quest->parts()->create([
                        'order_index' => $index + 1,
                        'name' => $partData['name'],
                        'description' => $partData['description'],
                        'success_condition' => $partData['success_condition'],
                    ]);
                }
            });

            return redirect()->route('admin.quests.index')->with('success', 'Quest succesvol opgeslagen!');
        } catch (\Exception $e) {
            // Dit vangt de "Undefined array key" fout op als er iets misgaat
            dd('Fout bij opslaan:', $e->getMessage());
        }
    }

    // Code van teamgenoot behouden
    public function show(Quest $quest)
    {
        $firstPart = $quest->parts()->orderBy('order_index')->first();
        return view('quest.show', compact('quest', 'firstPart'));
    }
}
