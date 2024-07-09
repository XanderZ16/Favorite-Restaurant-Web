@extends('layouts.main')

@section('title', 'FavRes | Restaurants')

@section('content')
    @include('partials.header')

    <div class="bg-gray-100 pt-16 min-h-screen">
        <section class="py-4">
            <div class="container">
                <div class="flex flex-wrap">

                    @foreach ($restaurants as $restaurant)
                        <div class="w-full md:w-1/3 xl:w-1/4 px-4">
                            <div class="bg-white rounded-lg overflow-hidden mb-10">
                                <img src="/storage/{{ $restaurant->image }}"
                                    alt="image" class="w-full" />
                                <div class="p-4 text-center">
                                    <h3 class="font-semibold text-dark text-xl sm:text-[22px] md:text-xl lg:text-[22px] xl:text-xl 2xl:text-[22px] mb-2 block hover:text-primary">
                                        {{ $restaurant->name }}
                                    </h3>
                                    <p class="text-base text-body-color leading-relaxed mb-4">
                                        {{ $restaurant->description }}
                                    </p>
                                    <a href="/restaurants/{{ $restaurant->name }}"
                                        class="inline-block py-2 px-7 rounded-full text-base font-medium hover:border-primary hover:bg-indigo-500 text-indigo-500 hover:text-white transition">
                                        Lihat selengkapmya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    </div>
@endsection
