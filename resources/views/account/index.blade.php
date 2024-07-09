@extends('layouts.main')

@section('title', 'FavRes | Account')

@section('content')
    @include('partials.header')

    <div class="min-h-screen bg-gray-100 pt-20 pb-4">
        <div class="container mx-auto">
            <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                @include('partials.profileSidebar')

                <div class="col-span-4 sm:col-span-9">
                    <div class="flex flex-col h-full bg-white rounded-lg">
                        <div class="relative flex justify-center items-center">
                            <h1 class="text-center text-4xl font-bold py-2">Article</h1>
                            @if ($self && $article)
                                <a href="/articles/{{ $article->id }}/edit" class="absolute right-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-6 fill-yellow-500">
                                        <path
                                            d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                        <hr class="border-gray-400">
                        @if ($article)
                            <div class="px-6 py-3 w-full mx-auto">
                                <p class="mb-2">By <span>{{ $article->user->full_name }}</span></p>
                                <h1 class="text-3xl font-semibold mb-4">{{ $article->title }}</h1>
                                <p class="text-gray-700 mb-4 !text-3xl">
                                    <img src="/storage/{{ $article->image }}" alt="Article Image"
                                        class="float-left mr-6 w-1/3 rounded-md">
                                    {!! $article->content !!}
                                </p>
                            </div>
                        @else
                            <div class="flex-grow flex flex-col justify-center items-center">
                                <p>Anda belum membuat artikel</p>
                                <a href="/articles/create"
                                    class="inline-block mt-4 py-2 px-4 text-center bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 text-white rounded">Buat
                                    Article</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
