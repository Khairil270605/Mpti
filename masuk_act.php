<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

session_start(); // pastikan session dimulai

// menangkap data yang dikirim dari form
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, md5($_POST['password']));

// 1. Cek ke tabel admin (berdasarkan username)
$admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE admin_username='$username' AND admin_password='$password'");
$cek_admin = mysqli_num_rows($admin);

// Jika ditemukan sebagai admin
if($cek_admin > 0){
    $data = mysqli_fetch_assoc($admin);

    // Buat session untuk admin
    $_SESSION['id'] = $data['admin_id'];
    $_SESSION['nama'] = $data['admin_nama'];
    $_SESSION['username'] = $data['admin_username'];
    $_SESSION['status'] = "login";

    header("location:admin/");
    exit;
}

// 2. Cek ke tabel customer (berdasarkan email)
$customer = mysqli_query($koneksi, "SELECT * FROM customer WHERE customer_email='$username' AND customer_password='$password'");
$cek_customer = mysqli_num_rows($customer);

// Jika ditemukan sebagai customer
if($cek_customer > 0){
    $data = mysqli_fetch_assoc($customer);

    // Hapus session admin agar tidak bentrok
    unset($_SESSION['id']);
    unset($_SESSION['nama']);
    unset($_SESSION['username']);
    unset($_SESSION['status']);

    // Buat session untuk customer
    $_SESSION['customer_id'] = $data['customer_id'];
    $_SESSION['customer_status'] = "login";

    header("location:customer.php");
    exit;
}

// Jika tidak ditemukan di keduanya
header("location:masuk.php?alert=gagal");
exit;
?>
