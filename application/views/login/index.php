<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Nabil Khoerul Rijal">
        <link rel="icon" href="<?= base_url() ?>public/img/Indihome.jpg">
        <title><?= $title; ?></title>
        <!-- Custom fonts for this template-->
        <link href="<?= base_url()?>public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <!-- Custom styles for this template-->
        <!-- <link href="<?= base_url()?>public/css/sb-admin-2.min.css" rel="stylesheet"> -->
        <link href="<?= base_url()?>public/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url()?>public/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?= base_url()?>public/css/animate.css" rel="stylesheet">
        <link href="<?= base_url()?>public/css/style.css" rel="stylesheet">
        <style>
        /*No media query for `xs` since this is the default in Bootstrap */
            @media (max-width: 575.98px) {
                .custom-control-label {
                    margin-top: 5px;
                }
                .toggle-password {
                    right: 5.5em;
                    bottom: 14.2em;
                }
            }

            /* Small devices (landscape phones, 576px and up) */
            @media (min-width: 576px) {
                .custom-control-label {
                    margin-top: 5px;
                }
                .toggle-password {
                    right: 5.5em;
                    bottom: 14.2em;
                }
            }

            /* Medium devices (tablets, 768px and up) */
            @media (min-width: 768px) {
                .custom-control-label {
                    margin-top: 5px;
                }
                .toggle-password {
                    right: 5.5em;
                    bottom: 14.2em;
                }
            }

            /* Large devices (desktops, 992px and up) */
            @media (min-width: 992px) {
                .custom-control-label {
                    margin-top: 5px;
                }
                .toggle-password {
                    right: 5.5em;
                    bottom: 17.8em;
                }
            }

            /* X-Large devices (large desktops, 1200px and up) */
            @media (min-width: 1200px) {
                .custom-control-label {
                    margin-top: 5px;
                }
                .toggle-password {
                    right: 5.5em;
                    bottom: 14.2em;
                }
            }

            /* XX-Large devices (larger desktops, 1400px and up) */
            @media (min-width: 1400px) {
                .custom-control-label {
                    margin-top: 6px;
                }
                .toggle-password {
                    right: 5.5em;
                    bottom: 17.5em;
                }
            }

            .cursor-pointer {
                cursor: pointer;
            }
        </style>
    </head>

    <body class="bg-gradient-primary d-flex justify-content-center align-items-center">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-5 col-md-5">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center" style="display: flex;flex-wrap: nowrap;
                                        flex-direction: row;align-items: flex-start;align-content: space-around;justify-content: center;">
                                        <img width="50"src="<?= base_url() ?>public/img/Indihome.jpg" alt="" srcset="">
                                            <h1 class="h4 text-gray-900 mb-4 company-title"><?= $title; ?></h1>
                                        </div>
                                        <form class="user" method="POST" action="<?= base_url()?>Login_Controller/getDataUser">
                                            <?php if(isset($alertMessage)) : ?> 
                                            <div class="alert alert-danger">
                                                <?= $alertMessage; ?>
                                            </div>
                                            <?php endif; ?> 
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user"
                                                    id="fieldInputUsername" aria-describedby="emailHelp"
                                                    placeholder="Enter Username" name="Email"
                                                    value="<?php if(isset($_COOKIE["loginId"])) { echo $_COOKIE["loginId"]; } ?>" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <input type="password" class="form-control form-control-user"
                                                    id="fieldInputPassword" placeholder="Password" name="Password"
                                                    value="<?php if(isset($_COOKIE["loginPass"])) { echo $_COOKIE["loginPass"]; } ?>" required>
                                                    <i toggle="#fieldInputPassword" class="fa fa-eye position-absolute toggle-password cursor-pointer"></i>
                                            </div>
                                            <!-- <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input cursor-pointer" id="customCheck" <?php if(isset($_COOKIE["loginId"])) { ?> checked="checked" <?php } ?>>
                                                    <label class="custom-control-label cursor-pointer" for="customCheck">Remember Me</label>
                                                </div>
                                            </div> -->
                                            <button class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                            <hr>
                                            <p class="m-t text-center"> <small><?= $owner; ?> &copy; <?= $year; ?></small> </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="<?= base_url()?>public/js/jquery-3.1.1.min.js"></script>
        <script src="<?= base_url()?>public/js/popper.min.js"></script>
        <script src="<?= base_url()?>public/js/bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $(".toggle-password").click(function() {
                    $(this).toggleClass("fa-eye fa-eye-slash");
                    var input = $($(this).attr("toggle"));
                    if (input.attr("type") == "password") {
                        input.attr("type", "text");
                    } else {
                        input.attr("type", "password");
                    }
                });
            });
        </script>
    </body>

</html>