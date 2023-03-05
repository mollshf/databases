<?php
$conn = mysqli_connect("localhost", "root", "", "db_tes_catatan");

function read()
{
    global $conn;
    $query = "SELECT * FROM barang";
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
    $nama_barang = mysqli_escape_string($conn, $_POST["nama_barang"]);
    $barcode = mysqli_escape_string($conn, $_POST["barcode"]);
    $kategori = mysqli_escape_string($conn, $_POST["kategori"]);
    $harga_beli = mysqli_escape_string($conn, $_POST["harga_beli"]);
    $harga_jual = mysqli_escape_string($conn, $_POST["harga_jual"]);
    $stok = mysqli_escape_string($conn, $_POST["stok"]);


    $query = "INSERT INTO barang (id_user, barcode, nama_barang, kategori, harga_beli, harga_jual, stok) VALUES ('$id_user', '$barcode', '$nama_barang', '$kategori', '$harga_beli', '$harga_jual', '$stok')";

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
    $composition = [
        "status" => $respon,
        "data" => $query
    ];
    return $composition;
}

function update()
{
    header('Content-Type: application/json');
    global $conn;
    if (
        (empty($_POST["id_user"]) && $_POST["id_user"] != 0) ||
        empty($_POST["id_barang"]) ||
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
    $id_barang = mysqli_escape_string($conn, $_POST["id_barang"]);
    $nama_barang = mysqli_escape_string($conn, $_POST["nama_barang"]);
    $kategori = mysqli_escape_string($conn, $_POST["kategori"]);
    $harga_beli = mysqli_escape_string($conn, $_POST["harga_beli"]);
    $harga_jual = mysqli_escape_string($conn, $_POST["harga_jual"]);
    $stok = mysqli_escape_string($conn, $_POST["stok"]);

    $query = "UPDATE barang SET id_user='$id_user', barcode='$barcode', nama_barang='$nama_barang', kategori='$kategori', harga_beli ='$harga_beli', harga_jual = '$harga_jual', stok ='$stok' WHERE id_barang = $id_barang";

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

function delete()
{

    global $conn;
    // memastikan inputan data yang ingin di hapus tidak kosong
    if (empty($_POST["id_barang"])) {
        $respon = [
            "message" => "tolong input id barang yang ingin di hapus",
            "status" => "FAILED"
        ];
    } else {
        $affectedRows = mysqli_affected_rows($conn);
        $respon = [
            "message" => "Data berhasil di hapus '$affectedRows'",
            "status" => "SUCCESS"
        ];
    }
    // sanitasi
    $id = mysqli_escape_string($conn, $_POST["id_barang"]);
    // eksekusi
    $query = "DELETE FROM barang WHERE id_barang = $id";
    mysqli_query($conn, $query);
    return $respon
    ;

}
?>