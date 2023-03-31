<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<head>
    <meta charset="UTF-8">
    <title>Snowboarder Messenger</title>
</head>

<style>
    #post-message-input {
        min-height: 150px;
        resize: none;
    }

    #refresh-messages:hover {
        animation: rotate 2s infinite;
        filter: invert(60%);
        cursor: pointer;
    }

    #post-message, #message {
        background-color: #F4F3EE;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg)
        }
        100% {
            transform: rotate(360deg)
        }
    }
</style>

<body>
<div class="container-fluid overflow-auto">
    <div id="top-banner" class="row text-center m-5 mb-3"></div>
    <div class="row">
        <div class="col-9 m-auto p-5">
            <div id="post-message" class="row p-4 rounded-3 shadow">
                <div class="col-12">
                    <div class="row px-4">
                        <h2>Post a message:</h2>
                    </div>
                    <div class="row px-5 py-3">
                    <textarea id="post-message-input"
                              name="post-message-input"
                              placeholder="Type your message here"
                              class="rounded-3"
                    ></textarea>
                    </div>
                </div>
            </div>
            <div class="row float-end mt-4">
                <div class="col-2">
                    <button id="post-message-send"
                            class="btn btn-light btn-outline-dark rounded-pill px-4 py-3"
                    >
                        Post
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="messages" class="row my-5">
        <div class="col-9 m-auto p-5">
            <div class="row">
                <div class="col-6">
                    <h2 class="mb-5">Messages</h2>
                </div>
                <div class="col-6 text-end">
                    <img id="refresh-messages" src="Icons/refresh.png" width="50px">
                </div>
            </div>
            <div id="messages-container" class="container-fluid"></div>
        </div>
    </div>
</div>
</body>

<script>
    $("body").ready(load_messages);
    $("body").ready(display_username);
    $("#refresh-messages").click(load_messages);

    $('#post-message-send').click(function() {
        if ($('#post-message-input').val() !== "") {
            $.post("controller_jordan.php",
                {
                    page: "MainPage",
                    command: "SendMessage",
                    message: $('#post-message-input').val()
                },
                function (data) {
                    if (data === "1") {
                        alert("Message sent successfully");
                        $('#post-message-input').val("");
                    } else {
                        alert("There was an error sending your message!");
                    }
                }
            );
        } else {
            alert("Message cannot be empty!");
        }

    });

    function load_messages() {
        $.post("controller_jordan.php",
            {
                page: "MainPage",
                command: "LoadMessages"
            },
            function (data) {
                show_messages(data);
            }
        );
    }

    function display_username() {
        $.post("controller_jordan.php",
            {
                page: "MainPage",
                command: "GetUser"
            },
            function (data) {
                let html = `<h2>Welcome back ${data}!</h2>`;
                $("#top-banner").html(html);
            }
        );
    }

    function show_messages(data) {
        data = JSON.parse(data);
        let html = "";

        for (let row in data) {
            let author = data[row]["Author"];
            let skillLevel = data[row]["Skill_level"];
            let message = data[row]["Message"];

            html += '<div id="message" class="row p-4 rounded-3 mb-5 shadow">';
            html += '<div class="col-12">';
            html += '<div class="row px-4">';
            html += '<div class="col-6">';
            html += `<h4>${author}</h4>`;
            html += '</div>';
            html += '<div class="col-6 text-end">';
            html += `<h4>Skill Level: <b>${skillLevel}</b></h4>`;
            html += '</div>';
            html += '</div>';
            html += '<div class="row px-5 py-3">';
            html += `<div class='rounded-3 border border-dark' style="min-height: 150px; background-color: white">${message}</div>`;
            html += '</div>';
            html += '<div class="row px-5 pt-3">';
            html += '<div class="col-12 text-end">';
            html += `<button class="btn rounded-3 px-4 py-3 btn-light btn-outline-danger mb-3" onclick="delete_message(${row})">Delete</button>`;
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
        }

        $("#messages-container").html(html);
    }

    function delete_message(row) {
        $.post("controller_jordan.php",
            {
                page: "MainPage",
                command: "LoadMessages"
            },
            function (data) {
                data = JSON.parse(data);

                let author = data[row]["Author"];
                let message = data[row]["Message"];

                $.post("controller_jordan.php",
                    {
                        page: "MainPage",
                        command: "DeleteMessage",
                        author: author,
                        message: message
                    },
                    function () {
                        load_messages();
                    }
                );
            }
        );
    }

</script>

</html>
