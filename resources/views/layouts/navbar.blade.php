<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>SPK ELECTRE</title>
</head>
<body class="bg-slate-100 ">
    <header class="h-14 flex fixed z-40 right-0 left-0 top-0 items-center justify-between py-3 px-6 bg-white border-b dark:border-primary-darker dark:bg-darker drop-shadow-sm">
        <div class="flex sm:ml-56 items-center">
            <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="mr-5 items-center text-sm text-gray-500  focus:outline-none hover:text-main">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
            </button>
            <h1 class="sm:hidden text-xl font-semibold text-main">SPK ELECTRE</h1>
        </div>
        <a href="/profil" class="text-2xl text-main"><i class='bx bxs-user-circle text-4xl hover:text-emerald-800'></i></a>
    </header>
    <aside id="default-sidebar" class="flex z-40 flex-col fixed h-full top-0 bottom-0 left-0 w-56 py-4 bg-white border-r dark:border-primary-darker dark:bg-darker drop-shadow-sm transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <ul>
            <li>
                <h1 class="text-xl font-semibold text-main px-7 pb-6">SPK ELECTRE</h1>
            </li>
        </ul>
        <ul class="flex flex-col gap-y-1">
            <li>
                <a href="/dashboard" class="{{ (request()->is('dashboard')) ? 'active' : '' }} flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bx-line-chart text-xl'></i><span class="pl-3">Dashboard</span></a>
            </li>
            @can('admin')
            <li>
                <a href="/pengguna"class="{{ (request()->segment(1) == 'pengguna') ? 'active' : '' }} flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bxs-group text-xl' ></i><span class="pl-3">Pengguna</span></a>
            </li>
            <li>
                <a href="/pembina-wilayah"class="{{ (request()->segment(1) == 'pembina-wilayah') ? 'active' : '' }} flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bx-plus-medical text-xl'></i><span class="pl-3">Pembina Wilayah</span></a>
            </li>
            <li>
                <a href="/posyandu" class="{{ (request()->segment(1) == 'posyandu') ? 'active' : '' }} flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bx-home-heart text-xl'></i><span class="pl-3">Posyandu</span></a>
            </li>
            @endcan
            @can('admin')
            <li>
                <a href="/alternatif" class="{{ (request()->segment(1) == 'alternatif') ? 'active' : '' }}  flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bxs-baby-carriage text-xl' ></i><span class="pl-3">Alternatif</span></a>
            </li>
            <li>
                <a href="/kriteria" class="{{ (request()->segment(1) == 'kriteria') ? 'active' : '' }}  flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bx-list-check text-xl'></i><span class="pl-3">Kriteria</span></a>
            </li>
            <li>
                <a href="/penilaian" class="{{ (request()->segment(1) == 'penilaian') ? 'active' : '' }}  flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bx-file text-xl'></i><span class="pl-3">Penilaian</span></a>
            </li>
            <li>
                <a href="/hasil" class="{{ (request()->segment(1) == 'hasil') ? 'active' : '' }}  flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bx-receipt text-xl'></i><span class="pl-3">Hasil</span></a>
            </li>
            <li>
                <a href="/rekap" class="{{ (request()->segment(1) == 'rekap') ? 'active' : '' }}  flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bxs-report text-xl'></i><span class="pl-3">Rekap</span></a>
            </li>
            @endcan
            @can('pb')
            <li>
                <a href="/kriteria" class="{{ (request()->segment(1) == 'kriteria') ? 'active' : '' }}  flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bx-list-check text-xl'></i><span class="pl-3">Kriteria</span></a>
            </li>
            <li>
                <a href="/alternatif" class="{{ (request()->segment(1) == 'alternatif') ? 'active' : '' }}  flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bxs-baby-carriage text-xl'></i><span class="pl-3">Alternatif</span></a>
            </li>
            <li>
                <a href="/penilaian" class="{{ (request()->segment(1) == 'penilaian') ? 'active' : '' }}  flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bx-file text-xl'></i><span class="pl-3">Penilaian</span></a>
            </li>
            <li>
                <a href="/hasil" class="{{ (request()->segment(1) == 'hasil') ? 'active' : '' }}  flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bx-receipt text-xl'></i><span class="pl-3">Hasil</span></a>
            </li>
            @endcan
            @can('ortu')
            <li>
                <a href="/alternatif" class="{{ (request()->segment(1) == 'alternatif') ? 'active' : '' }}  flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bxs-baby-carriage text-xl'></i><span class="pl-3">Anak</span></a>
            </li>
            <li>
                <a href="/penilaian" class="{{ (request()->segment(1) == 'penilaian') ? 'active' : '' }}  flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bx-file text-xl'></i><span class="pl-3">Penilaian</span></a>
            </li>
            <li>
                <a href="/hasil" class="{{ (request()->segment(1) == 'hasil') ? 'active' : '' }}  flex items-center text-base text-gray-500 py-2 px-4 mx-3 hover:bg-emerald-200 hover:rounded-md transition-all duration-200"><i class='bx bx-receipt text-xl'></i><span class="pl-3">Hasil</span></a>
            </li>
            @endcan

        </ul>
        <ul class="flex items-end justify-center h-full">
            <li>
                <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="flex items-center text-center rounded-md bg-main text-white py-2 px-14 my-2 mx-4  hover:bg-emerald-800 transition-all duration-200"><i class='bx bx-log-out-circle'></i><span class="pl-3">Logout</span></button>
                </form>
            </li>
        </ul>
    </aside>
    <div class="container max-w-full flex flex-col mt-14">
        @yield('container')
    </div>
    <script src="../flowbite/dist/flowbite.min.js"></script>
    <script type="text/javascript" src="../node_modules/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>
</html>
