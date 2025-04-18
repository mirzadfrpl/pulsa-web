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
    <title>Aplikasi Pulsa & Kuota - Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <h1 class="text-xl font-bold text-center mb-4">Danish Cell</h1>

        

<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center mb-4">Profil Pengguna</h2>
    <div class="flex flex-col items-center">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/22/Gibran_Rakabuming_2024_official_portrait.jpg/1200px-Gibran_Rakabuming_2024_official_portrait.jpg" alt="Profile Picture" class="w-24 h-24 rounded-full mb-4">
        <p class="text-lg font-semibold"><?= $_SESSION['name'] ?></p>
        <p class="text-gray-600">Role: <?= $_SESSION['role_id'] ?></p>
        <p class="text-gray-600">Nomor HP: <?= $_SESSION['phone_number']?? 'No Hp Tidak Ada' ?></p>
    </div>
    <div class="mt-6">
        <a href="./editprofile.php" class="block text-center bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Edit Profil
        </a>
        <form action="../utils/auth.php" method="POST" class="text-center mt-4">
            <button class="px-4 py-2 bg-sky-400 text-gray-50 hover:bg-sky-300" name="page" value="logout">
                Logout
            </button>
        </form>

        <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) : ?>
            <a href="../auth/dashboard.php">
            <button class="mt-2 w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg text-sm">
                Admin Only Button
            </button>
            </a>
        <?php endif; ?>


    </div>
</div>


    <div class="overflow-hidden w-full max-w-xs mx-auto relative mt-8 rounded-xl">
        <!-- Wrapper -->
        <div id="slide-container" class="flex transition-transform duration-700 ease-in-out">
            <img src="https://down-id.img.susercontent.com/file/cf881ab113e6dfe3eba1515f168af7ee" 
                 class="w-full flex-shrink-0" alt="Slide 1">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJJfbvQWmV0FB4hZpQNGSUNj8j5ah6qX-Alw&s" 
                 class="w-full flex-shrink-0" alt="Slide 2">
            <img src="https://down-id.img.susercontent.com/file/cf881ab113e6dfe3eba1515f168af7ee" 
                 class="w-full flex-shrink-0" alt="Slide 3">
            <!-- Duplikat slide pertama untuk efek seamless -->
            <img src="https://down-id.img.susercontent.com/file/cf881ab113e6dfe3eba1515f168af7ee" 
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

    
    
  

<div style="height: 100px;"></div>
</div>
    
      
        
        
      
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
    


    <?php if (isset($_GET['notification'])): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= urldecode($_GET['notification']) ?>'
        });
    </script>
    <?php endif; ?>

    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
