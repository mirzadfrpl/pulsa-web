<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php");

if (!isset($_SESSION["login"])) {
    header("Location: /auth/login.php");
    exit();
}
$sql = "SELECT * FROM pesanan_pulsa WHERE waktu_dibuat >= NOW() - INTERVAL 1 HOUR";
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$pesanan = [];
while ($row = $result->fetch_assoc()) {
    $pesanan[] = $row;
}

$stmt->close();




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="./output.css" rel="stylesheet">
</head>
<body>

<div class="sidebar">

<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
<div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
    <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
        </button>
        <a href="" class="flex ms-2 md:me-24">
       <img src="data:image/png;base64,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" class="w-16 m-5" alt="">
        <span class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap dark:text-white">Dashboard Cell</span>
        </a>
    </div>
    <div class="flex items-center">
        <div class="flex items-center ms-3">
            <div>
            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
            </button>
            </div>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
            <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                <?= $_SESSION['name'] ?>
                </p>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                bro@mail.com
                </p>
            </div>
            <ul class="py-1" role="none">
                <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                </li>
                <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                </li>
                <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Earnings</a>
                </li>
                <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
                </li>
            </ul>
            </div>
        </div>
        <button type="button" data-dropdown-toggle="language-dropdown-menu" class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-gray-900 dark:text-white rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
<svg class="w-5 h-5 rounded-full me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 3900 3900"><path fill="#b22234" d="M0 0h7410v3900H0z"/><path d="M0 450h7410m0 600H0m0 600h7410m0 600H0m0 600h7410m0 600H0" stroke="#fff" stroke-width="300"/><path fill="#3c3b6e" d="M0 0h2964v2100H0z"/><g fill="#fff"><g id="d"><g id="c"><g id="e"><g id="b"><path id="a" d="M247 90l70.534 217.082-184.66-134.164h228.253L176.466 307.082z"/><use xlink:href="#a" y="420"/><use xlink:href="#a" y="840"/><use xlink:href="#a" y="1260"/></g><use xlink:href="#a" y="1680"/></g><use xlink:href="#b" x="247" y="210"/></g><use xlink:href="#c" x="494"/></g><use xlink:href="#d" x="988"/><use xlink:href="#c" x="1976"/><use xlink:href="#e" x="2470"/></g></svg>
English (US)
</button>
<!-- Dropdown -->
<div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700" id="language-dropdown-menu">
<ul class="py-2 font-medium" role="none">
  <li>
    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
      <div class="inline-flex items-center">
        <svg aria-hidden="true" class="h-3.5 w-3.5 rounded-full me-2" xmlns="http://www.w3.org/2000/svg" id="flag-icon-css-us" viewBox="0 0 512 512"><g fill-rule="evenodd"><g stroke-width="1pt"><path fill="#bd3d44" d="M0 0h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0z" transform="scale(3.9385)"/><path fill="#fff" d="M0 10h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0z" transform="scale(3.9385)"/></g><path fill="#192f5d" d="M0 0h98.8v70H0z" transform="scale(3.9385)"/><path fill="#fff" d="M8.2 3l1 2.8H12L9.7 7.5l.9 2.7-2.4-1.7L6 10.2l.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7L74 8.5l-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 7.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 24.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 21.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 38.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 35.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 52.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 49.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 66.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 63.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9z" transform="scale(3.9385)"/></g></svg>              
        English (US)
      </div>
    </a>
  </li>
  <li>
    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
      <div class="inline-flex items-center">
        <svg class="h-3.5 w-3.5 rounded-full me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" id="flag-icon-css-de" viewBox="0 0 512 512"><path fill="#ffce00" d="M0 341.3h512V512H0z"/><path d="M0 0h512v170.7H0z"/><path fill="#d00" d="M0 170.7h512v170.6H0z"/></svg>
        Indonesia
      </div>
    </a>
  </li>
  </li>
</ul>
</div>
<button data-collapse-toggle="navbar-language" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-language" aria-expanded="false">
<span class="sr-only">Open main menu</span>
<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
</svg>
</button>
        </div>
    </div>
</div>


</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
<div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
    <ul class="space-y-2 font-medium">
        <li>
            <a href="../public/dashboard.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
            </svg>
            <span class="ms-3">Dashboard</span>
            </a>
        </li>
        
        <li>
            <a href="./register.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
            </svg>
            <span class="flex-1 ms-3 whitespace-nowrap">Info User</span>
            </a>
        </li>
    </ul>
    <div id="dropdown-cta" class="p-4 mt-6 rounded-lg bg-blue-50 dark:bg-blue-900" role="alert">
 <div class="flex items-center mb-3">
    <span class="bg-orange-100 text-orange-800 text-sm font-semibold me-2 px-2.5 py-0.5 rounded dark:bg-orange-200 dark:text-orange-900">Beta</span>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 inline-flex justify-center items-center w-6 h-6 text-blue-900 rounded-lg focus:ring-2 focus:ring-blue-400 p-1 hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-400 dark:hover:bg-blue-800" data-dismiss-target="#dropdown-cta" aria-label="Close">
       <span class="sr-only">Close</span>
       <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
       </svg>
    </button>
 </div>
 <p class="mb-3 text-sm text-blue-800 dark:text-blue-400">
    Website Ini masih dalam tahap pengembangan
 </p>
 <a class="text-sm text-blue-800 underline font-medium hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" href="#">Turn new navigation off</a>
</div>
</div>
</div>
</aside>

        <div class="p-4 sm:ml-64">

        <main class="ml-60 pt-16 max-h-screen overflow-auto">
    <div class="px-6 py-8">
      <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-3xl p-8 mb-5">
          <h1 class="text-3xl font-bold mb-10"> Admin Panel</h1>
          <div class="flex items-center justify-between">
            <div class="flex items-stretch">
              <div class="text-gray-400 text-xs">Website<br>Pulsa & Kuota</div>
              <div class="h-100 border-l mx-4"></div>
              <div class="flex flex-nowrap -space-x-3">
                <div class="h-9 w-9">
                  <img class="object-cover w-full h-full" src="data:image/png;base64,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">
                </div>
              </div>
            </div>
            <div class="flex items-center gap-x-2">
              <a href="../public/index.php">
              <button type="button" class="m-10 p-10 inline-flex items-center justify-center h-9 px-5 rounded-xl bg-gray-900 text-gray-300 hover:text-white text-sm font-semibold transition">
                web Pulsa
              </button>
              </a>
            </div>
          </div>

            <!-- Success message with SweetAlert -->
  <?php if (isset($_GET['update']) && $_GET['update'] == 'success'): ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Pesan sudah dikirim ke client',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>


          <h1 class="text-xl font-bold text-center mb-4">Dashboard Admin</h1>

<h2 class="text-lg font-semibold mb-4 mt-10">Riwayat Pesanan 1 jam Terakhir</h2>

<?php foreach ($pesanan as $p): ?>
<form action="../utils/update_status.php" method="POST" class="border p-4 rounded-lg mb-3 bg-white shadow">
    <p><strong>Nama Pembeli:</strong> <?= htmlspecialchars($p['nama_pembeli']) ?></p>
    <p><strong>Nomor HP:</strong> <?= htmlspecialchars($p['no_hp']) ?></p>
    <p><strong>Pesan:</strong> <?= htmlspecialchars($p['pesan']) ?></p>
    <p><strong>Metode Pembayaran:</strong> <?= htmlspecialchars($p['metode_pembayaran']) ?></p>
    <!-- <p><strong>Waktu Pembayaran:</strong> <?= htmlspecialchars($p['waktu_bayar']) ?></p> -->
    <p><strong>Status:</strong> 
        <span class="text-<?= $p['status_pesanan'] == 'pending' ? 'yellow-600' : 'green-600' ?>">
            <?= ucfirst($p['status_pesanan']) ?>
        </span>
    </p>

    <div class="mb-4">
        <label for="status_pesanan" class="block text-sm font-medium text-gray-700">Ubah Status Pesanan</label>
        <select name="status_pesanan" id="status_pesanan" class="block w-full mt-1 p-2 border border-gray-300 rounded-md">
            <option value="pending" <?= $p['status_pesanan'] == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="selesai" <?= $p['status_pesanan'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="pesan_admin" class="block text-sm font-medium text-gray-700">Pesan Admin</label>
        <textarea name="pesan_admin" id="pesan_admin" rows="3" class="block w-full mt-1 p-2 border border-gray-300 rounded-md"><?= htmlspecialchars($p['pesan_admin']) ?></textarea>
    </div>

    <input type="hidden" name="id_pesanan" value="<?= $p['id'] ?>">
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Perbarui</button>
</form>
<?php endforeach; ?>

        

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>