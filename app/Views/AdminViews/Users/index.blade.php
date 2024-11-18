@extends('layouts.DashboardLayout')

@section('title', 'User')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center pb-10">
        <h1 class="text-4xl font-bold text-blue-950">Users</h1>
    </div>
    <div class="w-full">
        <div class="bg-white shadow-xl rounded-md px-8 py-4">
            <table class="w-full mt-2 text-center border">
                <thead>
                    <tr class="border">
                        <th scope="col" class="px-6 py-3">Credential ID</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Role</th>
                        <th scope="col" class="px-6 py-3">Password</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td class="px-6 py-4 border">{{ $user->credential_id }}</td>
                        <td class="px-6 py-4 border">{{ $user->name }}</td>
                        <td class="px-6 py-4 border">{{ $user->role }}</td>
                        <td class="px-6 py-4 border">
                            <div class="flex items-center justify-center">
                                <span class="password-text hidden">{{ $user->plain_password }}</span>
                                <span class="password-dots">••••••••</span>
                                <button class="toggle-password bg-blue-500 text-white text-xs px-2 py-1 ml-2 rounded-md">Show</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Data kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleButtons = document.querySelectorAll('.toggle-password');

        toggleButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const parent = event.target.closest('td');
                const passwordText = parent.querySelector('.password-text');
                const passwordDots = parent.querySelector('.password-dots');
                const isHidden = passwordText.classList.contains('hidden');

                if (isHidden) {
                    passwordText.classList.remove('hidden');
                    passwordDots.classList.add('hidden');
                    event.target.textContent = 'Hide';
                } else {
                    passwordText.classList.add('hidden');
                    passwordDots.classList.remove('hidden');
                    event.target.textContent = 'Show';
                }
            });
        });
    });
</script>
@endsection
