<?php
$conn = mysqli_connect('localhost', 'w3jabel', 'w3jabel136', 'C354_w3jabel');
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

function friend_exists($u, $friend_username) {
    global $conn;
    $sql = "SELECT * FROM Friends WHERE Username = '$u' AND FriendUsername = '$friend_username'";
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
    $sql = "INSERT INTO Users VALUES (null, '$u', '$p', '$e', '$current_date', 'Beginner')";
    return mysqli_query($conn, $sql);
}

function search_friends($u, $search_term) {
    global $conn;
    $sql = "SELECT * FROM Friends WHERE Username LIKE '%$u%' AND FriendUsername LIKE '%$search_term%'";
    $result = mysqli_query($conn, $sql);
    $list = [];
    $i = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $list[$i++] = $row["FriendUsername"];
    }

    return $list;
}

function add_friend($u, $f) {
    global $conn;
    $sql = "INSERT INTO Friends VALUES (null, '$u', '$f')";
    return mysqli_query($conn, $sql);
}

function get_friends($u) {
    global $conn;
    $sql = "SELECT * FROM Friends WHERE Username LIKE '%$u%'";
    $result = mysqli_query($conn, $sql);
    $list = [];
    $i = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $list[$i++] = $row["FriendUsername"];
    }

    return $list;
}

function save_message($sender, $message, $skill_level) {
    global $conn;
    $current_date = date("Ymd");
    $sql = "INSERT INTO Messages VALUES (NULL, '$sender', '$message', '$current_date', '$skill_level')";

    return mysqli_query($conn, $sql);
}

function load_messages() {
    global $conn;
    $sql = "SELECT * FROM Messages ORDER BY Id DESC";
    $result = mysqli_query($conn, $sql);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function get_skill_level($u) {
    global $conn;
    $sql = "SELECT Skill_level FROM Users WHERE Username = '$u'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return $row["Skill_level"];
}

function change_skill_level($u, $skill_level) {
    global $conn;
    $sql = "UPDATE Users SET Skill_level = '$skill_level' WHERE Username = '$u'";
    return mysqli_query($conn, $sql);
}

function change_username($u, $new_username) {
    global $conn;
    $sql = "UPDATE Users SET Username = '$new_username' WHERE Username = '$u'";
    return mysqli_query($conn, $sql);
}

function change_password($u, $new_password) {
    global $conn;
    $sql = "UPDATE Users SET Password = '$new_password' WHERE Username = '$u'";
    return mysqli_query($conn, $sql);
}

function change_email($u, $new_email) {
    global $conn;
    $sql = "UPDATE Users SET Email = '$new_email' WHERE Username = '$u'";
    return mysqli_query($conn, $sql);
}

function delete_message($author, $message) {
    global $conn;
    $sql = "DELETE FROM Messages WHERE Author = '$author' AND Message = '$message'";
    return mysqli_query($conn, $sql);
}

function delete_friend($u, $friend_username) {
    global $conn;
    $sql = "DELETE FROM Friends WHERE Username = '$u' AND FriendUsername = '$friend_username'";
    return mysqli_query($conn, $sql);
}

function delete_account($u) {
    global $conn;
    $sql = "DELETE FROM Users WHERE Username = '$u'";
    return mysqli_query($conn, $sql);
}
