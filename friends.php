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
    #search-send:hover {
        filter: invert(60%);
        cursor: pointer;
    }
</style>

<body>
<div class="container-fluid overflow-auto">
    <div class="row py-5">
        <div class="col-9 m-auto my-5 border border-dark rounded-3 p-3">
            <div class="row">
                <div class="col-12 mb-3">
                    <h1 class="text-center">Friends List</h1>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-12">
                    <button id="delete-friend-btn"
                            class="btn rounded-3 px-4 py-3 btn-light btn-outline-danger mb-3"
                    >
                        Delete Friend
                    </button>
                    <button id="add-friend-btn"
                            class="btn rounded-3 px-4 py-3 btn-light btn-outline-dark mb-3 float-end"
                    >
                        Add Friend
                    </button>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-4">
                    <h5>Enter Friends Username:</h5>
                </div>
                <div class="col-6 ms-auto">
                    <input id="friend-username" class="form-control" name="friend">
                </div>
                <div class="col-1">
                    <img id="search-send" src="Icons/search.png" width="35px">
                </div>
            </div>
            <div class="row">
                <div id="friends-result" class="col-12"></div>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    $("body").ready(load_friends);
    $("#add-friend-btn").click(add_friend);
    $("#delete-friend-btn").click(delete_friend);
    $("#search-send").click(search_friends);

    function create_table(data) {
        data = JSON.parse(data);
        let html = "<table class='table table-bordered'>";
        html += "<th>Friends Username</th>";

        for (let row in data) {
            html += '<tr>';
            html += `<td>${data[row]}</td>`;
            html += '</tr>';
        }

        html += '</table>';

        return html;
    }

    function load_friends() {
        $.post("controller_jordan.php",
            {
                page: "MainPage",
                command: "LoadFriends"
            },
            function (data) {
                let html = create_table(data);
                $("#friends-result").html(html);
            }
        );
    }

    function add_friend() {
        let friendUsername = $("#friend-username").val();

        if (friendUsername === "") {
            alert("Please enter a username to add!");
        } else {
            $.post("controller_jordan.php",
                {
                    page: "MainPage",
                    command: "AddFriend",
                    friend_username: $("#friend-username").val()
                },
                function (data) {
                    if (data === "0") {
                        alert("Username does not exist!");
                    } else if (data === "2") {
                        alert("Unable to add current user as friend!");
                    } else {
                        alert("Friend was added successfully!");
                        load_friends();
                    }
                }
            );
        }
    }

    function delete_friend() {
        let friendUsername = $("#friend-username").val();

        if (friendUsername === "") {
            alert("Please enter a username to delete!");
        } else {
            $.post("controller_jordan.php",
                {
                    page: "MainPage",
                    command: "DeleteFriend",
                    friend_username: friendUsername
                },
                function (data) {
                    if (data === "0") {
                        alert("Username not in friends list");
                    } else {
                        alert("Friend was deleted successfully!");
                        load_friends();
                    }
                }
            );
        }
    }

    function search_friends() {
        $.post("controller_jordan.php",
            {
                page: "MainPage",
                command: "SearchFriends",
                search_term: $("#friend-username").val()
            },
            function (data) {
                let html = create_table(data);
                $("#friends-result").html(html);
            }
        );
    }


</script>

</html>