@extends('layouts.DashboardLayout')

@section('title', 'Cabang-edit')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Edit Majelis</h1>
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/majelis/update/{{ $majelis->nit }}" class="p-4" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nit" class="block">NIT</label>
                <input type="number" name="nit" id="nit" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->nit }}" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="block">Nama Majelis</label>
                <input type="text" name="nama" id="nama" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="block">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->tempat_lahir }}" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="block">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->tanggal_lahir }}" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="block">Jenis Kelamin</label>
                <div class="flex items-center">
                    <input type="radio" name="jenis_kelamin" id="jenis_kelamin_laki" value="Laki-laki" class="mr-2" {{ $majelis->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }}>
                    <label for="jenis_kelamin_laki" class="mr-4">Laki-laki</label>
                    <input type="radio" name="jenis_kelamin" id="jenis_kelamin_perempuan" value="Perempuan" class="mr-2" {{ $majelis->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                    <label for="jenis_kelamin_perempuan">Perempuan</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="alamat" class="block">Alamat Rumah</label>
                <input type="text" name="alamat" id="alamat" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->alamat }}" required>
            </div>
            <div class="mb-3">
                <label for="tahun_gabung" class="block">Bergabung Pada Tahun (Masuk BKC)</label>
                <input type="number" name="tahun_gabung" id="tahun_gabung" class="w-full border border-blue-600 rounded-md p-2" value="{{ $majelis->tahun_gabung }}" min="1900" max="{{ date('Y') }}" step="1" required>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="block">Jabatan</label>
                <select name="jabatan" id="jabatan" class="w-full border border-blue-600 rounded-md p-2" required>
                    <option value="">Choose</option>
                    <option value="Ketua Umum" {{ $majelis->jabatan == 'Ketua Umum' ? 'selected' : '' }}>Ketua Umum</option>
                    <option value="Sekretaris Umum" {{ $majelis->jabatan == 'Sekretaris Umum' ? 'selected' : '' }}>Sekretaris Umum</option>
                    <option value="Bendahara Umum" {{ $majelis->jabatan == 'Bendahara Umum' ? 'selected' : '' }}>Bendahara Umum</option>
                    <option value="Ketua Staf Pelatih" {{ $majelis->jabatan == 'Ketua Staf Pelatih' ? 'selected' : '' }}>Ketua Staf Pelatih</option>
                    <option value="Ketua Majelis Sabuk Hitam" {{ $majelis->jabatan == 'Ketua Majelis Sabuk Hitam' ? 'selected' : '' }}>Ketua Majelis Sabuk Hitam</option>
                    <option value="Perwasitan" {{ $majelis->jabatan == 'Perwasitan' ? 'selected' : '' }}>Perwasitan</option>
                    <option value="Usaha Dan Dana" {{ $majelis->jabatan == 'Usaha Dan Dana' ? 'selected' : '' }}>Usaha Dan Dana</option>
                    <option value="Humas" {{ $majelis->jabatan == 'Humas' ? 'selected' : '' }}>Humas</option>
                    <option value="Pelatih Dojo" {{ $majelis->jabatan == 'Pelatih Dojo' ? 'selected' : '' }}>Pelatih Dojo</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tingkat_sabuk" class="block">Tingkat Sabuk</label>
                <select name="tingkat_sabuk" id="tingkat_sabuk" class="w-full border border-blue-600 rounded-md p-2" required>
                    <option value="">Choose</option>
                    <option value="DAN I" {{ $majelis->tingkat_sabuk == 'DAN I' ? 'selected' : '' }}>DAN I</option>
                    <option value="DAN II" {{ $majelis->tingkat_sabuk == 'DAN II' ? 'selected' : '' }}>DAN II</option>
                    <option value="DAN III" {{ $majelis->tingkat_sabuk == 'DAN III' ? 'selected' : '' }}>DAN III</option>
                    <option value="DAN IV" {{ $majelis->tingkat_sabuk == 'DAN IV' ? 'selected' : '' }}>DAN IV</option>
                    <option value="DAN V" {{ $majelis->tingkat_sabuk == 'DAN V' ? 'selected' : '' }}>DAN V</option>
                    <option value="DAN VI" {{ $majelis->tingkat_sabuk == 'DAN VI' ? 'selected' : '' }}>DAN VI</option>
                    <option value="DAN VII" {{ $majelis->tingkat_sabuk == 'DAN VII' ? 'selected' : '' }}>DAN VII</option>
                    <option value="DAN VIII" {{ $majelis->tingkat_sabuk == 'DAN VIII' ? 'selected' : '' }}>DAN VIII</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="spesialis" class="block">Spesialis</label>
                <div class="flex items-center">
                    <input type="radio" name="spesialis" id="spesialis_kata" value="KATA" class="mr-2" {{ $majelis->spesialis == 'KATA' ? 'checked' : '' }}>
                    <label for="spesialis_kata" class="mr-4">KATA</label>
                    <input type="radio" name="spesialis" id="spesialis_kumite" value="KUMITE" class="mr-2" {{ $majelis->spesialis == 'KUMITE' ? 'checked' : '' }}>
                    <label for="spesialis_kumite">KUMITE</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="foto" class="block">Foto</label>
                <input type="file" name="foto" id="foto" class="w-full border border-blue-600 rounded-md p-2">
                @if($majelis->foto)
                <div class="mt-3">
                    <img src="/uploads/{{$majelis->foto}}" alt="Foto Majelis" class="w-32 h-32 object-cover rounded-md">
                </div>
                @endif
            </div>
            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection