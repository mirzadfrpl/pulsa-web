<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pulsa & Kuota</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>


<body class="bg-gray-200 font-sans text-gray-700">
    <div class="container mx-auto p-8 flex">
        <div class="max-w-md w-full mx-auto mt-32">
            <div class="container flex flex-col justify-center items-center">
                <img src="../public/style/img/Swag Cartoon pfp.jpeg " class="mr-3 w-1/4" alt="Logo" />
                <span class="bg-gradient-to-r text-transparent from-blue-500 to-black bg-clip-text">
                    <h1 class="text-4xl text-center mb-12 font-bold ">Laporkan</h1>
                </span>

            </div>

            <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
                <div class="p-8">
                    <form method="POST" action="../utils/auth.php">
                        <div class="mb-5">
                            <input placeholder="Username" type="text" name="username" class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>

                        <div class="mb-5">
                            <input placeholder="*********" type="password" name="password" class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>

                        <button type="submit" name="login" class="w-full p-3 mt-4 bg-blue-500 text-white rounded shadow hover:bg-blue-600">Login</button>
                    </form>
                </div>

                <?php
                if (isset($_GET['notification'])) {
                    echo $_GET['notification'];
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>