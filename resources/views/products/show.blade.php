@extends('layouts.main')

@section('title', 'FavRes | ' . $product->name)

@section('content')
    @include('partials.header')

    <div class="bg-gray-100 min-h-screen pt-20 pb-4">
        <div class="max-w-screen-md flex flex-wrap mx-auto">
            <div class="w-3/4 bg-white rounded-lg shadow-md border overflow-hidden">
                <div class="w-full relative">
                    <img src="/storage/{{ $product->image }}" alt="image" />
                    <a href="/restaurants/{{ $product->restaurant->name }}" class="absolute top-0 left-0 backdrop-blur-lg rounded-lg">
                        <h1 class="text-3xl font-bold text-white p-2">{{ $product->restaurant->name }}</h1>
                    </a>
                    @if ($mine)
                        <div class="absolute top-0 right-0 flex *:text-white">
                            <a href="/products/{{ $product->id }}/edit">
                                <button
                                    class="block px-4 py-1 rounded-bl-lg bg-yellow-500 hover:bg-yellow-600 active:bg-yellow-700">Edit</button>
                            </a>
                            <form action="/products/{{ $product->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                    class="px-4 py-1 bg-red-500 hover:bg-red-600 active:bg-red-700">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="p-2">
                    <div class="flex justify-between">
                        <div class="flex gap-2">
                            <form id="toggle_like" action="/products/{{ $product->id }}/like" method="POST">
                                @csrf
                                <button type="submit">
                                    <svg id="like" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        class="size-6 {{ auth()->user()->hasLiked($product) ? 'hidden' : '' }}">
                                        <path
                                            d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                                    </svg>
                                    <svg id="unlike" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
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
                        <h5 class="font-semibold">Rp. <span class="font-normal">{{ $product->price }}</span></h5>
                    </div>
                    <h3
                        class="font-semibold text-dark text-xl sm:text-[22px] md:text-xl lg:text-[22px] xl:text-xl 2xl:text-[22px] mb-2 block hover:text-primary">
                        {{ $product->name }}
                    </h3>
                    <p class="text-base leading-relaxed mb-4">
                        {{ $product->description }}
                    </p>
                    <form action="/products/{{ $product->id }}/comment" method="post">
                        @csrf
                        <div class="relative flex items-center">
                            <input type="text" name="comment" id="comment" placeholder="Tambah komentar"
                                value="{{ old('comment') }}" class="w-full py-1 px-4 border border-black rounded-full">

                            <button type="submit" class="group absolute right-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-5 group-hover:hidden">
                                    <path
                                        d="M16.1 260.2c-22.6 12.9-20.5 47.3 3.6 57.3L160 376V479.3c0 18.1 14.6 32.7 32.7 32.7c9.7 0 18.9-4.3 25.1-11.8l62-74.3 123.9 51.6c18.9 7.9 40.8-4.5 43.9-24.7l64-416c1.9-12.1-3.4-24.3-13.5-31.2s-23.3-7.5-34-1.4l-448 256zm52.1 25.5L409.7 90.6 190.1 336l1.2 1L68.2 285.7zM403.3 425.4L236.7 355.9 450.8 116.6 403.3 425.4z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="hidden size-5 group-hover:block">
                                    <path
                                        d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="w-1/4 pl-4">
                <div class="rounded-lg shadow-md border overflow-hidden">
                    <img src="/storage/{{ $product->image }}" alt="image" class="w-full" />
                </div>
            </div>

            <div class="w-3/4 bg-white rounded-lg mt-2 px-2">
                @if ($comments)
                    @foreach ($comments as $comment)
                        <div class="w-full flex items-center gap-2">
                            <div class="size-10 rounded-full overflow-hidden">
                                <img src="/storage/{{ $comment->user->profile_photo }}" alt="image" class="w-full" />
                            </div>
                            <div class="w-3/4">
                                <h3 class="font-semibold">{{ $comment->user->name }}</h3>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex justify-center items-center h-32">
                        No Comment
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="/js/singleLike.js"></script>

@endsection
