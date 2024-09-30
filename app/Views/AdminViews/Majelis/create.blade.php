@extends('layouts.DashboardLayout')

@section('title', 'Cabang-store')
@section('content')
<div class="w-full">
    <h1 class="text-4xl font-bold pb-10 text-blue-950">Tambah Majelis</h1>
    <!-- eerrr -->
    @if (isset($_SESSION['error']))
    <div class="bg-red-500 text-white p-3 rounded-md w-4/5 mb-4">
        {{$_SESSION['error']}}
    </div>
    <?php unset($_SESSION['error']); ?>
    @endif
    <div class="shadow-md rounded-md bg-white w-4/5">
        <form action="/dashboard/majelis/store" class="p-4" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nit" class="block">NIT</label>
                <input type="number" name="nit" id="nit" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="block">Nama Majelis</label>
                <input type="text" name="nama" id="nama" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="block">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="block">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="block">Jenis Kelamin</label>
                <div class="flex items-center ml-4">
                    <input type="radio" name="jenis_kelamin" id="jenis_kelamin_laki" value="Laki-laki" class="mr-2" required>
                    <label for="jenis_kelamin_laki" class="mr-4">Laki-laki</label>
                    <input type="radio" name="jenis_kelamin" id="jenis_kelamin_perempuan" value="Perempuan" class="mr-2" required>
                    <label for="jenis_kelamin_perempuan">Perempuan</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="alamat" class="block">Alamat Rumah</label>
                <input type="text" name="alamat" id="alamat" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="mb-3">
                <label for="tahun_gabung" class="block">Bergabung Pada Tahun (Masuk BKC)</label>
                <input type="number" name="tahun_gabung" id="tahun_gabung" class="w-full border border-blue-600 rounded-md p-2" required min="1900" max="9999" placeholder="YYYY" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4)">
            </div>
            <div class="mb-3">
                <label for="jabatan" class="block">Jabatan</label>
                <select name="jabatan" id="jabatan" class="w-full border border-blue-600 rounded-md p-2" required>
                    <option value="">Choose</option>
                    <option value="Ketua Umum">Ketua Umum</option>
                    <option value="Sekretaris Umum">Serketaris Umum</option>
                    <option value="Bendahara Umum">Bendahara Umum</option>
                    <option value="Ketua Staf Pelatih">Ketua Staf Pelatih</option>
                    <option value="Ketua Majelis Sabuk Hitam">Ketua Majelis Sabuk Hitam</option>
                    <option value="Perwasitan">Perwasitan</option>
                    <option value="Usaha Dan Dana">Usaha Dan Dana</option>
                    <option value="Humas">Humas</option>
                    <option value="Pelatih Dojo">Pelatih Dojo</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tingkat_sabuk" class="block">Tingkatan Sabuk Saat ini</label>
                <select name="tingkat_sabuk" id="tingkat_sabuk" class="w-full border border-blue-600 rounded-md p-2" required>
                    <option value="">Choose</option>
                    <option value="DAN I">DAN I</option>
                    <option value="DAN II">DAN II</option>
                    <option value="DAN III">DAN III</option>
                    <option value="DAN IV">DAN IV</option>
                    <option value="DAN V">DAN V</option>
                    <option value="DAN VI">DAN VI</option>
                    <option value="DAN VII">DAN VII</option>
                    <option value="DAN VIII">DAN VIII</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="spesialis" class="block">Spesialis</label>
                <div class="flex items-center ml-4">
                    <input type="radio" name="spesialis" id="spesialis_kata" value="KATA" class="mr-2" required>
                    <label for="spesialis_kata" class="mr-4">KATA</label>
                    <input type="radio" name="spesialis" id="spesialis_kumite" value="KUMITE" class="mr-2" required>
                    <label for="spesialis_kumite">KUMITE</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="foto" class="block">Foto</label>
                <input type="file" name="foto" id="foto" class="w-full border border-blue-600 rounded-md p-2" required>
            </div>
            <div class="flex justify-end mt-10">
                <button class="px-3 py-1 bg-green-600 rounded-md text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection