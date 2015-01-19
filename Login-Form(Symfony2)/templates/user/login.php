<!DOCTYPE html>
<html lang="en"><head>

    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">

    <title>Admin panel login</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/sb-admin.css">

    <!-- Custom Fonts -->
    <link type="text/css" rel="stylesheet" href="font-awesome-4.1.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default" style="margin-top: 50px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?=$request->createUrl()?>" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" autofocus="" name="username" placeholder="Username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="password" value="" name="password" placeholder="Password" class="form-control">
                                </div>
                                
                                <input value="Login" type="submit" class="btn btn-lg btn-success btn-block" href="index.html"/>
                            </fieldset>
                        </form>
						<br/>
						<a class="btn btn-lg btn-success btn-block" href="<?=$this->request->createUrl('user','register')?>">Register</a>
                    </div>
					
					<?php if ( !empty($message) ) { ?>
					<div class="row">
						<div class="col-lg-12">
							<div class="alert alert-danger">
								<i class="fa fa-info-circle"></i>  <?=$message?>
							</div>
						</div>
					</div>
					<?php } ?>
					
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body></html>