<?php 
session_start();
include 'koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, md5($_POST['password']));

// cek ke admin (berdasarkan username)
$admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE admin_username='$username' AND admin_password='$password'");
if(mysqli_num_rows($admin) > 0){
    session_start();
    $data = mysqli_fetch_assoc($admin);
    $_SESSION['id'] = $data['admin_id'];
    $_SESSION['nama'] = $data['admin_nama'];
    $_SESSION['username'] = $data['admin_username'];
    $_SESSION['status'] = "admin_login";
    header("location:admin/");
    exit;
}

// cek ke customer (boleh pakai username atau email)
$customer = mysqli_query($koneksi, "SELECT * FROM customer WHERE (customer_email='$username' OR customer_username='$username') AND customer_password='$password'");
if(mysqli_num_rows($customer) > 0){
    session_start();
    $data = mysqli_fetch_assoc($customer);
    $_SESSION['id'] = $data['customer_id'];
    $_SESSION['nama'] = $data['customer_nama'];
    $_SESSION['email'] = $data['customer_email'];
    $_SESSION['status'] = "customer_login";
    header("location:index.php");
    exit;
}

// jika tidak ada di keduanya
header("location:login.php?alert=gagal");

exit;
?>
