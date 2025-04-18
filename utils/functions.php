<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/connection.php");

function query($query)
{
    global $connection;
    $result = mysqli_query($connection, $query);

    $rows = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }

    return $rows;
}

function tambah($data, $table, $fields)
{
    global $connection;

    $columns = [];
    $values = [];

    foreach ($fields as $field) {
        if (isset($data[$field])) {
            if ($field === 'password') {
                $hashedPassword = password_hash($data[$field], PASSWORD_DEFAULT);
                $columns[] = $field;
                $values[] = "'" . $hashedPassword . "'";
            } else {
                $columns[] = $field;
                $values[] = "'" . htmlspecialchars($data[$field]) . "'";
            }
        }
    }

    if (isset($data['nik'])) {
        $nik = htmlspecialchars($data["nik"]);
        $checkNIK = query("SELECT * FROM users WHERE nik='$nik'");

        if (count($checkNIK) > 0) {
            return -1;
        }
    }

    if (isset($_FILES['gambar'])) {
        $image = upload();
        if ($image === false) {
            return false;
        }
        $columns[] = 'gambar';
        $values[] = "'" . $image . "'";
    }

    $query = "INSERT INTO $table (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ")";
    $insert = mysqli_query($connection, $query);
    return mysqli_affected_rows($connection);
}

function upload()
{
    $originalName = $_FILES['gambar']['name'];
    $filesize = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    $validExtension = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $originalName);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $validExtension)) {
        echo "<script>alert('File bukan gambar');</script>";
        return false;
    }

    if ($filesize > 1000000) {
        echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
        return false;
    }

    $imgFolder = 'img/';
    if (!is_dir($imgFolder)) {
        mkdir($imgFolder, 0755, true);
    }
    $newFilename = uniqid() . '.' . $ekstensiGambar;
    move_uploaded_file($tmpName, $imgFolder . $newFilename);

    return $newFilename;
}

function handleFormSubmit($data, $table)
{
    global $connection;

    $fields = ['nik', 'username', 'name', 'phone_number', 'password', 'role_id'];
    $values = [];

    foreach ($fields as $field) {
        $values[$field] = htmlspecialchars($data[$field] ?? '');
    }

    if (empty($values['password'])) {
        echo "<script>alert('Password harus diisi');</script>";
        return;
    }

    $values['password'] = password_hash($values['password'], PASSWORD_DEFAULT);

    $columns = implode(', ', array_keys($values));
    $vals = implode("', '", array_values($values));
    $query = "INSERT INTO $table ($columns) VALUES ('$vals')";

    if (mysqli_query($connection, $query)) {
        echo "<script>alert('User berhasil ditambahkan'); window.location.href = '../public/index.php?page=users';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan user');</script>";
    }
}

