<?php
$conn = mysqli_connect('localhost', 'root', '', 'snow_messenger');
function username_exists($u) {
    global $conn;
    $sql = "SELECT * FROM Users WHERE Username = '$u'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function username_password_valid($u, $p) {
    global $conn;
    $sql = "SELECT * FROM Users WHERE Username = '$u' AND Password = '$p'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function signup_a_new_user($u, $p, $e) {
    global $conn;
    $current_date = date("Ymd");
    $sql = "INSERT INTO Users VALUES (null, '$u', '$p', '$e', '$current_date')";
    return mysqli_query($conn, $sql);
}

function search_users($search_term) {
    global $conn;
    $sql = "SELECT Username FROM Users WHERE Username LIKE '%$search_term%'";
    $result = mysqli_query($conn, $sql);
    $list = [];
    $i = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $list[$i++] = $row["Username"];
    }

    return $list;
}

function save_message($sender, $receiver, $message) {
    global $conn;
    $current_date = date("Ymd");
    $sql = "INSERT INTO Messages VALUES (NULL, '$sender', '$receiver', '$message', '$current_date', 0)";

    return mysqli_query($conn, $sql);
}

function read_messages($receiver) {
    global $conn;
    $sql = "SELECT * FROM Messages WHERE receiver = '$receiver' AND ReadOrNot = 0";
    $result = mysqli_query($conn, $sql);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    $sql = "UPDATE Messages SET ReadOrNot = 1 WHERE receiver='$receiver' AND ReadOrNot = 0";
    mysqli_query($conn, $sql);

    return $rows;
}