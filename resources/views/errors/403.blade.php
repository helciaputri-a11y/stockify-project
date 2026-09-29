<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen m-0 font-sans">
    <div class="text-center p-8 bg-white shadow-md rounded-lg max-w-md w-full">
        <h1 class="text-6xl font-bold text-red-500 mb-4">403</h1>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Akses Ditolak</h2>
        <p class="text-gray-600 mb-6">Maaf, akun kamu tidak memiliki hak akses untuk membuka halaman ini.</p>
        
        <a href="{{ url('/dashboard') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-md transition duration-200">
            Kembali ke Dashboard
        </a>
    </div>
</body>
</html>