<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Dish;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::all();
        return view('welcome', compact('dishes'));

    }

    public function viewDishes()
    {
        $dishes = Dish::all();
        return view('dishes', compact('dishes'));
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

        $validated = $request->validate([
            'name' => 'required|min:5',
            'description' => 'required|unique:dishes,description|min:10|max:100',
            'price' => 'required|numeric|min:1|max:300',
            'category' => 'required'

        ], [
            'name.required' => 'Vul een naam in voor dit gerecht.',
            'name.min' => 'De naam voor dit gerecht moet minimaal 5 letters hebben',
            'description.max' => 'De beschrijving voor dit gerecht mag maximaal 100 tekens hebben.',
            'description.min' => 'De beschrijving voor dit gerecht moet minimaal 10 tekens hebben.',
            'description.required' => 'Vul een beschrijving in voor dit gerecht.',
            'description.unique' => 'Deze beschrijving bestaat al.',
            'price.required' => 'Vul een prijs in voor dit dagmenu.',
            'price.numeric' => 'Vul een geldig getal in voor dit dagmenu.',
            'price.min' => 'De prijs moet minimaal 1 euro zijn',
            'price.max' => 'De prijs mag maximaal 300 euro zijn',
            'category.required' => 'Vul een gang in voor dit gerecht.',


        ]);

        $dish = Dish::create($validated);

        $dishes = Dish::all();
        return view('dishes', compact('dishes'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dish = Dish::findOrFail($id);

        return view('edit', ['dish' => $dish]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'min:5',
            'description' => 'max:500',
            'price' => 'numeric|min:1|max:300',
            'category' => 'required',
        ], [
            'name.required' => 'Vul een naam in voor dit gerecht.',
            'name.min' => 'De naam voor dit gerecht moet minimaal 5 letters hebben',
            'description.max' => 'De beschrijving voor dit gerecht mag maximaal 100 tekens hebben.',
            'description.required' => 'Vul een beschrijving in voor dit gerecht.',
            'price.required' => 'Vul een prijs in voor dit gerecht.',
            'price.numeric' => 'Vul een getal in voor dit gerecht',
            'price.min' => 'De prijs moet minimaal 1 euro zijn',
            'price.max' => 'De prijs mag maximaal 300 euro zijn',
            'category.required' => 'Vul een gang in voor dit gerecht.',

        ]);

        $dish = Dish::findOrFail($id);
        $dish->update($request->all());

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $dish = Dish::findOrFail($request->dish_id);
        $dish->delete();

        return redirect()->route('gerechten');
    }

}
