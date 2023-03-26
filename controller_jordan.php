<?php
$error_msg_username = '';
$error_msg_password = '';

if (empty($_POST['page'])) {
    $display_modal_window = 'no-modal-window';
    include('view_startpage_jordan_abel.php');
    exit();
}

require("model_jordan.php");

$page = $_POST['page'];
$command = $_POST['command'];

if ($page == 'StartPage') {
    switch($command) {
        case 'Login':
            $username = $_POST['username'];
            $password = $_POST['password'];
            if (!username_password_valid($username, $password)) {
                $error_msg_username = '* Wrong username, or';
                $error_msg_password = '* Wrong password';
                $display_modal_window = 'signin';
                include('view_startpage_jordan_abel.php');
            } else {
                session_start();
                $_SESSION['signedin'] = 'YES';
                $_SESSION['username'] = $username;
                include('view_mainpage_jordan.php');
            }
            exit();

        case 'Signup':
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            if (username_exists($username)) {
                $error_msg_username = '* Username Exists!';
                $display_modal_window = 'signup';
            } else {
                signup_a_new_user($username, $password, $email);
                $display_modal_window = 'signin';
            }
            include('view_startpage_jordan_abel.php');
            exit();
    }
} elseif ($page == 'MainPage') {
    session_start();

    if (!isset($_SESSION['signedin'])) {
        $display_modal_window = 'no-modal-window';
        include('view_startpage_jordan_abel.php');
        exit();
    }

    $username = $_SESSION['username'];

    switch ($command) {
        case 'Logout':
            session_unset();
            session_destroy();
            $display_modal_window = 'none';
            include('view_startpage_jordan_abel.php');
            exit();
        case 'SearchFriends':
            $search_term = $_POST['term'];
            $list = search_users($search_term);
            $_SESSION['friends-list'] = $list;
            include('view_mainpage_jordan.php');
            exit();
        case 'SendMessage':
            $result = save_message($_SESSION['username'], $_POST['receiver'], $_POST['message']);
            echo "$result";
            exit();
        case 'ReadMessages':
            $result = read_messages($_SESSION['username']);
            var_dump($result);
            exit();
    }
}
