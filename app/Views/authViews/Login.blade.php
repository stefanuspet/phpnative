@extends("layouts.AuthLayout")
@section('title', 'Login')

@section('content')
<h1 class="text-center font-semibold text-xl">LOGIN</h1>
<form action="/login" method="POST" class="mt-5">
    <div class="mb-3">
        <input id="cred_id" name="cred_id" type="number" class="border w-full rounded-sm p-2" placeholder="ID" required>
    </div>
    <div>
        <input id="password" name="password" type="password" class="border w-full rounded-sm p-2" placeholder="Password" required>
    </div>
    <!-- Display error message if it exists -->
    @if (isset($_SESSION['error']))
    <div style="color: red; text-align: center; margin-top: 12px">
        {{ $_SESSION['error'] }}
    </div>
    <?php unset($_SESSION['error']); ?> <!-- Remove the error message after displaying -->
    @endif
    <button type="submit" class="bg-blue-600 text-white w-full rounded-sm py-2 mt-5">MASUK</button>
    <div class="text-center mt-5">
        <a href="/register" class="text-blue-600">Belum punya akun? Daftar disini</a>
    </div>
    <div class="text-center mt-3">
        <a href="/forget-pass" class="text-red-600">Lupa Password?</a>
    </div>
</form>
@endsection
