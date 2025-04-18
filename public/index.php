<?php
ob_start();
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: /auth/login.php");
    exit();
}
// ini namanya Handler 
if (isset($_GET ["page"]) &&  $_GET['page'] == "logout") {
  include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/auth.php");    
}
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
        <h1 class="text-xl font-bold text-center mb-4">Jot Cell</h1>

        
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

    <div class="max-w-sm mx-auto mt-6">
        <h2 class="text-lg font-semibold mb-3">Kategori</h2>
        <div class="grid grid-cols-4 gap-3">
            <a href="pulsa.html" class="bg-blue-100 text-blue-700 p-2 rounded-lg text-center text-sm font-medium">
                Pulsa
            </a>
            <a href="kuota.html" class="bg-green-100 text-green-700 p-2 rounded-lg text-center text-sm font-medium">
                Kuota
            </a>
            <a href="voucher.html" class="bg-yellow-100 text-yellow-700 p-2 rounded-lg text-center text-sm font-medium">
                Voucher
            </a>
            <a href="paket-sms.html" class="bg-red-100 text-red-700 p-2 rounded-lg text-center text-sm font-medium">
                Paket SMS
            </a>
            <a href="token-listrik.html" class="bg-purple-100 text-purple-700 p-2 rounded-lg text-center text-sm font-medium">
                Token Listrik
            </a>
            <a href="game.html" class="bg-indigo-100 text-indigo-700 p-2 rounded-lg text-center text-sm font-medium">
                Game
            </a>
            <a href="streaming.html" class="bg-gray-100 text-gray-700 p-2 rounded-lg text-center text-sm font-medium">
                Streaming
            </a>
            <a href="hiburan.html" class="bg-pink-100 text-pink-700 p-2 rounded-lg text-center text-sm font-medium">
                Hiburan
            </a>
        </div>
    </div>

    <div class="max-w-sm mx-auto mt-6">
    <h2 class="text-lg font-semibold mb-3">Produk</h2>
    <div class="grid grid-cols-1 gap-4">
        <!-- Pulsa -->
        <div class="flex justify-between items-center bg-blue-100 p-4 rounded-lg">
            <div>
                <h3 class="text-blue-700 font-medium">Pulsa</h3>
                <p class="text-sm text-gray-600">Pulsa untuk semua operator</p>
            </div>
            <button onclick="window.location.href='./pesanan.php?product=pulsa';" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-400">
                Pesan
            </button>
        </div>
        <!-- Token PLN -->
        <div class="flex justify-between items-center bg-yellow-100 p-4 rounded-lg">
            <div>
                <h3 class="text-yellow-700 font-medium">Token PLN</h3>
                <p class="text-sm text-gray-600">Token listrik prabayar</p>
            </div>
            <button onclick="window.location.href='./pesanan.php?product=token-pln';" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-400">
                Pesan
            </button>
        </div>
    </div>
</div>

    <div class="overflow-hidden w-full max-w-xs mx-auto relative mt-8 rounded-xl">
        <!-- Wrapper -->
        <div id="slide-container" class="flex transition-transform duration-700 ease-in-out">
            <img src="https://down-id.img.susercontent.com/file/sg-11134201-23010-f8fk9k77f1lv92" 
                 class="w-full flex-shrink-0" alt="Slide 1">
            <img src="https://i.pinimg.com/736x/ee/8c/70/ee8c70d60686d701263191606468bf20.jpg" 
                 class="w-full flex-shrink-0" alt="Slide 2">
            <img src="https://down-id.img.susercontent.com/file/sg-11134201-23010-f8fk9k77f1lv92" 
                 class="w-full flex-shrink-0" alt="Slide 3">
            <!-- Duplikat slide pertama untuk efek seamless -->
            <img src="https://down-id.img.susercontent.com/file/sg-11134201-23010-f8fk9k77f1lv92" 
                 class="w-full flex-shrink-0" alt="Slide 1 Duplicate">
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const slideContainer = document.getElementById("slide-container");
            const slides = slideContainer.children;
            const totalSlides = slides.length;
            let currentIndex = 0;
    
            function nextSlide() {
                currentIndex++;
                slideContainer.style.transition = "transform 0.7s ease-in-out";
                slideContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
    
                if (currentIndex === totalSlides - 1) {
                    setTimeout(() => {
                        slideContainer.style.transition = "none";
                        slideContainer.style.transform = `translateX(0)`;
                        currentIndex = 0;
                    }, 700);
                }
            }
    
            setInterval(nextSlide, 3000);
        });
    </script>

    
    
<div class="flex justify-center mt-8">
    <div class="overflow-hidden w-56 h-64 bg-gray-50 rounded-2xl text-sky-400 flex flex-col justify-end items-center gap-2">
        <svg class="absolute opacity-30 -rotate-12 -bottom-12 -right-12 w-40 h-40 stroke-current" height="100" preserveAspectRatio="xMidYMid meet" viewBox="0 0 100 100" width="100" x="0" xmlns="http://www.w3.org/2000/svg" y="0"></svg>
            <path class="svg-stroke-primary" d="M65.8,46.1V30.3a15.8,15.8,0,1,0-31.6,0V46.1M22.4,38.2H77.6l4,47.3H18.4Z" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="8">
            </path>
        </svg>
        <div class="flex flex-col items-center">
            <p class="text-xl font-extrabold">Discount</p>
            <p class="relative text-xs inline-block after:absolute after:content-[''] after:ml-2 after:top-1/2 after:bg-sky-200 after:w-12 after:h-0.5 before:absolute before:content-[''] before:-ml-14 before:top-1/2 before:bg-sky-200 before:w-12 before:h-0.5">Up to</p>
        </div>
        <span class="font-extrabold text-7xl -skew-x-12 -skew-y-12 -mt-1 mb-5">70%</span>
        <a href="./pesanan.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
              <button class="px-4 py-2 bg-sky-400 text-gray-50 hover:bg-sky-300">Pesan</button>
        </a>
      
        <p class="text-xs mb-1">*Variable prices</p>
    </div>
</div>

<div style="height: 100px;"></div>


<div style="height: 50px;"></div>
    
      
        
        
      
    </div>
    
    
    <!-- Footer -->
    <div class="fixed bottom-0 w-full bg-white py-2 shadow-md flex justify-around text-gray-700">
        <button class="flex flex-col items-center" onclick="window.location.href='./index.php';">
            <span class="text-xl">🏠</span>
            <span class="text-sm">Home</span>
        </button>
        <button class="flex flex-col items-center" onclick="window.location.href='./transaksi.php';">
            <span class="text-xl">🛒</span>
            <span class="text-sm">Transaksi</span>
        </button>
        <button class="flex flex-col items-center" onclick="window.location.href='./historytransaksi.php';">
            <span class="text-xl">📜</span>
            <span class="text-sm">History</span>
        </button>
        <button class="flex flex-col items-center" onclick="window.location.href='./profile.php';">
            <span class="text-xl">⚙️</span>
            <span class="text-sm">Akun</span>
        </button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
