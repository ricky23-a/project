<?php
session_start();

include "../config.php"; // File koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['InputUserName']);
    $password = trim($_POST['InputPassword']);

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, nama, username, sandi, role FROM akun WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            echo "Username : " . $user['username'] . '\n';
            if ($password === $user['sandi']) {
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['admin'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['success'] = "Selamat datang, " . $user['nama'] . "!";
                header("Location: dashboard.php"); // Redirect ke halaman dashboard
                exit();
            } else {
                $_SESSION['error'] = "Password salah!";
            }
        } else {
            $_SESSION['error'] = "Username tidak ditemukan!";
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Semua field harus diisi!";
    }
}
header("Location: ../index.php"); // Redirect kembali ke halaman login jika gagal
exit();
?>