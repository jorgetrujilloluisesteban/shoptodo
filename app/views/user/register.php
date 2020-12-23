<h3>Register </h3>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<!--=============================================
	OPCION
	=============================================-->
	<div class="col-xs-12 col-lg-2 pull-left">
		<div class="clearfix"></div><div class="col-xs-12"><hr></div>'
		<div class="background-filter">
			<b>My account</b>
			<hr>
			<b>My personal data</b>
            <hr>
            <b>Contact</b>
		</div>
	</div>

    <div class="col-xs-12 col-lg-10 pull-right" id="productos">

            <a href="?c=Home&a=index" class = "btn btn-info">Main page</a>&nbsp;&nbsp;

            <?php if ($log==TRUE){ ?>
                <h2>Usuario Loggeado</h2>
            <?php }else{ ?>
                <a href="?c=User&a=login" class = "btn btn-info">Login</a>&nbsp;&nbsp;
            <?php }?>
           <?php if ($log!=TRUE){ ?>
           <br><br>
            <div class="row">
                <div class="col-md-6 m-t-2">


                        <form action="<?php echo htmlspecialchars("?c=User&a=register"); ?>" method="post">
                            
                            <input type="hidden" name="_csrf_token" value="<?php echo bin2hex($token);?>" />

                            <label for="username"><b>Username *</b></label>
                            <input type="text" id="username" name="_username" value="" required="required" maxlength="10" minlength="5" placeholder="Maximum 10 and a minimum of 5 characters" class="form-control"/>
                            <?php if ($nameErr!=""){ ?>
                                <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo $nameErr; ?>
                                </div>
                            <?php };?>
                            
                            <label for="email"><b>email *</b></label>
                            <input type="email" id="email" name="_email" value="" required="required" class="form-control"/>
                            <?php if ($emailErr!=""){ ?>
                                <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo $emailErr; ?>
                                </div>
                            <?php };?>

                            <label for="password"><b>Password *</b></label>
                            <input type="password" id="password" name="_password" required="required" maxlength="10" minlength="5" placeholder="Maximum 10 and a minimum of 5 characters"class="form-control"/>
                            <?php if ($passwordErr!=""){ ?>
                                <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo $passwordErr; ?>
                                </div>
                            <?php };?>
                    
                            <b>Security criteria for your password <a href="#" id="toastRegister"><i class="fa fa-info-circle" aria-hidden="true"></i></a></b>
                                <div class="toast" data-autohide="false" style="display: none;">
                                    <div class="toast-header">
                                        <strong class="mr-auto text-primary">Security criteria for your password</strong>
                                        <small class="text-muted">5 mins ago</small>
                                        <button type="button" class="ml-2 mb-1 close" id="toastRegisterclose" data-dismiss="toast">&times;</button>
                                    </div>
                                    <div class="toast-body">
                                        Your security is our priority so your password will have to meet the following criteria:
                                        <li>Between 5 and 10 characters.</li>
                                        <!--<li>Contain at least one letter and a maximum of 4 equal letters.</li>
                                        <li>Maximum 3 consecutive letters or equal numbers.</li>-->
                                    </div>
                                </div>
                            <br><br>
                            <label for="password"><b>Repeat your password *</b></label>
                            <input type="password" id="password2" name="_password2" required="required" maxlength="10" minlength="5" placeholder="Maximum 10 and a minimum of 5 characters"class="form-control"/>
                            <?php if ($passwordErr!=""){ ?>
                                <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo $passwordErr; ?>
                                </div>
                            <?php };?>
  
                            <br>
                            <b>Fields marked with an asterisk (*) are required.</b>
                            <br><br>
                            <input type="submit" class="btn btn-success" id="_submit" name="_submit" value="Register me" />
                        </form>
                    <?php }?>
                </div>
            </div>
        </div>
</div>

