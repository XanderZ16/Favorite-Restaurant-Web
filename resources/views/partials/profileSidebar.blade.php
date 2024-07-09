<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<section class="col-span-4 sm:col-span-3">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex flex-col items-center">

            <label for="image"
                class="relative w-32 h-32 flex justify-center items-center bg-indigo-400 rounded-full mb-4 overflow-hidden hover:cursor-pointer">
                @if ($profile_photo)
                    <img src="/storage/{{ $profile_photo }}" class="w-full h-full object-cover">
                @else
                    <div class="text-white p-3 text-6xl text-center inline-flex items-center justify-center uppercase">
                        {{ $name[0] }}
                    </div>
                @endif
                <img id="preview" class="absolute top-0 left-0 w-full h-full object-cover z-10">
            </label>
            <input type="file" id="image" hidden>

            <h1 class="text-xl text-center font-semibold">{{ $full_name }}</h1>
            <h2>@ {{ $name }}</h2>
            <p class="text-gray-700"></p>
            <div class="mt-6 flex flex-wrap gap-4 justify-center">
                <a href="/user/{{ $name }}/edit"
                    class="bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 text-white py-2 px-4 rounded">Edit
                    Profile</a>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit"
                        class="hover:bg-red-500 focus:bg-red-600 text-red-500 hover:text-white py-2 px-4 rounded">Logout</button>
                </form>
            </div>
        </div>
        <hr class="my-4 border-t border-gray-300">
        <div class="flex flex-col">
            <h5 class="text-gray-700 uppercase font-bold tracking-wider mb-2">Opsi</h5>
            <ul>
                <li class="mb-2">
                    <a href="/user/{{ $name }}">Favorite Restaurants</a>
                </li>
                <li class="mb-2">
                    <a href="/user/{{ $name }}/liked">Liked Products</a>
                </li>
            </ul>
        </div>
        @if ($restaurants)
            <hr class="my-4 border-t border-gray-300">
            <h5 class="text-gray-700 uppercase font-bold tracking-wider mb-2">Restaurant list</h5>
            @foreach ($restaurants as $restaurant)
                <a href="/restaurants/{{ $restaurant->name }}" class="flex items-center gap-2 hover:underline mb-2">
                    <div class="size-10 rounded-full overflow-hidden">
                        <img src="/storage/{{ $restaurant->image }}" alt="Restaurant profile" class="w-full h-full">
                    </div>
                    {{ $restaurant->name }}
                </a>
            @endforeach
        @endif

        @if ($self)
            <hr class="my-4 border-t border-gray-300">
            <a href="/restaurants/create"
                class="inline-block w-full py-2 px-4 text-center bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 text-white rounded">Create
                your own restaurant</a>
        @endif
    </div>
</section>

<script src="/js/imgPreview.js"></script>
<script src="/js/changePP.js"></script>
