<?php 
include 'koneksi.php';

$id_produk = $_GET['id'];
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'index';

// Ambil data produk (opsional, tapi kamu sudah lakukan)
$data = mysqli_query($koneksi, "SELECT * FROM produk, kategori WHERE kategori_id = produk_kategori AND produk_id = '$id_produk'");
$d = mysqli_fetch_assoc($data);

session_start();

if (isset($_SESSION['keranjang'])) {
    $jumlah_isi_keranjang = count($_SESSION['keranjang']);
    $sudah_ada = 0;

    for ($a = 0; $a < $jumlah_isi_keranjang; $a++) {
        if ($_SESSION['keranjang'][$a]['produk'] == $id_produk) {
            $sudah_ada = 1;
        }
    }

    if ($sudah_ada == 0) {
        $_SESSION['keranjang'][$jumlah_isi_keranjang] = array(
            'produk' => $id_produk,
            'jumlah' => 1
        );
    }

} else {
    $_SESSION['keranjang'][0] = array(
        'produk' => $id_produk,
        'jumlah' => 1
    );
}

// Atur arah redirect secara aman
switch ($redirect) {
    case "index":
        $r = "index.php";
        break;
    case "detail":
        $r = "produk_detail.php?id=" . $id_produk;
        break;
    case "keranjang":
        $r = "keranjang.php";
        break;
    default:
        $r = "index.php"; // fallback jika redirect tidak dikenal
        break;
}

header("Location: " . $r);
exit;
?>
