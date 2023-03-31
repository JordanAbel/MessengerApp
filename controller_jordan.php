<?php
$error_msg_username = '';
$error_msg_username_exists = '';
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
                $_SESSION['skill_level'] = get_skill_level($username);
                include('view_mainpage_jordan.php');
            }
            exit();

        case 'Signup':
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            if (username_exists($username)) {
                $error_msg_username_exists = '* Username Exists!';
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
    $skill_level = $_SESSION['skill_level'];

    switch ($command) {
        case 'Logout':
            session_unset();
            session_destroy();
            $display_modal_window = 'none';
            include('view_startpage_jordan_abel.php');
            exit();
        case 'SearchFriends':
            $search_term = $_POST['search_term'];
            $result = search_friends($username, $search_term);
            echo json_encode($result);
            exit();
        case 'SendMessage':
            $result = save_message($username, $_POST['message'], $skill_level);
            echo "$result";
            exit();
        case 'LoadMessages':
            $result = load_messages();
            echo json_encode($result);
            exit();
        case 'GetUser':
            echo "$username";
            exit();
        case 'ChangeSkillLevel':
            $result = change_skill_level($username, $_POST["skill_level"]);
            echo "$result";
            $_SESSION['skill_level'] = get_skill_level($username);
            exit();
        case 'AddFriend':
            if ($_POST["friend_username"] == $username) {
                $result = 2;
            } else if (username_exists($_POST["friend_username"])) {
                $result = add_friend($username, $_POST["friend_username"]);
            } else {
                $result = 0;
            }
            echo "$result";
            exit();
        case 'LoadFriends':
            $result = get_friends($username);
            echo json_encode($result);
            exit();
        case 'ChangeUsername':
            if (!username_exists($_POST['new_username'])) {
                $result = change_username($username, $_POST['new_username']);
                $username = $_POST['new_username'];
                $_SESSION['username'] = $username;
            } else {
                $result = 0;
            }
            echo "$result";
            exit();
        case 'ChangePassword':
            $result = change_password($username, $_POST['new_password']);
            echo "$result";
            exit();
        case 'DeleteMessage':
            $result = delete_message($_POST["author"], $_POST["message"]);
            echo "$result";
            exit();
        case 'DeleteFriend':
            if (friend_exists($username, $_POST["friend_username"])) {
                $result = delete_friend($username, $_POST["friend_username"]);
            } else {
                $result = 0;
            }
            echo "$result";
            exit();
        case 'DeleteAccount':
            $result = delete_account($username);
            echo "$result";
            exit();
    }
}