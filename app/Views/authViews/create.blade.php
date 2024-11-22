@extends("layouts.AuthLayout")
@section('title', 'Lupa Password')

@section('content')
<h1 class="text-center font-semibold text-xl">LUPA PASSWORD</h1>
<form action="/forget-pass/store" method="POST" class="mt-5">
    @csrf
    <!-- Display error message if it exists -->
    @if (isset($_SESSION['error']))
    <div style="color: red; text-align: center; margin-top: 12px">
        {{ $_SESSION['error'] }}
    </div>
    <?php unset($_SESSION['error']); ?>
    @endif

    @if (isset($_SESSION['success']))
    <div style="color: green; text-align: center; margin-top: 12px">
        {{ $_SESSION['success'] }}
    </div>
    <?php unset($_SESSION['success']); ?>
    @endif

    <!-- Role Selection -->
    <div class="mb-3">
        <label for="role" class="block font-semibold mb-2">Role</label>
        <div class="flex items-center">
            <input id="role_majelis" name="role" type="radio" value="Majelis" class="mr-2" required>
            <label for="role_majelis" class="mr-5">Majelis</label>
            
            <input id="role_atlet" name="role" type="radio" value="Atlet" class="mr-2" required>
            <label for="role_atlet">Atlet</label>
        </div>
    </div>

    <!-- Input Fields for Majelis -->
    <div id="majelis-fields" class="hidden">
        <div class="mb-3">
            <label for="name_majelis" class="block">Nama Majelis</label>
            <select id="name_majelis" name="name_majelis" class="border w-full rounded-sm p-2">
                <option value="">Pilih Nama Majelis</option>
                @foreach ($majelis as $m)
                <option value="{{ $m->nama }}">{{ $m->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tahun_gabung" class="block">Tahun Bergabung</label>
            <input id="tahun_gabung" name="tahun_gabung" type="number" class="border w-full rounded-sm p-2" placeholder="Tahun Bergabung (YYYY)" min="1900" max="9999">
        </div>
        <div class="mb-3">
            <label for="nomor_telepon" class="block">Nomor Telepon</label>
            <input id="nomor_telepon" name="nomor_telepon" type="tel" class="border w-full rounded-sm p-2" placeholder="Nomor Telepon">
        </div>
    </div>

    <!-- Input Fields for Atlet -->
    <div id="atlet-fields" class="hidden">
        <div class="mb-3">
            <label for="name_atlet" class="block">Nama Atlet</label>
            <select id="name_atlet" name="name_atlet" class="border w-full rounded-sm p-2">
                <option value="">Pilih Nama Atlet</option>
                @foreach ($atlet as $a)
                <option value="{{ $a->nama }}">{{ $a->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="dojo" class="block">Dojo</label>
            <select id="dojo" name="dojo" class="border w-full rounded-sm p-2">
                <option value="">Pilih Dojo</option>
                @foreach ($dojos as $dojo)
                <option value="{{ $dojo->id }}">{{ $dojo->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="bg-blue-600 text-white w-full rounded-sm py-2 mt-5">Kirim Permintaan</button>
    <div class="text-center mt-5">
        <a href="/" class="text-blue-600">Kembali ke Login</a>
    </div>
</form>

<!-- Admin Contact for Customer Service -->
<div class="mt-5 bg-gray-100 p-5 rounded-md text-center">
    <p class="text-sm text-gray-600">
        Jika Anda mengalami kendala, silakan hubungi Admin untuk bantuan lebih lanjut:
    </p>
    <p class="font-bold text-gray-800">WhatsApp: 089655954900</p>
    <!-- <p class="font-bold text-gray-800">Email: admin@example.com</p> -->
</div>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleMajelis = document.getElementById('role_majelis');
        const roleAtlet = document.getElementById('role_atlet');
        const majelisFields = document.getElementById('majelis-fields');
        const atletFields = document.getElementById('atlet-fields');

        function toggleFields() {
            majelisFields.classList.add('hidden');
            atletFields.classList.add('hidden');

            if (roleMajelis.checked) {
                majelisFields.classList.remove('hidden');
            } else if (roleAtlet.checked) {
                atletFields.classList.remove('hidden');
            }
        }

        roleMajelis.addEventListener('change', toggleFields);
        roleAtlet.addEventListener('change', toggleFields);
    });
</script>
@endsection
