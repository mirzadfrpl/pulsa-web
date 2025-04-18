<?php
ob_start();
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: /auth/login.php");
    exit();
}



?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pulsa & Kuota - Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-green-500 text-white py-3 shadow-md fixed top-0 w-full z-50">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <!-- Logo -->
            <div class="text-lg font-bold">Profile</div>
            
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
        <h1 class="text-xl font-bold text-center mb-4">Edit Profile</h1>



        <form action="../utils/auth.php" method="POST" class="space-y-4">
            <p>Name</p>
            <input type="text" name="name" value="<?= $_SESSION['name'] ?>" required class="border px-2 py-1 rounded w-full" />
            <p>Username</p>
            <input type="text" name="username" value="<?= $_SESSION['username'] ?>" required class="border px-2 py-1 rounded w-full" />
            <p>Phone Number</p>
            <input type="text" name="phone_number" value="<?= $_SESSION['phone_number'] ?>" required class="border px-2 py-1 rounded w-full" />
            <button type="submit" name="edit_profile" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>

            <!-- Tambahkan input untuk password baru -->
            <input type="password" name="new_password" placeholder="Password Baru (Opsional)" class="border px-2 py-1 rounded w-full" />
            
            <button type="submit" name="edit_profile" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
        </form>

    
      
        
        
      
    </div>
    
    
    <!-- Footer -->
    <div class="fixed bottom-0 w-full bg-white py-2 shadow-md flex justify-around text-gray-700">
        
        <button class="flex flex-col items-center" onclick="window.location.href='./index.php';">
            <span class="text-xl">🏠</span>
            <span class="text-sm">Home</span>
        </button>
        
        <button class="flex flex-col items-center">
            <span class="text-xl">🛒</span>
            <span class="text-sm">Transaksi</span>
        </button>
        <button class="flex flex-col items-center">
            <span class="text-xl">⚙️</span>
            <span class="text-sm">Akun</span>
        </button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
