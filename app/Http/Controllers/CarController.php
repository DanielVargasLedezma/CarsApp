<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Requests\CreateValidationRequest;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all()->toJson();

        $cars = json_decode($cars);
        // dd($cars);

        return view('cars.index', [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateValidationRequest $request)
    {
        // $car = new Car;

        // $car->name = $request->input('name');
        // $car->founded = $request->input('founded');
        // $car->description = $request->input('description');

        // $car->save();

        // $request->validate([
        //     'name' => 'required|unique:cars',
        //     'founded' => 'required|integer|min:0|max:2021',
        //     'description' => 'required'
        // ]);

        /*
        Methods that can be used on $request->file('image')->
        guessExtension()
        getMimeType()
        store()
        asStore()
        storePublicly()
        move()
        getClientOriginalName()
        getClientMimeType()
        guessClienteExtension()
        getSize()
        getError()
        isValid()
        */
        
        $request->validated();

        $newImageName = time() . '-' . $request->name . '-' . $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        Car::create([
            'name' => $request->input('name'),
            'founded' => $request->input('founded'),
            'description' => $request->input('description'),
            'image_path' => $newImageName
        ]);

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);

        return view('cars.show')->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::first()->find($id);
        return view('cars.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateValidationRequest $request, $id)
    {
        $request->validated();

        Car::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'founded' => $request->input('founded'),
                'description' => $request->input('description')
        ]);

        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Car::first()
            ->find($id)
            ->delete();

        return redirect('/cars');
    }
}
