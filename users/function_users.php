<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db_tes_catatan";

$conn = mysqli_connect($host, $username, $password, $database);

function read()
{
    global $conn;
    $query = "SELECT * FROM users";
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
        (empty($_POST["username"])) ||
        empty($_POST["email"]) ||
        empty($_POST["password"]) ||
        empty($_POST["hp"])
    ) {
        http_response_code(400);
        $respon = [
            "massage" => "error",
            "status" => "brutal error"
        ];
        return $respon;
    }
    // sanitasi

    $username = mysqli_escape_string($conn, $_POST["username"]);
    $email = mysqli_escape_string($conn, $_POST["email"]);
    $password = mysqli_escape_string($conn, $_POST["password"]);
    $hp = mysqli_escape_string($conn, $_POST["hp"]);



    $query = "INSERT INTO users (username, email, password, hp) VALUES ('$username', '$email', '$password', '$hp')";

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
        (empty($_POST["id_user"]) && $_POST["id_user"] != 0) ||
        empty($_POST["username"]) ||
        empty($_POST["email"]) ||
        empty($_POST["password"]) ||
        empty($_POST["hp"])
    ) {
        http_response_code(400);
        $respon = [
            "massage" => "error",
            "status" => "brutal error"
        ];
        return $respon;
    }

    $id_user = mysqli_escape_string($conn, $_POST["id_user"]);
    $username = mysqli_escape_string($conn, $_POST["username"]);
    $email = mysqli_escape_string($conn, $_POST["email"]);
    $password = mysqli_escape_string($conn, $_POST["password"]);
    $hp = mysqli_escape_string($conn, $_POST["hp"]);



    $query = "UPDATE users SET username='$username', email='$email', password='$password', hp='$hp' WHERE id_user = '$id_user'";

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
            "status" => mysqli_affected_rows($conn)
        ];
    }

    return $respon;
}

function delete()
{

    global $conn;
    // memastikan inputan data yang ingin di hapus tidak kosong
    if (empty($_POST["id_user"])) {
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
    $id = mysqli_escape_string($conn, $_POST["id_user"]);
    // eksekusi
    $query = "DELETE FROM users WHERE id_user = $id";
    mysqli_query($conn, $query);
    return $respon
    ;

}
?>