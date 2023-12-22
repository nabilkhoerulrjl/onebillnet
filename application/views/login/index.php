
<!DOCTYPE html>
<html lang="id">
    <head>
        <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 11]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="">
        <meta name="author" content="Nabil Khoerul Rijal">
        <title><?= $title; ?></title>
        <!-- Favicon icon -->
        <link rel="icon" href="<?= base_url() ?>/public/img/Indihome.jpg" type="image/x-icon">
        <!-- vendor css -->
        <link rel="stylesheet" href="<?= base_url() ?>/public/css/style.css">
        <style>
            .cursor-pointer {
                cursor: pointer;
            }

            .font-white {
                color: white;
            }

            .font-sm {
                font-size: small;
            }
        </style>
    </head>
    <body>
        <!-- [ auth-signin ] start -->
        <div class="auth-wrapper">
            <div class="auth-content text-center">
                <div class="card borderless">
                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="text-center d-flex justify-content-center align-items-center flex-column">
                                <img width="50"src="<?= base_url() ?>public/img/Indihome.jpg" alt="" srcset="">
                                    <h4 class="mb-3 f-w-400"><?= $title; ?></h4>
                                </div>
                                <hr>
                                <?php if(isset($alertMessage)) : ?> 
                                <div class="alert alert-danger">
                                    <?= $alertMessage; ?>
                                </div>
                                <?php endif; ?> 
                                <form class="user" method="POST" action="<?= base_url()?>Login_Controller/getDataUser">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="Email" name="Email" placeholder="Email address"
                                        value="<?php if(isset($_COOKIE["loginId"])) { echo $_COOKIE["loginId"]; } ?>">
                                    </div>
                                    <div class="form-group mb-4 d-flex justify-content-end align-items-center">
                                        <input type="password" class="form-control" id="fieldInputPassword" placeholder="Password" name="Password"
                                        value="<?php if(isset($_COOKIE["loginPass"])) { echo $_COOKIE["loginPass"]; } ?>">
                                        <i toggle="#fieldInputPassword" class="fa fa-eye mr-2 position-absolute toggle-password cursor-pointer" role="button"></i>

                                    </div>
                                    <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                                        <input type="checkbox" class="custom-control-input cursor-pointer" id="customCheck1">
                                        <label class="custom-control-label cursor-pointer" for="customCheck1">Save credentials.</label>
                                    </div>
                                    <button class="btn btn-block btn-primary mb-4">Signin</button>
                                </form>
                                <hr>
                                <p class="mb-2 text-muted">Forgot password? <a href="<?= base_url() ?>Login_Controller/searchAccount" class="f-w-400">Reset</a></p>
                                <!-- <p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup.html" class="f-w-400">Signup</a></p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="autorize position-absolute" style="bottom:0px;right:0px;padding:10px;">
                <h3 class="font-white font-sm">Powered by OnebillNet</h3>
            </div>
        </div>
        <!-- [ auth-signin ] end -->
        <!-- Required Js -->
        <script src="<?= base_url() ?>/public/js/vendor-all.min.js"></script>
        <script src="<?= base_url() ?>/public/js/plugins/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>/public/js/pcoded.min.js"></script>
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