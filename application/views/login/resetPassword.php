
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
        <title>Reset Password</title>
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
                                    <h4 class="mb-1 f-w-400">Reset Password</h4>
                                </div>
                                <hr>
                                <?php if(isset($alertMessageDanger)) : ?> 
                                    <div class="alert alert-danger">
                                        <?= $alertMessageDanger; ?>
                                    </div>
                                <?php endif; ?> 
                                <?php if(isset($alertMessageSuccess)) : ?> 
                                    <div class="alert alert-success">
                                        <?= $alertMessageSuccess; ?>
                                    </a>
                                    </div>
                                <?php endif; ?> 
                                <?php if(isset($alertMessageSuccessReset)) : ?> 
                                    <div class="alert alert-success">
                                        <?= $alertMessageSuccessReset; ?> | <a href="<?= base_url() ?>Login_Controller/index" >
                                        <small>Click to Redirect Login Page</small>
                                    </a>
                                    </div>
                                <?php endif; ?> 
                                <form class="user" method="POST" action="<?= base_url()?>Login_Controller/resetPassword">
                                    <input type="hidden" class="form-control form-control-user"
                                            id="fieldInputEmail" aria-describedby="emailHelp"
                                            placeholder="New Password" name="Email"
                                            value="<?= $email ?>" required>
                                    <div class="form-group mb-4 d-flex justify-content-end align-items-center <?php if(isset($alertMessageSuccessReset)) : ?> hidden <?php endif; ?>">
                                        <input type="password" class="form-control form-control-user"
                                            id="fieldInputPassword" aria-describedby="emailHelp"
                                            placeholder="New Password" name="NewPassword"
                                            value="" required>
                                            <i toggle="#fieldInputPassword" class="fa fa-eye mr-2 position-absolute toggle-password cursor-pointer" role="button"></i>
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