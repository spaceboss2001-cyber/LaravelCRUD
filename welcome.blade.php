@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <div class="h-screen w-full">
        <div class="container px-14 py-8 ">
            <div class=" grid grid-cols-12 gap-4 ">
                <div class="col-span-12 lg:col-span-4 col-start-1 bg-amber-100 p-10 border rounded-2xl ">
                    <div class="flex justify-center">
                        <h1 class="font-bold mx-auto text-xl md:text-xl lg:text-2xl"> Voorgerechten </h1>
                    </div>
                    <div class="my-2 ">
                        @foreach ($dishes as $dish)
                            @if ($dish->category === 'appetizer')
                                <div class=" ">
                                    <p class="text-md md:text-lg mb-2"> <strong>{{ $dish->name }}</strong>
                                        €{{ $dish->price }} <br>
                                        {{ $dish->description }}
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4 col-start-1 lg:col-start-5 bg-amber-100 p-10 border rounded-2xl ">
                    <div class="flex justify-center">
                        <h1 class="font-bold mx-auto text-xl md:text-xl lg:text-2xl"> Hoofdgerechten </h1>
                    </div>
                    <div class="my-2 ">
                        @foreach ($dishes as $dish)
                            @if ($dish->category === 'main')
                                <div class=" ">
                                    <p class="text-md md:text-lg mb-2"> <strong>{{ $dish->name }}</strong> €{{ $dish->price }} <br>
                                        {{ $dish->description }}
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4 col-start-1 lg:col-start-9 bg-amber-100 p-10 border rounded-2xl ">
                    <div class="flex justify-center">
                        <h1 class="font-bold mx-auto text-xl md:text-xl lg:text-2xl"> Nagerechten </h1>
                    </div>
                    <div class="my-2 ">
                        @foreach ($dishes as $dish)
                            @if ($dish->category === 'dessert')
                                <div class=" ">
                                    <p class="text-md md:text-lg mb-2"> <strong>{{ $dish->name }}</strong> €{{ $dish->price }} <br>
                                        {{ $dish->description }}
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    </div>


                </div>
            </div>
        </div>


    @endsection
