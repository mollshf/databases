<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db_tes_catatan";

$conn = mysqli_connect($host, $username, $password, $database);
function read()
{
    global $conn;
    $query = "SELECT * FROM keranjang";
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
        (empty($_POST["id_user"])) ||
        empty($_POST["qty"]) ||
        empty($_POST["total_harga"]) ||
        empty($_POST["status"] && ($_POST["status"] == "TERJUAL") || ($_POST["status"] == "PENDING"))
    ) {
        http_response_code(400);
        $respon = [
            "massage" => "error",
            "status" => "brutal error"
        ];
        return $respon;
    }

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
    // sanitasi

    $id_user = mysqli_escape_string($conn, $_POST["id_user"]);
    $qty = mysqli_escape_string($conn, $_POST["qty"]);
    $total_harga = mysqli_escape_string($conn, $_POST["total_harga"]);
    $status = mysqli_escape_string($conn, $_POST["status"]);



    $query = "INSERT INTO keranjang (id_user, qty, total_harga, status) VALUES ('$id_user', '$qty', '$total_harga', '$status')";

    if (mysqli_query($conn, $query)) {
        http_response_code(200);
        $respon = [
            "massage" => mysqli_affected_rows($conn),
            "status" => "SUCCESS"
        ];
    } else {
        http_response_code(500);
        $respon = [
            "massage" => "gagal",
            "status" => ""
        ];
    }

    $composition = [
        "status" => $respon,
        "data" => "nice"
    ];
    return $composition;
}

function update()
{
    header('Content-Type: application/json');
    global $conn;
    if (
        (empty($_POST["id_keranjang"])) ||
        empty($_POST["qty"]) ||
        empty($_POST["total_harga"]) ||
        empty($_POST["status"] && ($_POST["status"] == "TERJUAL" || $_POST["status"] == "PENDING"))
    ) {
        http_response_code(400);
        $respon = [
            "massage" => "error",
            "status" => "brutal error"
        ];
        return $respon;
    }
    $id_keranjang = mysqli_escape_string($conn, $_POST["id_keranjang"]);
    $qty = mysqli_escape_string($conn, $_POST["qty"]);
    $nama_barang = mysqli_escape_string($conn, $_POST["nama_barang"]);
    $total_harga = mysqli_escape_string($conn, $_POST["total_harga"]);
    $status = mysqli_escape_string($conn, $_POST["status"]);

    $query = "UPDATE keranjang SET qty='$qty', nama_barang = '$nama_barang' total_harga='$total_harga', status ='$status' WHERE id_keranjang = $id_keranjang";

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