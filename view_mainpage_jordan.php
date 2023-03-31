<?php
//if (empty($_SESSION['signedin'])) {
//    $display_modal_window = 'none';
//    include('view_startpage_jordan_abel.php');
//    exit();
//}
//?>

<!DOCTYPE html>
<html>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<head>
    <meta charset="UTF-8">
    <title>Snowboarder Messenger</title>
</head>

<style>
    #ui-container, #results {
        height: calc(100vh - 7vh);
    }
</style>
<body>
<div class="container-fluid vh-100 border border-dark overflow-hidden">
    <div class="row border border-primary align-content-center" style="height: 7vh">
        <div class="col-1">
            <img class="mx-4" src="Icons/snowboarder.png" width="50px">
        </div>
        <div class="col-11">
            <h1 class="text-end mx-4">Snowboarder Messenger</h1>
        </div>
    </div>

    <div id="ui-container" class="row border border-danger">
        <div class="col-3 border h-auto border-success d-flex flex-column">
            <div class="row m-5">
                <button id="messages" class="btn btn-light btn-outline-dark rounded-3">Message Board</button>
            </div>
            <div class="row m-5 mt-3">
                <button id="account-info" class="btn btn-light btn-outline-dark rounded-3">Change Account Info</button>
            </div>
            <div class="row m-5 mt-3">
                <button id="friends" class="btn btn-light btn-outline-dark rounded-3">Friends</button>
            </div>
            <div class="row m-5 mt-auto">
                <button id="logout" class="btn btn-light btn-outline-dark rounded-3">Log Out</button>
            </div>
        </div>
        <div id="results" class="col-9 border border-warning d-flex flex-column"></div>
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
                                    id="search-term"
                                    name='term'
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

    <form id="logout-form" method="POST" action="controller_jordan.php">
        <input type="hidden" name="page" value="MainPage">
        <input type="hidden" name="command" value="Logout">
    </form>
</div>


</body>

<script>
    function submitForm() {
        document.getElementById("logout-form").submit();
    }

    $("#logout").click(submitForm);

    // var timer = setTimeout(timeout, 1000 * 60 * 3);
    // window.addEventListener('mousemove', event_listener_mousemove_or_keydown);
    // window.addEventListener('keydown', event_listener_mousemove_or_keydown);
    //
    // function event_listener_mousemove_or_keydown() {
    //     clearTimeout(timer);
    //     timer = setTimeout(timeout, 1000 * 60 * 3);
    // }
    // function timeout() {
    //     submitForm();
    // }

    $("body").ready(function () {
        $("#results").load("messages.php")
    });

    $("#messages").click(function () {
        $("#results").load("messages.php")
    })

    $("#friends").click(function () {
        $("#results").load("friends.php")
    })

    $("#account-info").click(function () {
        $("#results").load("account_info.php")
    })

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
</script>
</html>
