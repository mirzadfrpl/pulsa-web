<?php

ob_start();
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/connection.php");

if (!isset($_SESSION["login"])) {
    header("Location: /auth/login.php");
    exit();
}

$nama_pembeli = $_SESSION['username'];

$sql = "SELECT * FROM pesanan_pulsa WHERE nama_pembeli = ? AND status_pesanan = 'pending' AND waktu_dibuat >= NOW() - INTERVAL 1 HOUR ORDER BY waktu_dibuat DESC";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $nama_pembeli); // "s" berarti string
$stmt->execute();
$result = $stmt->get_result();
$pesanan = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();

  


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

    <!-- Auto Reload Page -->
    <!-- <script>
        setTimeout(function() {
            location.reload();
        }, 5000); 
    </script> -->

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

    <h2 class="mt-5">Pesanan Proses...</h2>

    <?php if (empty($pesanan)): ?>
    <div class="text-center text-gray-500 italic mb-4">
        Pesanan yang diproses sedang tidak ada.
    </div>
<?php else: ?>
    <?php foreach ($pesanan as $p): ?>
        <div class="border p-4 rounded-lg mb-3 bg-white shadow">
            <p><strong>Nama Pembeli:</strong> <?= htmlspecialchars($p['nama_pembeli']) ?></p>
            <p><strong>Nomor HP:</strong> <?= htmlspecialchars($p['no_hp']) ?></p>
            <p><strong>Pesan:</strong> <?= htmlspecialchars($p['pesan']) ?></p>
            <p><strong>Metode Pembayaran:</strong> <?= htmlspecialchars($p['metode_pembayaran']) ?></p>
            
            <?php if (!empty($p['waktu_bayar'])): ?>
                <p><strong>Waktu Pembayaran:</strong> <?= htmlspecialchars($p['waktu_bayar']) ?></p>
            <?php endif; ?>

            <p><strong>Status:</strong> 
                <?php if ($p['status_pesanan'] == 'pending'): ?>
                    <span class="text-yellow-600">Sedang diproses...</span>
                <?php else: ?>
                    <span class="text-green-600">Selesai</span>
                <?php endif; ?>
            </p>
            
            <?php if (!empty($p['pesan_admin'])): ?>
                <p><strong>Pesan Admin:</strong> <?= htmlspecialchars($p['pesan_admin']) ?></p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

    
    <div class="text-center mt-4"></div>
        <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600" onclick="window.location.href='./transaksi-selesai.php';">
            Lihat Transaksi Selesai
        </button>
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
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
