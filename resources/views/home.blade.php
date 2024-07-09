@extends('layouts.main')

@section('content')
    @include('partials.header')

    <section class="relative  bg-blueGray-50">
        <div class="relative pb-32 flex flex-col content-center items-center justify-center min-h-screen-75">
            <div class="relative w-[90%] mx-auto py-4 mb-4 justify-end gap-8 flex">
                @auth
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="text-white hover:underline">Logout</button>
                    </form>
                @else
                    <a href="/register" class="text-white hover:underline">Register</a>
                    <a href="/login" class="text-white hover:underline">Login</a>
                @endauth
            </div>
            <div class="absolute -z-10 top-0 w-full h-full bg-center bg-cover"
                style="
                background-image: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1267&amp;q=80');
              ">
                <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
            </div>
            <div class="container relative mx-auto">
                <div class="items-center flex flex-wrap">
                    <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                        <div class="pr-12">
                            <h1 class="text-white font-semibold text-5xl">
                                Tempat Makan Terbaik Anda
                            </h1>
                            <p class="mt-4 text-lg text-slate-200">
                                Website untuk menambahkan tempat restoran favorit Anda, dan membagikannya di media sosial
                                anda, berikan saran tempat makan siang terbaik versi Anda
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
                style="transform: translateZ(0px)">
                <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
                    version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                    <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <section class="pb-10 bg-blueGray-200 -mt-24">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap">
                    <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
                        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                            <div class="px-4 py-5 flex-auto">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-red-400">
                                    <i class="fas fa-award font-semibold">#1</i>
                                </div>
                                <h6 class="text-xl font-semibold">Informasi Lengkap dan Akurat</h6>
                                <p class="mt-2 mb-4 text-blueGray-500">
                                    Web kuliner kami menyediakan informasi lengkap dan akurat mengenai berbagai resep
                                    masakan, review restoran, dan tips kuliner terbaru. Dengan panduan langkah demi langkah
                                    dan ulasan mendetail, Anda dapat menemukan inspirasi dan panduan untuk setiap kesempatan
                                    kuliner.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-4/12 px-4 text-center">
                        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                            <div class="px-4 py-5 flex-auto">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-slate-600">
                                    <i class="fas fa-retweet">#2</i>
                                </div>
                                <h6 class="text-xl font-semibold">Konektivitas Komunitas Kuliner</h6>
                                <p class="mt-2 mb-4 text-blueGray-500">
                                    Selain menawarkan konten informatif, web kuliner kami juga membangun komunitas pecinta
                                    kuliner. Bergabunglah dengan forum diskusi, berbagi resep favorit Anda, dan ikuti acara
                                    kuliner lokal maupun nasional. Ini adalah tempat di mana para foodie bisa berbagi
                                    pengalaman dan pengetahuan mereka.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-6 w-full md:w-4/12 px-4 text-center">
                        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                            <div class="px-4 py-5 flex-auto">
                                <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-emerald-400">
                                    <i class="fas fa-fingerprint font-semibold">#3</i>
                                </div>
                                <h6 class="text-xl font-semibold">Kustomisasi dan Rekomendasi Pribadi</h6>
                                <p class="mt-2 mb-4 text-blueGray-500">
                                    Kami memahami bahwa setiap orang memiliki selera yang unik. Oleh karena itu, web kuliner
                                    kami dilengkapi dengan fitur kustomisasi dan rekomendasi pribadi. Buat profil kuliner
                                    Anda dan dapatkan saran resep, restoran, dan artikel berdasarkan preferensi dan riwayat
                                    pencarian Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
