<h3>Login </h3>
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

        <?php if ($_SESSION['usuario_logged']  == TRUE){ ?>
            <!--<br><br><br>
            <h2>User Logged</h2>-->
        <?php }else{ ?>
            <a href="?c=User&a=register" class = "btn btn-info">Register</a>&nbsp;&nbsp;
        <?php }?>
        <?php if ($_SESSION['usuario_logged']  != TRUE){ ?>
        <br><br>
        <div class="row">
            <div class="col-md-6 m-t-2">

                    <form action="?c=User&a=login" method="post">

                        <label for="email"><b>Email *</b></label>
                            <input type="email" id="email" name="_email" value="" required="required"  class="form-control"/>

                        <label for="password"><b>Password *</b></label>
                        <input type="password" id="password" name="_password" required="required" maxlength="10" minlength="5" placeholder="Maximum 10 and a minimum of 5 characters" class="form-control"/>

                        <b>Fields marked with an asterisk (*) are required.</b>
                        <br>
                        <br>
                        <input type="submit" class="btn btn-success" id="_submit" name="_submit" value="Login" />
                    </form>
                <?php }?>
            </div>
        </div>
</div>
