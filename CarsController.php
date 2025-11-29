<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('welcome', compact('cars'));
    }

    public function viewCars()
    {
        $cars = Car::all();
        return view('cars', compact('cars'));
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
            'description' => 'required|unique:cars,description|min:10|max:100',
            'price' => 'required|numeric|min:1|max:300',
            'category' => 'required'
        ], [
            'name.required' => 'Vul een naam in voor deze auto.',
            'name.min' => 'De naam voor deze auto moet minimaal 5 letters hebben.',
            'description.max' => 'De beschrijving voor deze auto mag maximaal 100 tekens hebben.',
            'description.min' => 'De beschrijving voor deze auto moet minimaal 10 tekens hebben.',
            'description.required' => 'Vul een beschrijving in voor deze auto.',
            'description.unique' => 'Deze beschrijving bestaat al.',
            'price.required' => 'Vul een prijs in voor deze auto.',
            'price.numeric' => 'Vul een geldig getal in.',
            'price.min' => 'De prijs moet minimaal 1 euro zijn.',
            'price.max' => 'De prijs mag maximaal 300 euro zijn.',
            'category.required' => 'Vul een categorie in.',
        ]);

        Car::create($validated);

        $cars = Car::all();
        return view('cars', compact('cars'));
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
        $car = Car::findOrFail($id);

        return view('edit', ['car' => $car]);
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
            'name.required' => 'Vul een naam in voor deze auto.',
            'name.min' => 'De naam moet minimaal 5 letters hebben.',
            'description.max' => 'De beschrijving mag maximaal 500 tekens hebben.',
            'description.required' => 'Vul een beschrijving in.',
            'price.required' => 'Vul een prijs in.',
            'price.numeric' => 'Vul een getal in.',
            'price.min' => 'De prijs moet minimaal 1 euro zijn.',
            'price.max' => 'De prijs mag maximaal 300 euro zijn.',
            'category.required' => 'Vul een categorie in.',
        ]);

        $car = Car::findOrFail($id);
        $car->update($request->all());

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $car = Car::findOrFail($request->car_id);
        $car->delete();

        return redirect()->route('cars');
    }
}
