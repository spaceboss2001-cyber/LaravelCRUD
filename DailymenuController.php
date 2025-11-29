<?php

namespace App\Http\Controllers;
use App\Models\Dailymenu;
use App\Models\Dish;
use Illuminate\Http\Request;


class DailymenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dailymenus = Dailymenu::with('dishes')->get();
        $dishes = Dish::all();
        return view('dailymenus', compact('dailymenus', 'dishes'));
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
    public function store(Request $request)
    {
        $request->merge([
            'price' => str_replace(',', '.', $request->price)
        ]);

        $validated = $request->validate([
            'name' => 'required|unique:dailymenus,name|min:5',
            'description' => 'required|min:10|max:400',
            'price' => 'required|numeric|min:1|max:300',
            'date' => 'required|date|unique:dailymenus,date|after_or_equal:today',
            'dishes.*.category' => 'nullable|in:appetizer,main,dessert',
        ], [
            'name.required' => 'Vul een naam in voor dit dagmenu.',
            'name.unique' => 'Dit menu bestaat al.',
            'name.min' => 'De naam voor dit dagmenu moet minimaal 5 letters hebben.',
            'description.required' => 'Vul een beschrijving in voor dit dagmenu.',
            'description.min' => 'De beschrijving moet minimaal 10 tekens bevatten.',
            'description.max' => 'De beschrijving mag maximaal 400 tekens bevatten.',
            'price.required' => 'Vul een prijs in voor dit dagmenu.',
            'price.numeric' => 'Vul een geldig getal in voor dit dagmenu.',
            'price.min' => 'De prijs moet minimaal 1 euro zijn.',
            'price.max' => 'De prijs mag maximaal 300 euro zijn.',
            'date.required' => 'Vul een datum in voor dit dagmenu.',
            'date.unique' => 'Er is al een dagmenu voor deze datum, dag is al reeds bezet',
            'date.date' => 'Vul een geldige datum in.',
            'date.after_or_equal' => 'De datum mag niet in het verleden liggen.',
            'dishes.*.category.in' => 'Selecteer een geldige categorie voor elk gerecht.',
        ]);

        $dailymenu = Dailymenu::create($validated);

        if ($request->has('dishes')) {
            foreach ($request->dishes as $dishId => $dishData) {
                if (isset($dishData['selected']) && !empty($dishData['category'])) {
                    $dailymenu->dishes()->attach($dishId, [
                        'category' => $dishData['category']
                    ]);
                }
            }
        }

        return redirect()->route('dailymenus.index')->with('success', 'Dagmenu succesvol toegevoegd!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $dailymenus = Dailymenu::with('dishes')->get();
        $dishes = Dish::all();

        $dailymenu = null;
        if ($request->has('dailymenu')) {
            $dailymenu = Dailymenu::with('dishes')->find($request->dailymenu);
        }

        return view('dailymenus', compact('dailymenus', 'dailymenu', 'dishes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dailymenu $dailymenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dailymenu $dailymenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $dailymenu = Dailymenu::findOrFail($request->dailymenu_id);
        if ($dailymenu) {
            $dailymenu->dishes()->detach();
            $dailymenu->delete();

            return redirect()->route('dailymenus.index')->with('success', 'Dagmenu succesvol verwijderd!');

        }


        return redirect()->route('dailymenus.index')->with('error', 'Dagmenu niet gevonden.');
    }
}
