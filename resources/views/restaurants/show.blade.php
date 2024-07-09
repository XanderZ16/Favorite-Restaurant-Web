@extends('layouts.main')

@section('title', 'FavRes | ' . $restaurant->name)

@section('content')
    @include('partials.header')

    <div class="min-h-screen">
        <section class="bg-blueGray-50 h-[70vh]">
            <div class="relative flex flex-col content-center items-center justify-center h-full">
                <div class="absolute h-full -z-10 top-0 w-full bg-center bg-cover"
                    style="background-image: url('/storage/{{ $restaurant->image }}');">
                    <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
                </div>
                <div class="container relative mx-auto">
                    <div class="items-center flex flex-wrap">
                        <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                            <div class="pr-12">
                                <h1 class="text-white font-semibold text-5xl">
                                    {{ $restaurant->name }}
                                </h1>
                                <p class="mt-4 text-lg text-slate-200">
                                    {{ $restaurant->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if ($restaurant->products->count() >= 3)
            <section class="pb-6 bg-blueGray-200 -mt-12">
                <div class="container mx-auto px-4">
                    <div class="flex flex-wrap">
                        <div class="pt-6 w-full md:w-4/12 px-4 text-center">
                            <div
                                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                                <div class="px-4 py-5 flex-auto">
                                    <div class="flex gap-2 items-center mb-4">
                                        <div
                                            class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-400">
                                            <i class="fas fa-award font-semibold">#1</i>
                                        </div>
                                        <h3 class="text-xl font-semibold">{{ $threeTopProducts[0]->name }}</h3>
                                    </div>
                                    <div class="rounded-lg overflow-hidden">
                                        <img src="/storage/{{ $threeTopProducts[0]->image }}" alt="Top 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-4/12 px-4 text-center">
                            <div
                                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                                <div class="px-4 py-5 flex-auto">
                                    <div class="flex gap-2 items-center mb-4">
                                        <div
                                            class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-400">
                                            <i class="fas fa-award font-semibold">#2</i>
                                        </div>
                                        <h3 class="text-xl font-semibold">{{ $threeTopProducts[1]->name }}</h3>
                                    </div>
                                    <div class="rounded-lg overflow-hidden">
                                        <img src="/storage/{{ $threeTopProducts[1]->image }}" alt="Top 2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-6 w-full md:w-4/12 px-4 text-center">
                            <div
                                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                                <div class="px-4 py-5 flex-auto">
                                    <div class="flex gap-2 items-center mb-4">
                                        <div
                                            class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-400">
                                            <i class="fas fa-award font-semibold">#3</i>
                                        </div>
                                        <h3 class="text-xl font-semibold">{{ $threeTopProducts[2]->name }}</h3>
                                    </div>
                                    <div class="rounded-lg overflow-hidden">
                                        <img src="/storage/{{ $threeTopProducts[2]->image }}" alt="Top 3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section>
            <div class="flex flex-col min-w-0 break-words bg-white pb-6 w-full mb-6 shadow-xl rounded-lg">
                <div class="px-6">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full lg:w-3/12 px-4 lg:order-2 flex gap-4 items-center">
                            <img src="/storage/{{ $restaurant->image }}"
                                class="shadow-xl aspect-square size-20 overflow-hidden rounded-full object-cover">
                            <h1 class="text-xl font-semibold whitespace-nowrap">{{ $restaurant->name }}</h1>
                        </div>
                        <div class="w-full flex justify-end lg:w-4/12 px-4 lg:order-4 lg:text-right lg:self-center">
                            @if ($mine)
                                <div class="flex gap-6 *:text-lg">
                                    <a href="/restaurants/{{ $restaurant->name }}/products/create"
                                        class="text-indigo-500 hover:text-indigo-600">
                                        Tambah produk
                                    </a>
                                    <a href="/restaurants/{{ $restaurant->name }}/edit" class="text-yellow-500">
                                        Edit
                                    </a>
                                    <form action="/restaurants/{{ $restaurant->name }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @else
                                <form action="/restaurants/{{ $restaurant->name }}/favorite" method="post"
                                    id="toggle_favorite">
                                    @csrf
                                    <button
                                        class="bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700 uppercase text-white font-bold shadow text-xs px-4 py-2 rounded outline-none ease-linear transition-all duration-150"
                                        type="submit">
                                        <span id="favorite"
                                            class="{{ auth()->user()->hasFavored($restaurant) ? 'hidden' : '' }}">Tambah ke
                                            favorit</span>
                                        <span id="unfavorite"
                                            class="{{ auth()->user()->hasFavored($restaurant) ? '' : 'hidden' }}">Hapus
                                            dari
                                            favorit</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                        <div class="w-full lg:w-4/12 px-4 lg:order-1">
                            <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                <div class="mr-4 p-3 text-center">
                                    <p>
                                        <span
                                            class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                            @if ($restaurant->products_count() == 0)
                                                0
                                            @else
                                                {{ $restaurant->products_count() }}
                                            @endif
                                        </span>
                                        Produk
                                    </p>
                                </div>
                                <div class="mr-4 p-3 text-center">
                                    <p>
                                        <span id="favorite_count"
                                            class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                            @if ($restaurant->favorites_count() == 0)
                                                0
                                            @else
                                                {{ $restaurant->favorites_count() }}
                                            @endif
                                        </span>
                                        Favorite
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="border-gray-600 my-1">
                    <div class="flex flex-col items-center text-center mt-4">
                        <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400">
                            {{ $restaurant->address }}
                        </div>
                        <h4 class="text-2xl font-semibold mb-2">Kontak kami</h4>
                        <a href="mailto:{{ $restaurant->email }}"
                            class="block w-fit mb-2 text-blueGray-600 hover:underline">
                            {{ $restaurant->email }}
                        </a>
                        <a href="tel:{{ $restaurant->phone }}" class="block w-fit text-blueGray-600 hover:underline">
                            {{ $restaurant->phone }}
                        </a>
                    </div>
                    <hr class="border-gray-600 my-6">
                    <div>
                        <h3 class="text-3xl text-center font-semibold">Produk Kami</h3>
                    </div>
                </div>
            </div>
        </section>

        <section class="pb-10 lg:pb-20">
            <div class="container">
                <div class="flex flex-wrap">
                    @foreach ($products as $product)
                        <div class="product w-full md:w-1/3 xl:w-1/4 px-4">
                            <div class="bg-white border rounded-lg shadow-md overflow-hidden mb-10">
                                <img src="/storage/{{ $product->image }}" alt="image" class="w-full" />
                                <div class="p-2">
                                    <div class="flex justify-between">
                                        <div class="flex gap-2">
                                            <form id="toggle_like" action="/products/{{ $product->id }}/like"
                                                method="POST">
                                                @csrf
                                                <button type="submit">
                                                    <svg id="like" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 512 512"
                                                        class="size-6 {{ auth()->user()->hasLiked($product) ? 'hidden' : '' }}">
                                                        <path
                                                            d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                                                    </svg>
                                                    <svg id="unlike" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 512 512"
                                                        class="size-6 fill-red-500 {{ auth()->user()->hasLiked($product) ? '' : 'hidden' }}">
                                                        <path
                                                            d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <p>
                                                <span id="like_count">{{ $product->likes_count() }}</span> like
                                            </p>
                                        </div>
                                        <h5 class="font-semibold">Rp. <span
                                                class="font-normal">{{ $product->price }}</span></h5>
                                    </div>
                                    <h3
                                        class="font-semibold text-dark text-xl sm:text-[22px] md:text-xl lg:text-[22px] xl:text-xl 2xl:text-[22px] mb-2 block hover:text-primary">
                                        {{ $product->name }}
                                    </h3>
                                    <a href="/products/{{ $product->id }}"
                                        class="block py-2 px-7 rounded-full text-base text-center font-medium hover:border-primary hover:bg-indigo-500 text-indigo-500 hover:text-white transition">
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

    <script src="/js/favorite.js"></script>
    <script src="/js/like.js"></script>

@endsection
