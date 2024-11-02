@extends('layouts.DashboardLayout')

@section('title', 'Pembayaran')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold text-blue-950 pb-10">Data Pembayaran</h1>
    <a href="/dashboard/pembayaran/print">
        <div class="flex bg-blue-600 w-fit px-2 py-1 rounded-md items-center justify-center">
            <svg class="w-5 h-5" viewBox="0 0 600 600" version="1.1" id="svg9724" sodipodi:docname="print.svg" inkscape:version="1.2.2 (1:1.2.2+202212051550+b0a8486541)" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <defs id="defs9728"></defs>
                    <sodipodi:namedview id="namedview9726" pagecolor="#ffffff" bordercolor="#666666" borderopacity="1.0" inkscape:showpageshadow="2" inkscape:pageopacity="0.0" inkscape:pagecheckerboard="0" inkscape:deskcolor="#d1d1d1" showgrid="true" inkscape:zoom="0.84118632" inkscape:cx="232.40987" inkscape:cy="383.38712" inkscape:window-width="1920" inkscape:window-height="1009" inkscape:window-x="0" inkscape:window-y="1080" inkscape:window-maximized="1" inkscape:current-layer="svg9724" showguides="true">
                        <inkscape:grid type="xygrid" id="grid9972" originx="0" originy="0"></inkscape:grid>
                        <sodipodi:guide position="-260,300" orientation="0,-1" id="guide383" inkscape:locked="false"></sodipodi:guide>
                        <sodipodi:guide position="300,520" orientation="1,0" id="guide385" inkscape:locked="false"></sodipodi:guide>
                        <sodipodi:guide position="240,520" orientation="0,-1" id="guide939" inkscape:locked="false"></sodipodi:guide>
                        <sodipodi:guide position="220,80" orientation="0,-1" id="guide941" inkscape:locked="false"></sodipodi:guide>
                    </sodipodi:namedview>
                    <path id="rect348" style="color:#ffffff;fill:#ffffff;stroke-linecap:round;stroke-linejoin:round;-inkscape-stroke:none;paint-order:stroke fill markers" d="M 170 0 A 40.00405 40.00405 0 0 0 130 40 L 130 150 L 40 150 C 17.909591 150.002 0.0022087134 167.90958 0 190 L 0 410 C 0.0022087134 432.09042 17.909591 449.99779 40 450 L 130 450 L 130 320 C 130.00224 297.90958 147.90958 280.002 170 280 L 430 280 C 452.09042 280.00224 469.998 297.90958 470 320 L 470 450 L 560 450 C 582.09042 449.998 599.99779 432.09042 600 410 L 600 190 C 599.998 167.90958 582.09042 150.00221 560 150 L 470 150 L 470 40 A 40.00405 40.00405 0 0 0 430 0 L 170 0 z M 210 80 L 390 80 L 390 150 L 210 150 L 210 80 z M 430 200 L 530 200 A 20 20 0 0 1 550 220 A 20 20 0 0 1 530 240 L 430 240 A 20 20 0 0 1 410 220 A 20 20 0 0 1 430 200 z "></path>
                    <rect style="fill:none;stroke:#ffffff;stroke-width:79.9999;stroke-linecap:round;stroke-linejoin:round;paint-order:stroke fill markers" id="rect348-3-6" width="260" height="260" x="310" y="-430" transform="rotate(90)"></rect>
                    <path style="color:#ffffff;fill:#ffffff;stroke-linecap:round;-inkscape-stroke:none" d="m 250,380 a 20,20 0 0 0 -20,20 20,20 0 0 0 20,20 h 100 a 20,20 0 0 0 20,-20 20,20 0 0 0 -20,-20 z" id="path641"></path>
                    <path style="color:#ffffff;fill:#ffffff;stroke-linecap:round;-inkscape-stroke:none" d="m 250,460 a 20,20 0 0 0 -20,20 20,20 0 0 0 20,20 h 100 a 20,20 0 0 0 20,-20 20,20 0 0 0 -20,-20 z" id="path641-5"></path>
                </g>
            </svg>
            <span class="text-white px-2">
                Print PDF
            </span>
        </div>
    </a>
    <div class="w-full py-5">
        <div>
            <table class="w-full mt-2 text-center border">
                <thead>
                    <tr class="border text-center">
                        <th scope="col" class="px-6 py-3">Dojo Asal</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Tanggal Bukti Diunggah</th>
                        <th scope="col" class="px-6 py-3">Pembayaran Bulan</th>
                        <th scope="col" class="px-6 py-3">Nominal</th>
                        <th scope="col" class="px-6 py-3">Foto Bukti</th>
                        <th scope="col" class="px-6 py-3">Catatan Admin</th>
                    </tr>

                </thead>
                <tbody>
                    @forelse ($pembayaran as $items )
                    <tr>
                        <td class="px-6 py-4">{{$items->anggota->dojo->nama}}</td>
                        <td class="px-6 py-4">{{$items->anggota->nama}}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($items->created_at)->format('d-m-Y') }}</td>
                        <td class="px-6 py-4">{{$items->bulan}}</td>
                        <!-- nominal -->
                        <td class="px-6 py-4">
                            Rp {{$items->nominal}}
                        </td>
                        <td class="px-6 py-4">
                            <a href="/uploads/{{$items->bukti_pembayaran}}" class="w-44">
                                <img class="object-fill w-44 mx-auto" src="/uploads/{{$items->bukti_pembayaran}}" alt="{{$items->bukti_pembayaran}}">
                            </a>
                        </td>
                        <td class="px-6 py-4 max-w-[150px]">{{$items->catatan}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Data tidak ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection