@extends('layouts.MajelisLayout')

@section('title', 'Anggota')
@section('content')
<div class="w-full">
    <div class="flex justify-between items-center pb-10">
        <h1 class="text-4xl font-bold text-blue-950">Penjadwalan Dojo & Pelatih</h1>
        <button id="openModalBtn" class="bg-blue-600 text-white px-4 py-2 rounded-md">Tambah Data</button>
    </div>
    @if (isset($_SESSION['error']))
    <div class="bg-red-500 w-full py-2 text-center text-white rounded-md mb-4">
        {{ $_SESSION['error'] }}
    </div>
    <?php unset($_SESSION['error']); ?> <!-- Hapus pesan error setelah ditampilkan -->
    @endif
    <table class="w-full border">
        <thead>
            <tr class="border border-black font-bold text-center">
                <td class="border border-black py-2">Nama Dojo</td>
                <td class="border border-black ">Hari</td>
                <td class="border border-black">Waktu</td>
                <td class="border border-black" >Pelatih</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            @php
                $previousDojoId = null;
                $previousDayTime = null;
                $dojoRowspanCounter = 0;
                $timeRowspanCounter = 0;
            @endphp

            @foreach ($dojoMajelis as $index => $dj)
                @php
                    // Check if the current dojo ID is the same as the previous one
                    $isSameDojo = ($previousDojoId === $dj->dojo->id);

                    // Combine day and time (start_time and end_time) for comparison
                    $currentDayTime = $dj->day . '-' . $dj->start_time . '-' . $dj->end_time;

                    // Check if the current day and time is the same as the previous one
                    $isSameDayTime = ($previousDayTime === $currentDayTime);

                    // Calculate rowspan for dojo if it changes
                    if (!$isSameDojo) {
                        // Count how many rows belong to the current dojo
                        $dojoRowspanCounter = $dojoMajelis->where('dojo.id', $dj->dojo->id)->count();
                    }

                    // Calculate rowspan for day-time combination within the same dojo
                    if (!$isSameDayTime || !$isSameDojo) {
                        // Count how many rows have the same day and time within the same dojo
                        $timeRowspanCounter = $dojoMajelis
                            ->where('dojo.id', $dj->dojo->id)
                            ->where('day', $dj->day)
                            ->where('start_time', $dj->start_time)
                            ->where('end_time', $dj->end_time)
                            ->count();
                    }
                @endphp

                <tr class="text-center">
                    @if (!$isSameDojo)
                        <td class="border border-black py-1" rowspan="{{ $dojoRowspanCounter }}">
                            {{$dj->dojo->nama}}
                        </td>
                    @endif

                    @if (!$isSameDayTime)
                        <td class="border border-black py-1" rowspan="{{ $timeRowspanCounter }}">
                            {{$dj->day}}
                        </td>
                        <td class="border border-black py-1" rowspan="{{ $timeRowspanCounter }}">
                            {{ $dj->start_time }}-{{ $dj->end_time }} WITA
                        </td>
                    @endif

                    <td class="border border-black py-1">{{$dj->majelis->nama}}</td>
                    <td class="border border-black ">
                        <div class="inline-flex py-2 gap-x-2">
                            <form action="/dashboard/dojoMajelis/delete" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="{{ $dj->id }}">
                                <input type="hidden" name="id_dojo" value="{{ $dj->dojo->id }}">
                                <input type="hidden" name="id_majelis" value="{{ $dj->majelis->nit }}">
                                <button type="submit" class="px-3 py-1 hover:bg-red-700 bg-red-600 rounded-md text-white">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>

                @php
                    $previousDojoId = $dj->dojo->id; // Update the previous dojo ID
                    $previousDayTime = $currentDayTime; // Update the previous day and time combination
                @endphp
            @endforeach
        </tbody>

    </table>
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-1/2">
        <h2 class="text-2xl font-bold mb-4">Tambah Pelatih</h2>
        <form action="/dashboard/dojoMajelis/store" method="POST">
            @csrf
            <!-- Majelis Selection -->
            <div class="mb-3">
                <label for="id_majelis" class="block text-sm font-medium text-gray-700">Nama Pelatih</label>
                <select name="id_majelis" id="id_majelis" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    @foreach ($majelisall as $m)
                        <option value="{{ $m->nit }}">{{ $m->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dojo Selection -->
            <div class="mb-3">
                <label for="id_dojo" class="block text-sm font-medium text-gray-700">Nama Dojo</label>
                <select name="id_dojo" id="id_dojo" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    @foreach ($dojoall as $dojo)
                        <option value="{{ $dojo->id }}">{{ $dojo->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Day Selection -->
            <div class="mb-3">
                <label for="day" class="block text-sm font-medium text-gray-700">Hari</label>
                <select name="day" id="day" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
            </div>

            <!-- Start Time Selection -->
            <div class="mb-3">
                <label for="start_time" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                <select name="start_time" id="start_time" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    @for ($i = 1; $i <= 24; $i++)
                        <option value="{{ $i }}">{{ $i }} WITA</option>
                    @endfor
                </select>
            </div>

            <!-- End Time Selection -->
            <div class="mb-6">
                <label for="end_time" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                <select name="end_time" id="end_time" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    @for ($i = 1; $i <= 24; $i++)
                        <option value="{{ $i }}">{{ $i }} WITA</option>
                    @endfor
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end">
                <button type="button" id="closeModalBtn" class="bg-red-600 text-white px-4 py-2 rounded-md mr-2">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startTimeSelect = document.getElementById('start_time');
        const endTimeSelect = document.getElementById('end_time');

        // Function to update end time options based on selected start time
        function updateEndTimeOptions() {
            const startTime = parseInt(startTimeSelect.value);
            
            // Remove all existing options in end_time select
            endTimeSelect.innerHTML = '';

            // Create new options based on the selected start time
            for (let i = startTime + 1; i <= 24; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = `${i} WITA`;
                endTimeSelect.appendChild(option);
            }

            // Set the end time to be at least start time + 1 if there are valid options
            if (endTimeSelect.options.length > 0) {
                endTimeSelect.value = startTime + 1;
            }
        }

        // Initial call to set end time options based on the default selected start time
        updateEndTimeOptions();

        // Update end time options whenever start time changes
        startTimeSelect.addEventListener('change', updateEndTimeOptions);
    });
</script>


<script>
    // Get elements
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modal = document.getElementById('modal');

    // Show modal
    openModalBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    // Hide modal
    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
</script>
@endsection
