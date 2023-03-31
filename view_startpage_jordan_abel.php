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
    #banner {
        background-color: #2F323A;
        color: #F4F3EE;
    }
    #container {
        background: #83a4d4;
        background: -webkit-linear-gradient(to right, #b6fbff, #83a4d4);
        background: linear-gradient(to right, #b6fbff, #83a4d4);
    }
    #signup-login {
        background-color: #F4F3EE;
    }
    #logo {
        filter: invert(100%);
    }
</style>

<body>
<div id="container" class="container-fluid vh-100 overflow-hidden">
    <div id="banner" class="row align-content-center shadow" style="height: 7vh">
        <div class="col-1">
            <img id="logo" class="mx-4" src="Icons/snowboarder.png" width="50px">
        </div>
        <div class="col-11">
            <h1 class="text-end mx-4">Snowboarder Messenger</h1>
        </div>
    </div>

    <div class="row h-100">
        <div id="signup-login"
             class="col-8 position-absolute top-50 start-50 translate-middle rounded-3 shadow h-50">
            <div class="row h-25 text-center align-content-center">
                <h1 class="mt-5">Welcome to Snowboarder Messenger!</h1>
            </div>
            <div class="row h-50 text-center align-content-center">
                <h3>Please Log In or Sign Up</h3>
            </div>
            <div class="row">
                <div class="col-6 text-center">
                    <button id="login-btn"
                            class="btn rounded-pill px-4 py-3 btn-light btn-outline-dark"
                            data-bs-toggle="modal"
                            data-bs-target="#login-modal-window"
                    >
                        Log In
                    </button>
                </div>
                <div class="col-6 text-center">
                    <button id="signup-btn"
                            class="btn rounded-pill px-4 py-3 btn-light btn-outline-dark"
                            data-bs-toggle="modal"
                            data-bs-target="#signup-modal-window"
                    >
                        Sign Up
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class='modal fade' id='login-modal-window'>
        <div class='modal-dialog modal-dialog-centered modal-lg'>
            <div class='modal-content p-5'>
                <form id='login-form' method="post" action="controller_jordan.php">
                    <div class='header'>
                        <h2 class='modal-title text-center p-3'>Log In to your Account</h2>
                    </div>
                    <div class='body'>
                        <div class="input-group">
                            <div class="row m-4 w-100">
                                <input type='hidden' name='page' value='StartPage'>
                                <input type='hidden' name='command' value='Login'>
                                <div class="col-6">
                                    <label class="control-label" for="login-username">Username: </label>
                                </div>
                                <div class="col-6">
                                    <input class="form-control" id="login-username" name="username" type="text">
                                    <span><?php echo $error_msg_username ?></span>
                                </div>
                            </div>
                            <div class="row m-4 w-100">
                                <div class="col-6">
                                    <label class="control-label" for="login-password">Password: </label>
                                </div>
                                <div class="col-6">
                                    <input class="form-control" id="login-password" name="password" type="password">
                                    <span><?php echo $error_msg_password ?></span>
                                </div>
                            </div>
                            <input type="hidden" name="email" value="">
                        </div>
                    </div>
                    <div class='footer'>
                        <div class="input-group">
                            <div class="row m-4 text-center w-100">
                                <div class="col-6">
                                    <button type='button'
                                            class="btn btn-outline-danger"
                                            data-bs-dismiss='modal'
                                    >
                                        Cancel
                                    </button>
                                </div>
                                <div class="col-6">
                                    <input id='login-submit-button'
                                           type='submit'
                                           class="btn btn-outline-primary"
                                           value="Log In">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class='modal fade' id='signup-modal-window'>
        <div class='modal-dialog modal-dialog-centered modal-lg'>
            <div class='modal-content p-5'>
                <form id='signup-form'  method="post" action="controller_jordan.php">
                    <div class='header'>
                        <h2 class='modal-title text-center p-3'>Sign up for an Account</h2>
                    </div>
                    <div class='body'>
                        <div class="input-group">
                            <input type='hidden' name='page' value='StartPage'>
                            <input type='hidden' name='command' value='Signup'>
                            <div class="row m-4 w-100">
                                <div class="col-6">
                                    <label class="control-label" for="signup-username">Username: </label>
                                </div>
                                <div class="col-6">
                                    <input class="form-control" id="signup-username" name="username" type="text">
                                    <span><?php echo $error_msg_username_exists ?></span>
                                </div>
                            </div>
                            <div class="row m-4 w-100">
                                <div class="col-6">
                                    <label class="control-label" for="signup-password">Password: </label>
                                </div>
                                <div class="col-6">
                                    <input class="form-control" id="signup-password" name="password" type="password">
                                </div>
                            </div>
                            <div class="row m-4 w-100">
                                <div class="col-6">
                                    <label class="control-label" for="signup-email">Email: </label>
                                </div>
                                <div class="col-6">
                                    <input class="form-control" id="signup-email" name="email" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='footer'>
                        <div class="input-group">
                            <div class="row m-4 text-center w-100">
                                <div class="col-6">
                                    <button type='button'
                                            class="btn btn-outline-danger"
                                            data-bs-dismiss='modal'
                                    >
                                        Cancel
                                    </button>
                                </div>
                                <div class="col-6">
                                    <input id='signup-submit-button'
                                           type='submit'
                                           class="btn btn-outline-primary"
                                           value="Sign Up">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    window.addEventListener('load', function() {
        <?php
            if ($display_modal_window == 'no-modal-window') {
                echo 'close_modals();';
            } else if ($display_modal_window == 'signin') {
                echo 'show_signin();';
            } else if ($display_modal_window == 'signup') {
                echo 'show_signup();';
            }
        ?>
    });

    function close_modals() {
        $("#login-modal-window").modal("hide");
        $("#signup-modal-window").modal("hide");
    }

    function show_signin() {
        $("#login-modal-window").modal("show");
    }

    function show_signup() {
        $("#signup-modal-window").modal("show");
    }

</script>

</html>