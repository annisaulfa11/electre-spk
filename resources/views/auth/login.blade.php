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
        <div class="flex flex-col relative w-428 justify-center px-14 items-center">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-300 to-emerald-700 shadow-md -rotate-12 sm:skew-y-0 sm:-rotate-12 sm:rounded-lg rounded-lg"></div>
            <div class="flex flex-col relative rounded-lg bg-white w-428 h-auto px-14 py-14 justify-center items-center">
                <div class="mb-10">
                    <h1 class="text-center font-semibold text-gray-500">Sistem Pendukung Keputusan Penentuan Balita Penerima PMT Pemulihan</h1>
                </div>
                <form action="/" method="POST" class="w-full">
                    @csrf
                    <div class="flex flex-col w-full gap-y-8">
                        @if (session()->has('loginError'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            {{session('Login Failed!')}}
                            <strong class="font-bold">Login Failed!</strong>
                          </div>
                        @endif
                        @if(session('success'))
                        <div class="bg-emerald-100 border border-emerald-400 text-main px-4 py-2 rounded relative" role="alert">
                            <strong class="font-bold">{{ session('success') }}</strong>
                        </div>
                        @endif
                        <div>
                            <input type="text" name="username" id="username" placeholder="Username" class="focus:ring-0 h-10 w-full border-0 border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-main transition duration-1000" required autocomplete autofocus value="{{ old ('username')}}">
                            <label for="username"></label>
                        </div>
                        <div>
                            <input type="password" name="password" id="password" placeholder="Password" class="focus:ring-0 h-10 w-full border-0 border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-main transition duration-1000" required>
                            <label for="password" ></label>
                        </div>
                        <div class="flex justify-center mt-4">
                            <button class="bg-main py-2 px-10 rounded-md text-white font-semibold hover:bg-emerald-800" type="submit">LOGIN</button>
                        </div>
                    </div>
                </form>
                <div class="mt-4">
                    <a href="/register" class="text-sm text-main hover:text-emerald-800">Buat Akun Disini!</a>
                </div>
        </div>
    </div>

</body>
</html>
