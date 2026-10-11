<!DOCTYPE html>
<html lang="en">
<head>
    <title>register</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php echo validation_errors();?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register In Samajcare Account!</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST">
                            <fieldset>
                                <div class="form-group">
                                        <p>please fill all the fields required to register..</p>
                                        <input class="form-control" type="text" name="id" placeholder="enter your id code" value="<?php echo set_value('id');?>"><br>
                                        <input class="form-control" type="text" name="login_username" placeholder="enter username" value="<?php echo set_value('login_username');?>"><br>
                                        <input class="form-control" type="email" name="login_email" placeholder="enter email" value="<?php echo set_value('login_email');?>"><br>
                                        <input class="form-control" type="password" name="login_password" placeholder="enter password"><br>
                                        <input class="form-control" type="password" name="re_password" placeholder="re-enter password"><br>
                                        Usertype:<select name="login_usertype" class="form-control">
                                            <option>patient</option>
                                            <option>dentist</option>
                                        </select><br>
                                </div>
                                <input type="submit" name="login" value="Register" class="btn btn-lg btn-success btn-block"><br>
                                <a href="<?php echo base_url();?>users"><input type="button" name="login" value="back to login" class="btn btn-lg btn-success btn-block"><br>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
