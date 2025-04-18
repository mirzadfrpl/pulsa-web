<?php

global $connection;
include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php");

// fungsi untuk login---------------------------------------------------------------------------------------------------------------------------------------------------

if (isset($_POST["login"])) {
    $notification = login($_POST);
    if ($notification) {
        header("Location: ../auth/login.php?notification=" . urlencode($notification));
        exit;
    }
}

function login($data)
{
    session_start();
    $username = $data["username"];
    $password = $data["password"];

    $result = query("SELECT users.*, roles.name as role_name 
        FROM users 
        JOIN roles 
        ON users.role_id = roles.id
        WHERE username = '$username'
    ");

    // Check if user exists
    if (count($result) > 0) {

        // Verify password
        if (password_verify($password, $result[0]["password"])) {
            // Set session data
            $_SESSION["login"] = true;
            $_SESSION["name"] = $result[0]["name"];
            $_SESSION["username"] = $result[0]["username"];
            $_SESSION["role_id"] = $result[0]["role_id"];
            $_SESSION["phone_number"] = $result[0]["phone_number"];

            // Redirect based on role using PHP header
            if ($_SESSION["role_id"] === '1' || $_SESSION["role_id"] === '2') {
                header("Location: /auth/dashboard.php");
                exit(); 
            } else if ($_SESSION["role_id"] === '3') {
                header("Location: /public/index.php"); 
                exit();
            }
        } else {
            // Incorrect password
            return "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Incorrect password',
                    icon: 'error'
                }).then((result) => {
                    window.location.href = '/auth/login.php';
                });
            </script>";
        }
    } else {
        // User not found
        return "<script>
            Swal.fire({
                title: 'Error',
                text: 'User not found',
                icon: 'error'
            }).then((result) => {
                window.location.href = '/auth/login.php';
            });
        </script>";
    }
}

// fungsi untuk logout ---------------------------------------------------------------------------------------------------------------------------------------------------


if (isset($_POST['page']) && $_POST['page'] === 'logout') {
    logout();
}

function logout()
{
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();

    setcookie('id', '', time() - 3600);
    setcookie('key', '', time() - 3600);

    header("Location: /auth/login.php");
    exit;
}


// fungsi untuk edit profile dan password ---------------------------------------------------------------------------------------------------------------------------------------------------


if (isset($_POST['edit_profile'])) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $notification = editProfile($_POST);
    header("Location: /public/profile.php?notification=" . urlencode($notification));
    exit;
}

function editProfile($data)
{
    global $connection;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $name = htmlspecialchars($data['name']);
    $username = htmlspecialchars($data['username']);
    $phone_number = htmlspecialchars($data['phone_number']);
    $current_username = $_SESSION['username'] ?? null;

    if (!$current_username) {
        return "Gagal memperbarui profil: sesi tidak ditemukan.";
    }

    
    $new_password = isset($data['new_password']) ? $data['new_password'] : '';

  
    if (!empty($new_password)) {
        
        if (strlen($new_password) < 6) {
            return "Password baru harus lebih dari 6 karakter.";
        }
       
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    }

   
    if (isset($hashed_password)) {
        
        $stmt = $connection->prepare("UPDATE users SET name = ?, username = ?, phone_number = ?, password = ? WHERE username = ?");
        $stmt->bind_param("sssss", $name, $username, $phone_number, $hashed_password, $current_username);
    } else {
        
        $stmt = $connection->prepare("UPDATE users SET name = ?, username = ?, phone_number = ? WHERE username = ?");
        $stmt->bind_param("ssss", $name, $username, $phone_number, $current_username);
    }

    if ($stmt->execute()) {
       
        $_SESSION['name'] = $name;
        $_SESSION['username'] = $username;
        $_SESSION['phone_number'] = $phone_number;

        if (isset($hashed_password)) {
            $_SESSION['password'] = $hashed_password;
        }

       
        header("Location: /public/profile.php?notification=" . urlencode("Profil berhasil diperbarui!"));
        exit;
    } else {
     
        header("Location: /public/profile.php?notification=" . urlencode("Gagal memperbarui profil: " . $stmt->error));
        exit;
    }
}




