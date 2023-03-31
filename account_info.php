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
    #account-info {
        background-color: #F4F3EE;
    }
</style>

<body>
<div class="container-fluid vh-100 overflow-hidden">
    <div class="row mt-5">
        <div class="col-9 m-auto p-5">
            <div id="account-info" class="row p-4 rounded-3">
                <div class="col-12">
                    <div class="row px-4">
                        <h2 class="text-center">Change Account Info</h2>
                    </div>
                    <div class="row mt-5 px-5">
                        <div class="col-2">
                            <label class="control-label" for="change-username">Username:</label>
                        </div>
                        <div class="col-4 ms-auto me-5">
                            <input class="form-control" id="change-username" name="username" type="text">
                        </div>
                        <div class="col-2">
                            <button id="change-username-send"
                                    class="btn btn-light btn-outline-dark rounded-pill px-4 py-2 float-end"
                            >
                                Change
                            </button>
                        </div>
                    </div>
                    <div class="row mt-5 px-5">
                        <div class="col-2">
                            <label class="control-label" for="change-password">Password:</label>
                        </div>
                        <div class="col-4 ms-auto me-5">
                            <input class="form-control" id="change-password" name="password" type="password">
                        </div>
                        <div class="col-2">
                            <button id="change-password-send"
                                    class="btn btn-light btn-outline-dark rounded-pill px-4 py-2 float-end"
                            >
                                Change
                            </button>
                        </div>
                    </div>
                    <div class="row my-5 px-5">
                        <div class="col-2">
                            <label class="control-label" for="skill-level">Skill Level:</label>
                        </div>
                        <div class="col-4 ms-auto me-5">
                            <select id="skill-level-select" class="form-select" name="skill-level">
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                                <option value="Expert">Expert</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <button id="change-skill-level-send"
                                    class="btn btn-light btn-outline-dark rounded-pill px-4 py-2 float-end"
                            >
                                Change
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button id="delete-account-btn"
                                    class="btn rounded-3 px-4 py-3 btn-light btn-outline-danger mb-3 w-100"
                            >
                                Delete Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="logout-form" method="POST" action="controller_jordan.php">
    <input type="hidden" name="page" value="MainPage">
    <input type="hidden" name="command" value="Logout">
</form>

</body>

<script>
    $("#change-skill-level-send").click(function () {
        $.post("controller_jordan.php",
            {
                page: "MainPage",
                command: "ChangeSkillLevel",
                skill_level: $('#skill-level-select').val()
            },
            function (data) {
                if (data === "1") {
                    alert("Skill level changed successfully");
                } else {
                    alert("There was an error changing your skill level!");
                }
            }
        );
    })

    $("#change-username-send").click(function () {
        $.post("controller_jordan.php",
            {
                page: "MainPage",
                command: "ChangeUsername",
                new_username: $('#change-username').val()
            },
            function (data) {
                if (data === "1") {
                    alert("Username changed successfully");
                } else {
                    alert("Username already exists!");
                }
            }
        );
    })

    $("#change-password-send").click(function () {
        $.post("controller_jordan.php",
            {
                page: "MainPage",
                command: "ChangePassword",
                new_password: $('#change-password').val()
            },
            function (data) {
                if (data === "1") {
                    alert("Password changed successfully");
                } else {
                    alert("There was an error changing your password!");
                }
            }
        );
    })

    $("#delete-account-btn").click(function () {
        $.post("controller_jordan.php",
            {
                page: "MainPage",
                command: "DeleteAccount"
            },
            function (data) {
                if (data === "1") {
                    alert("Account deleted successfully!");
                    $("#logout-form").submit();
                } else {
                    alert("There was a problem deleting your account!");
                }
            }
        );
    })

</script>

</html>