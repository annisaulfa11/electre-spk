@extends('layouts.navbar')
@section('container')


<div class="sm:ml-56 flex flex-col">

    <div class="h-12 flex flex-col bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex justify-between">
            <ul>
                <li>
                    <a href=""><span class="text-gray-500">{{json_encode($matriks)}}</span></a>
                </li>
            </ul>

        </nav>
    </div>

</div>
@endsection

