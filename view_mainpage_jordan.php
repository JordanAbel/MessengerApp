<!DOCTYPE html>
<html>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
    #main {
        width: 100vw;
        height: 100vh;
        position: relative;
        display: flex;
        flex-direction: row;
    }
    #menu {
        width: 30%;
        height: 100%;
        position: relative;
    }
    #images-right > img {
        display: block;
        margin-top: 50px;
    }
    #images-right {
        position: absolute;
        right: 40px;
    }
    #results {
        width: 50%;
        height: 100%;
        border-left: 1px solid black;
        border-right: 1px solid black;
    }
    #results-contents {
        position: relative;
        margin-left: 50px;
        padding-top: 100px;
    }
    #results-contents > h2 {
        display: block;
        padding-bottom: 50px;
    }
    #friends-result {
        display: block;
        padding-bottom: 60px;
    }
</style>
<body>

<div id="main">
    <div id="menu">
        <img src="Icons/TRU_Logo.png" width="100%">
        <div id="images-right">
            <img id="search" src="Icons/search.png" width="50px">
            <img id="send" src="Icons/send.png" width="50px">
            <img id="read" src="Icons/email.png" width="50px">  <!-- There was no email icon in the folder so assumed this would be used in its place. -->
            <form id="form" method="POST" action="controller_jordan.php">
                <input type="hidden" name="page" value="MainPage">
                <input type="hidden" name="command" value="Logout">
            </form>
            <img src="Icons/user.png" width="50px" onclick="submitForm()">
        </div>
    </div>
    <div id="results">
        <div id="results-contents">
            <h2>Friends</h2><br>
            <div id='friends-result'></div>
            <h2>Messages</h2><br>
            <h2>Unread Messages</h2><br>
            <div id='unread-messages'></div>
            <h2>Read Messages</h2><br>
        </div>
    </div>
    <div class='modal fade' id='modal-search-friends'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form method='post' action='controller_jordan.php'>
                    <div class='modal-header'>
                        <h2 class='modal-title'>Search Friends</h2>
                    </div>
                    <div class='modal-body'>
                        <div class="input-group">
                            <input type="hidden" name='page' value='MainPage'>
                            <input type="hidden" name='command' value='SearchFriends'>
                            <label class="control-label" for="username">Search:</label>
                            <input
                                    type="text"
                                    class="form-control"
                                    id="search-term" name='term'
                                    placeholder="Enter username or part of username"
                            >
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="input-group">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class='modal fade' id='modal-send-message'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='header'>
                    <h2 class='modal-title'>SendMessage</h2>
                </div>
                <div class='body'>
                    <div class="input-group">
                        <label class="control-label" for="receiver">Receiver:</label>
                        <input
                                type="text"
                                class="form-control"
                                id="receiver"
                                name='receiver'
                                placeholder="Enter the receiver's username"
                        >
                        <label class="control-label" for="message">Message:</label>
                        <input
                                type="text"
                                class="form-control"
                                id="message" name='message'
                                placeholder="Enter a message to send"
                        >
                    </div>
                </div>
                <div class='footer'>
                    <div class="input-group">
                        <button type='button' class="btn btn-outline-danger" data-bs-dismiss='modal'>Cancel</button>
                        <button id='submit-send-message' type='button' class="btn btn-outline-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<?php
function to_table($list) {
    $table = "<table>";
    foreach($list as $value) {
        $table .= "<tr>";
        $table .= "<td>$value</td>";
        $table .= "</tr>";
    }
    $table .= "</table>";
    return $table;
}

if (isset($_SESSION['friends-list'])) {
    $list = $_SESSION['friends-list'];
    $table = to_table($list);
    echo "<script>document.getElementById('friends-result').innerHTML = '$table'</script>";
}
?>

<script>
    function submitForm() {
        document.getElementById("form").submit();
    }

    var timer = setTimeout(timeout, 10000);
    window.addEventListener('mousemove', event_listener_mousemove_or_keydown);
    window.addEventListener('keydown', event_listener_mousemove_or_keydown);

    function event_listener_mousemove_or_keydown() {
        clearTimeout(timer);
        timer = setTimeout(timeout, 10000);
    }
    function timeout() {
        submitForm();
    }

    $("#search").click(function() {
        $("#modal-search-friends").modal('show');
    });

    $('#send').click(function() {
        $('#modal-send-message').modal('show');
    });

    $('#submit-send-message').click(function() {
        $('#modal-send-message').modal('hide');

        $.post("controller_jordan.php",
            {
                page: "MainPage",
                command: "SendMessage",
                receiver: $('#receiver').val(),
                message: $('#message').val()
            },
            function(data) {
                alert(data);
            }
        );
    });

    $('#read').click(function() {
        $.post("controller_jordan.php",
            {
                page: "MainPage",
                command: "ReadMessages"
            },
            function(data) {
                $('#unread-messages').html(data);
            }
        );
    });

    <?php
    if (empty($_SESSION['signedin'])) {
        $display_modal_window = 'none';
        include('view_startpage_jordan_abel.php');
        exit;
    }
    ?>
</script>
</html>
