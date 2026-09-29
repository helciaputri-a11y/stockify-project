<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - Stockify</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    @include('layouts.navigation')

    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Pengguna Sistem</h1>
            <a href="{{ route('users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">+ Tambah Pengguna</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-center">Role / Hak Akses</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <!-- Kolom Nama -->
                            <td class="py-3 px-6 text-left whitespace-nowrap font-medium text-gray-800">
                                {{ $user->name }}
                            </td>

                            <!-- Kolom Email -->
                            <td class="py-3 px-6 text-left">
                                {{ $user->email }}
                            </td>

                            <!-- Kolom Role -->
                           <!-- Kolom Role / Hak Akses -->
<td class="py-3 px-6 text-center">
    <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-xs font-semibold">
        {{ $user->role }}
    </span>
</td>

                            <!-- Kolom Aksi (Edit & Hapus) -->
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                <!-- Tombol Edit -->
                                <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3 font-semibold">Edit</a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">Belum ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>