@extends('layouts.main')

@section('title', 'FavRes | Add Article')

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
            <form action="/articles" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex items-stretch gap-8">
                    <div class="w-2/5">
                        <div>
                            <label for="image"
                                class="block rounded-xl bg-slate-200 border border-black overflow-hidden hover:cursor-pointer">
                                <div id="null-label" class="py-6 flex flex-col justify-center items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="size-24">
                                        <path
                                            d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z" />
                                    </svg>
                                    <p class="text-center text-lg font-semibold">Pilih Gambar</p>
                                    <p class="text-center text-sm">Unggah foto restoran Anda</p>
                                </div>
                                <div id="preview-label" class="hidden h-full w-full">
                                    <img id="preview" class="w-full h-full object-contain" alt="Image preview">
                                </div>
                            </label>
                            <input type="file" name="image" id="image" accept="image/*" hidden>
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
                                value="{{ old('title') }}"
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
                            <input id="content" type="hidden" name="content" value="{{ old('content') }}">
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
                            <button type="submit" class="text-basic transition text-white bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700">Unggah</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="/js/imgPreview.js"></script>
    <script src="/js/createForm.js"></script>

@endsection
