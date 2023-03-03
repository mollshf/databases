<?php
$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

function read()
{
    global $conn;
    $nama = $_POST["nama"];
    $query = "SELECT * FROM barang WHERE nama_barang LIKE '%$nama%'";
    $result = mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) <= 0) {
        http_response_code(400);
        $respon = [
            "massage" => "succes",
            "status" => "tidak ada data"
        ];
        return $respon;
    }
    while ($row[] = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}


function create()
{
    header('Content-Type: application/json');
    global $conn;
    if (
        (empty($_POST["id_user"]) && $_POST["id_user"] != 0) ||
        empty($_POST["barcode"]) ||
        empty($_POST["kategori"]) ||
        empty($_POST["harga_beli"]) ||
        empty($_POST["harga_jual"]) ||
        empty($_POST["stok"])
    ) {
        http_response_code(400);
        $respon = [
            "massage" => "error",
            "status" => "brutal error"
        ];
        return $respon;
    }
    // sanitasi

    $id_user = mysqli_escape_string($conn, $_POST["id_user"]);
    $barcode = mysqli_escape_string($conn, $_POST["barcode"]);
    $kategori = mysqli_escape_string($conn, $_POST["kategori"]);
    $harga_beli = mysqli_escape_string($conn, $_POST["harga_beli"]);
    $harga_jual = mysqli_escape_string($conn, $_POST["harga_jual"]);
    $stok = mysqli_escape_string($conn, $_POST["stok"]);


    $query = "INSERT INTO barang (id_user, barcode, kategori, harga_beli, harga_jual, stok) VALUES ('$id_user', '$barcode', '$kategori', '$harga_beli', '$harga_jual', '$stok')";

    if (mysqli_query($conn, $query)) {
        http_response_code(200);
        $respon = [
            "massage" => "succes",
            "status" => mysqli_affected_rows($conn)
        ];
    } else {
        http_response_code(500);
        $respon = [
            "massage" => "gagal",
            "status" => "yp"
        ];
    }

    return $respon;
}

function update()
{
    header('Content-Type: application/json');
    global $conn;
    if (
        (empty($_POST["id_user"]) && $_POST["id_user"] != 0) ||
        empty($_POST["barcode"]) ||
        empty($_POST["nama_barang"]) ||
        empty($_POST["kategori"]) ||
        empty($_POST["harga_beli"]) ||
        empty($_POST["harga_jual"]) ||
        empty($_POST["stok"])
    ) {
        http_response_code(400);
        $respon = [
            "massage" => "error",
            "status" => "brutal error"
        ];
        return $respon;
    }

    $id_user = mysqli_escape_string($conn, $_POST["id_user"]);
    $barcode = mysqli_escape_string($conn, $_POST["barcode"]);
    $nama_barang = mysqli_escape_string($conn, $_POST["nama_barang"]);
    $kategori = mysqli_escape_string($conn, $_POST["kategori"]);
    $harga_beli = mysqli_escape_string($conn, $_POST["harga_beli"]);
    $harga_jual = mysqli_escape_string($conn, $_POST["harga_jual"]);
    $stok = mysqli_escape_string($conn, $_POST["stok"]);

    $query = "UPDATE barang SET id_user='$id_user', barcode='$barcode', nama_barang='$nama_barang', kategori='$kategori', harga_beli ='$harga_beli', harga_jual = $harga_jual', stok ='$stok' WHERE id_barang";

    if (mysqli_query($conn, $query)) {
        http_response_code(200);
        $respon = [
            "massage" => "succes",
            "status" => mysqli_affected_rows($conn)
        ];
    } else {
        http_response_code(500);
        $respon = [
            "massage" => "gagal",
            "status" => "yp"
        ];
    }

    return $respon;
}
?>