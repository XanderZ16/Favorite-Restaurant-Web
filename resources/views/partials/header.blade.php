<!-- This is an example component -->
<div class="bg-grayDark">
    <!-- Navbar -->
    <div class="w-full text-gray-700 bg-white h-16 fixed top-0 z-40">
        <div x-data="{ open: false }"
            class="flex flex-col max-w-screen-xl px-2 mx-auto md:items-center md:justify-between md:flex-row">
            <div class="p-4 flex flex-row items-center justify-between">
                <a href="/" class="tracking-widest rounded-lg focus:outline-none focus:shadow-outline">
                    <svg class="w-8 h-8 text-purple-600" width="54" height="54" viewBox="0 0 54 54"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor"
                            d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z">
                        </path>
                    </svg>
                </a>
            </div>
            <!-- End Navbar Mobile -->
            <nav class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row bg-white">
                <a class="flex items-center px-3 py-1 mt-2 text-lg font-semibold text-primary rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                    href="/restaurants">
                    Restoran
                </a>
                <a class="flex items-center mr-4 px-3 py-1 mt-2 text-lg font-semibold text-primary rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                    href="/products">
                    Produk
                </a>
                @auth
                    <div @click.away="open = false" class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex flex-row gap-4 items-center w-full px-4 py-1 mt-2 font-semibold text-left bg-transparent rounded-full md:w-auto md:mt-0 md:ml-2 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                            <h3 class="text-lg">{{ auth()->user()->name }}</h3>
                            <img src="https://randomuser.me/api/portraits/men/12.jpg" class="w-auto h-6 rounded-full"
                                alt="" />
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                            <div class="px-2 py-2 bg-white rounded-md shadow">
                                @if (auth()->user()->is_admin)
                                    <a class="block px-4 py-2 mt-2  bg-transparent rounded-lg text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                        href="/dashboard">Dashboard</a>
                                @else
                                    <a class="block px-4 py-2 mt-2  bg-transparent rounded-lg text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                        href="/user/{{ auth()->user()->name }}">My profile</a>
                                    <a class="block px-4 py-2 mt-2  bg-transparent rounded-lg text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                        href="#">Favorite Restaurant</a>
                                    <a class="block px-4 py-2 mt-2  bg-transparent rounded-lg text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                        href="#">Liked Product</a>
                                @endif
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-start px-4 py-2 mt-2 bg-transparent rounded-lg text-sm font-semibold md:mt-0 text-red-500 hover:text-white hover:bg-red-500 focus:bg-red-600 focus:outline-none focus:shadow-outline">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a class="flex items-center mr-2 px-3 py-1 mt-2 text-lg font-semibold text-primary rounded-lg md:mt-0 border-2 text-indigo-500 border-indigo-500 hover:text-white hover:bg-indigo-500 focus:bg-indigo-600 focus:outline-none focus:shadow-outline"
                        href="/login">
                        Login
                    </a>
                    <a class="flex items-center px-3 py-1 mt-2 text-white text-lg font-semibold text-primary rounded-lg md:mt-0 bg-indigo-500 hover:bg-indigo-600 focus:bg-indigo-700 focus:outline-none focus:shadow-outline"
                        href="/register">
                        Register
                    </a>
                @endauth
            </nav>
        </div>
    </div>
</div>
