<?php
ob_start();
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: /auth/login.php");
    exit();
}
// Cek apakah session 'name' ada
if (isset($_SESSION['username'])) {
    $nama_pembeli = $_SESSION['username'];
} else
    $nama_pembeli = "Nama tidak tersedia";
  


?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pulsa & Kuota</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-green-500 text-white py-3 shadow-md fixed top-0 w-full z-50">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <!-- Logo -->
            <div class="text-lg font-bold">Pulsa & Kuota</div>
            
            <!-- Menu Items -->
            <div class="hidden md:flex space-x-6">
                <a href="#" class="hover:text-gray-200">Home</a>
                <a href="#" class="hover:text-gray-200">Produk</a>
                <a href="#" class="hover:text-gray-200">Promo</a>
                <a href="#" class="hover:text-gray-200">Kontak</a>
            </div>
            
            <!-- Menu Button for Mobile -->
            <button id="menu-toggle" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden flex flex-col bg-green-600 text-white p-4 space-y-2">
            <a href="#" class="hover:bg-green-700 p-2 rounded">Home</a>
            <a href="#" class="hover:bg-green-700 p-2 rounded">Produk</a>
            <a href="#" class="hover:bg-green-700 p-2 rounded">Promo</a>
            <a href="#" class="hover:bg-green-700 p-2 rounded">Kontak</a>
        </div>
    </nav>
    
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
    
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
    
    
    <!-- Navbar -->
    <div class="bg-green-500 text-white py-4 text-center text-lg font-bold">WS96</div>
    <div class="bg-green-200 text-black font-mono py-2">
        <div class="container mx-auto">
          <marquee behavior="scroll" direction="left" scrollamount="5">
            Welcome to JotCoffe! Enjoy our special Coffe & Snack! ☕️☕️ Get 50% discount for all products!
          </marquee>
        </div>
      </div>
    
    <!-- Container -->
    <div class="max-w-sm mx-auto mt-6 p-4 bg-white rounded-lg shadow-md">
        <h1 class="text-xl font-bold text-center mb-4">Danish Cell</h1>

        
    <form class="form">
        <button>
            <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
        <input class="input" placeholder="Search" required="" type="text">
        <button class="reset" type="reset">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>


    </form>

    <form action="../utils/proses_pesan.php" method="POST" class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md space-y-5">
    <h2 class="text-xl font-semibold text-gray-700">Form Pemesanan Pulsa</h2>

    <!-- Nama Pembeli -->
    <div>
    <label class="block text-sm font-medium text-gray-700">Nama Pembeli</label>
    <input 
    type="text" 
    name="nama_pembeli" 
    value="<?= htmlspecialchars($nama_pembeli) ?>" 
    readonly 
    class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md p-2 text-sm"
>
    </div>

    <!-- Nomor HP Tujuan -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Nomor HP Tujuan</label>
        <input 
            type="text" 
            name="no_hp" 
            required 
            class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm"
        >
    </div>

    <div>
        <label for="provider" class="block text-sm font-medium text-gray-700">Provider</label>
        <select 
            name="provider" 
            id="provider" 
            required 
            class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm"
        >
            <option value="" disabled selected>-- Pilih Provider --</option>
            <option value="Telkomsel">Telkomsel</option>
            <option value="Indosat">Indosat</option>
            <option value="XL">XL</option>
            <option value="Axis">Axis</option>
            <option value="Tri">Tri</option>
            <option value="Smartfren">Smartfren</option>
        </select>
    </div>

    <!-- Pesan ke Admin -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Pesan ke Admin</label>
        <textarea 
            name="pesan" 
            rows="3" 
            required 
            class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm"
        ></textarea>
    </div>

    <!-- Metode Pembayaran -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
        <select 
            name="metode" 
            id="metodePembayaran"
            required 
            class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm"
            onchange="toggleWaktuBayar()"
        >
            <option value="">-- Pilih --</option>
            <option value="warung langsung">In-Store Payment</option>
            <option value="qris">QRIS</option>
        </select>
    </div>

<!-- Jika pilih Warung -->
<div id="waktuBayarField" class="hidden">
    <label class="block text-sm font-medium text-gray-700">Kapan akan membayar?</label>
    <input 
        type="datetime-local" 
        name="waktu_bayar" 
        class="mt-1 block w-full border border-gray-300 rounded-md p-2 text-sm"
    >
</div>

    <!-- Submit -->
    <div class="pt-3">
        <button 
            type="submit" 
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md"
        >
            Submit Pesanan
        </button>
    </div>
</form>

<!-- Script Toggle -->
<script>
    function toggleWaktuBayar() {
        const metode = document.getElementById('metodePembayaran').value;
        const waktuField = document.getElementById('waktuBayarField');
        if (metode === 'warung langsung') {
            waktuField.classList.remove('hidden');
        } else {
            waktuField.classList.add('hidden');
        }
    }
</script>

<div style="height: 50px;"></div>
      
    </div>
    
    
    <!-- Footer -->
    <div class="fixed bottom-0 w-full bg-white py-2 shadow-md flex justify-around text-gray-700">
        <button class="flex flex-col items-center">
            <span class="text-xl">🏠</span>
            <span class="text-sm">Home</span>
        </button>
        <button class="flex flex-col items-center">
            <span class="text-xl">🛒</span>
            <span class="text-sm">Transaksi</span>
        </button>
        <button class="flex flex-col items-center" onclick="window.location.href='./profile.php';">
            <span class="text-xl">⚙️</span>
            <span class="text-sm">Akun</span>
        </button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
