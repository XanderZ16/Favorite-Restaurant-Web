@extends('layouts.main')

@section('title', 'FavRes | Edit Article')

@section('content')
    <head>
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

        <style>
            [data-trix-button-group="file-tools"] {
                display: none !important;
            }
        </style>
    </head>

    @include('partials.header')

    <div class="max-w-screen-2xl min-h-screen bg-gray-100 pt-16">
        <div class="w-[95%] max-w-screen-xl mt-6 mx-auto rounded-xl p-6 bg-white">
            <form action="/articles/{{ $article->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex items-stretch gap-8">
                    <div class="w-2/5">
                        <div>
                            <label for="image"
                                class="block rounded-xl bg-slate-200 border border-black overflow-hidden hover:cursor-pointer">
                                <div id="preview-label" class="h-full w-full">
                                    <img id="preview" src="/storage/{{ $article->image }}" class="w-full h-full object-contain" alt="Image preview">
                                </div>
                            </label>
                            <input type="file" name="image" id="image" hidden>
                            @error('image')
                                <p class="flex items-center gap-2 text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-4 fill-red-500">
                                        <path
                                            d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="title"
                                class="block font-semibold text-lg px-2 py-1 w-fit rounded-t-xl @error('title') text-red-500 @enderror">Judul artikel</label>
                            <input type="text" placeholder="Masukkan judul artikel" id="title" name="title"
                                value="{{ old('title', $article->title) }}"
                                class="w-full pl-2 py-1 rounded-xl rounded-tl-none text-md text-black border-2">
                            @error('title')
                                <p class="flex items-center gap-2 text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-4 fill-red-500">
                                        <path
                                            d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="w-3/5 flex flex-col">
                        <div class="mb-3">
                            <input id="content" type="hidden" name="content" value="{{ old('content', $article->content) }}">
                            <trix-editor input="content"></trix-editor>
                            @error('content')
                                <p class="flex items-center gap-2 text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-4 fill-red-500">
                                        <path
                                            d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div
                            class="flex-grow flex items-end mt-4 gap-4 justify-around text-xl *:w-1/2 *:font-semibold *:text-center *:rounded-lg *:border-2 *:py-2">
                            <a href="/" class="hover:text-basic transition">Batal</a>
                            <button type="submit" class="text-basic transition text-white bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="/js/imgPreview.js"></script>
    <script src="/js/createForm.js"></script>

@endsection
