@extends('layouts.main')

@section('title', 'Matrix Operations')

@section('content')
    {{-- @include('partials.header') --}}

    <!DOCTYPE html>
    <html lang="en">

    <div class="py-4 bg-[#ffc0cb] min-h-screen flex justify-center">
        <div class="w-[95%] max-w-screen-lg flex gap-4">
            <div class="w-1/4 p-6 bg-white rounded">
                <h1 class="text-2xl font-bold">Kelompok MTK</h1>
                <hr class="border-black my-3">
                <h6 class="font-semibold mb-2">Anggota Kelompok :</h6>
                <ul class="flex flex-col gap-1">
                    <li>Alfredo Alexander Mendez</li>
                    <li>Siti Annisa</li>
                    <li>Moh Hafiz kurniawan</li>
                    <li>M Vabian Handaka</li>
                    <li>Fitri Rahmadani</li>
                    <li>Wilson Anderson</li>
                </ul>
            </div>
            <div class="w-3/4 bg-white p-6 rounded">
                <h1 class="text-2xl font-bold">Matriks Kalkulator</h1>
                <hr class="border-black my-3">
                <form id="matrix-form" class="mb-6">
                    <div class="flex gap-4">
                        <div class="mb-4">
                            <label for="matrix1-rows" class="block mb-2">Jumlah baris : Matrix 1</label>
                            <input type="number" id="matrix1-rows" class="border border-black rounded px-2 py-1 mb-4 w-full">
                        </div>
                        <div class="mb-4">
                            <label for="matrix1-cols" class="block mb-2">Jumlah kolom : Matrix 1</label>
                            <input type="number" id="matrix1-cols" class="border border-black rounded px-2 py-1 mb-4 w-full">
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="mb-4">
                            <label for="matrix2-rows" class="block mb-2">Jumlah baris : Matrix 2</label>
                            <input type="number" id="matrix2-rows" class="border border-black rounded px-2 py-1 mb-4 w-full">
                        </div>
                        <div class="mb-4">
                            <label for="matrix2-cols" class="block mb-2">Jumlah kolom : Matrix 2</label>
                            <input type="number" id="matrix2-cols" class="border border-black rounded px-2 py-1 mb-4 w-full">
                        </div>
                    </div>
                    <button type="button" id="generate-matrices" class="bg-[#E75480] hover:bg-[#cc4970] text-white px-4 py-2 rounded mb-6">Buat Matriks</button>
                    <div id="matrices-container" class="flex gap-6"></div>
                    <div class="mb-4">
                        <label class="block font-semibold text-lg mb-2">Operasi</label>
                        <div class="flex gap-4">
                            <label class="hover:underline"><input type="radio" name="operation" value="add" class="mr-2"> Penjumlahan</label>
                            <label class="hover:underline"><input type="radio" name="operation" value="subtract" class="mr-2 ml-4"> Pengurangan</label>
                            <label class="hover:underline"><input type="radio" name="operation" value="multiply" class="mr-2 ml-4"> Perkalian</label>
                        </div>
                        <div class="flex gap-4">
                            <label class="hover:underline"><input type="radio" name="operation" value="transpose1" class="mr-2"> Transpose Matriks
                                1</label>
                            <label class="hover:underline"><input type="radio" name="operation" value="transpose2" class="mr-2"> Transpose Matriks
                                2</label>
                        </div>
                        <div class="flex gap-4">
                            <label class="hover:underline"><input type="radio" name="operation" value="determinant1" class="mr-2"> Determinan Matriks
                                1</label>
                            <label class="hover:underline"><input type="radio" name="operation" value="determinant2" class="mr-2"> Determinan Matriks
                                2</label>
                        </div>
                    </div>
                    <button type="submit" class="bg-[#E75480] hover:bg-[#cc4970] text-white px-4 py-2 rounded">Hitung</button>
                </form>
                <div id="result-container"></div>
            </div>
        </div>
    </div>

    <script src="/js/matriks.js"></script>
@endsection
