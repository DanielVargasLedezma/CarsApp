@extends('layouts.app')

@section('content')

    <div class="py-10 text-center">
        @if ($car)
            <div class="text-center">
                <ul class="inline">
                    <li class="list-none">
                        @if (is_null($car->image_path) === false)
                            <img 
                                src="{{ asset('images/' . $car->image_path) }}" 
                                class="w-12/8 mb-8 shadow-xl"
                                alt="{{ $car->name }}">
                        @endif
                    </li>
                    <li class="list-none">
                        <h1 class="text-5xl uppercase bold">
                            {{ $car->name }}
                        </h1>
                    </li>
                </ul>
            </div>

            <div class="m-auto">
                
                <span class="uppercase text-blue-500 font-bold text-xs italic">
                    Founded: {{ $car->founded }}
                </span>
                <p class="text-lg text-gray-700 py-6">
                    {{ $car->description }}
                </p>
                @if ($car->carModels)     
                    <table class="table-auto m-auto">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="w-1/4 border-4 border-gray-500">
                                    Model
                                </th>
                                
                                <th class="w-1/4 border-4 border-gray-500">
                                    Engines
                                </th>

                                <th class="w-1/4 border-4 border-gray-500">
                                    Date Created
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($car->carModels as $model)
                                <tr>
                                    <td class="border-4 border-gray-500">
                                        {{ $model->model_name }}
                                    </td>

                                    <td class="border-4 border-gray-500">
                                        @foreach ($car->engines as $engine)
                                            @if ($model->id == $engine->model_id)
                                                {{ $engine->engine_name }}
                                            @endif
                                        @endforeach
                                    </td>

                                    <td class="border-4 border-gray-500">
                                        {{ date('d-m-Y', strtotime($car->productionDate->created_at)) }}
                                    </td>
                                </tr>
                            @empty
                                <p>
                                    No cars models found
                                </p>
                            @endforelse
                        </tbody>
                    </table>

                    <p class="text-center">
                        Product types:
                        @forelse ($car->products as $product)
                            {{ $product->name }}
                        @empty
                            <p>
                                No cars products
                            </p>
                        @endforelse
                    </p>
                @else
                    <div class="m-auto">
                        <h2 class="text-gay-700 text-5xl">
                            There's no models for this car...
                        </h2>
                    </div>
                @endif

            </div>

        @else
            <div class="m-auto">
                <h2 class="text-gay-700 text-5xl">
                    There's no such car in database...
                </h2>

            </div>
        @endif

        <hr class="mt-4 mb-8">

    </div>
@endsection