@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center ">
            <h1 class="text-5xl uppercase bold">
                Create a car
            </h1>
        </div>
    </div>

    <div class="flex justify-center pt-20">
        <form action="/cars" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="block">

                <label for="name"> Name </label>
                <input type="text" class="block shadow-5xl mb-5 p-2 w-80 italic placeholder-gray-400" name="name"
                placeholder="Brand name...">

                <label for="founded"> Founded </label>
                <input type="text" class="block shadow-5xl mb-5 p-2 w-80 italic placeholder-gray-400" name="founded"
                placeholder="Year founded...">

                <label for="description"> Description </label>
                <textarea type="text" class="block shadow-5xl mb-5 p-2 w-80 italic placeholder-gray-400" name="description"
                placeholder="Description..."></textarea>
                
                <label for="image"> Image </label>
                <input type="file" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400" name="image">

                <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">
                    Submit
                </button>
            </div>
        </form>
    </div>
    @if ($errors->any())
        <div class="w-4/8 m-auto text-center">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-500 list-none">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection