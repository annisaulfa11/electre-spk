<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="bg-gray-200">
    <div class="flex h-full w-full fixed justify-center items-center py-14">
        <div class="flex flex-col relative justify-center px-14 items-center">
            <div class="flex flex-col relative rounded-lg bg-white h-auto px-14 py-14 justify-center items-center">
                <div class="mb-10">
                    <h1 class="text-center font-semibold text-gray-500">Sistem Pendukung Keputusan Penentuan Balita Penerima PMT Pemulihan</h1>
                </div>
                <form action="/register" method="POST" enctype="multipart/form-data" class="flex flex-col w-full gap-y-3">
                    @csrf
                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mb-3 rounded relative" role="alert">
                        @foreach ($errors->all() as $error)
                            <strong class="font-bold">{{ $error }}</strong>
                        @endforeach
                    </div>
                    @endif

                    <div class="flex flex-row gap-x-3 justify-between">
                        <div class="flex flex-col gap-y-3 w-full">
                            <div class="flex flex-col ">
                                <label for="name" class="mb-1 text-main text-xs font-semibold">NAMA LENGKAP<span class="text-red-700">*</span></label>
                                <input type="text" name="name" id="name" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('name')}}">
                            </div>
                            <div class="flex flex-col ">
                                <label for="username" class="mb-1 text-main text-xs font-semibold">USERNAME<span class=" text-red-700">*</span></label>
                                <input type="text" name="username" id="username" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('username')}}">
                            </div>

                        </div>
                        <div class="flex flex-col gap-y-3 w-full">
                            <div class="flex flex-col hidden">
                                <label for="role" class="mb-1 text-main text-xs font-semibold">ROLE<span class="text-red-700">*</span></label>
                                <select name="role" required id="role" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                                    <option value="">Pilih role</option>
                                    <option value="admin" class="">Admin</option>
                                    <option value="pb">Pembina Wilayah</option>
                                    <option value="ortu" selected>Orang Tua</option>
                                </select>
                            </div>
                            <div class="flex flex-col ">
                                <label for="password" class="mb-1 text-main text-xs font-semibold">PASSWORD<span class="text-red-700">*</span></label>
                                <input type="password" name="password" id="password" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('password')}}">
                            </div>

                            <div class="flex flex-col ">
                                <label for="no_hp" class="mb-1 text-main text-xs font-semibold">NO HP<span class="text-red-700">*</span></label>
                                <input type="text" name="no_hp" id="no_hp" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('no_hp')}}">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col ">
                        <label for="alamat" class="mb-1 text-main text-xs font-semibold">ALAMAT<span class="text-red-700">*</span></label>
                        <input type="text" name="alamat" id="alamat" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('alamat')}}">
                    </div>
                    <div class="flex flex-col ">
                        <label for="foto" class="mb-1 text-main text-xs font-semibold">FOTO<span class="text-red-700">*</span></label>
                        <input type="file" name="foto" id="foto" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required>
                    </div>


                    <div class="flex justify-center mt-4">
                        <button class="bg-main py-2 px-10 rounded-md text-white font-semibold hover:bg-emerald-800" type="submit">REGISTER</button>
                    </div>
                </form>
        </div>
    </div>

</body>
</html>


