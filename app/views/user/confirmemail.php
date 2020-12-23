<h1>Login </h1>
                <?php if ($_SESSION['error']!=""){ ?>
                    <div class="alert alert-warning alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <h3><?php echo $_SESSION['error']; ?></h3>
                    </div>
                <?php };?>

                    <?php if ($tabla_res['items'] == 0){ ?>
                        <b>Items: 0 | Total: 0 </b>
                    <?php }else{ ?>
                        <b>Items: <?php echo $tabla_res['items'];?> | Total: <?php echo $tabla_res['sumtotal'];?> </b>|
                    <?php }?>

            <a href="?c=Home&a=index" class = "btn btn-info">Main page</a>&nbsp;&nbsp;

            <?php if ($log==TRUE){ ?>
                <h2>Usuario Loggeado</h2>
            <?php }else{ ?>
                <a class="btn btn-primary" href="?c=User&a=register">Register User</a>&nbsp;&nbsp;
            <?php }?>
           <?php if ($log!=TRUE){ ?>
           
  <div class="row">
    <div class="col-md-6 m-t-2">


            <form action="?c=User&a=login" method="post">
                
                <input type="hidden" name="_csrf_token" value="<?php echo bin2hex($token);?>" />

                <label for="username">Username</label>
                <input type="text" id="username" name="_username" value="" required="required" class="form-control"/>
                <?php if ($nameErr!=""){ ?>
                    <div class="alert alert-warning alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <?php echo $nameErr; ?>
                    </div>
                <?php };?>

                <label for="password">Password</label>
                <input type="password" id="password" name="_password" required="required" class="form-control"/>

                <input type="checkbox" id="remember_me" name="_remember_me" value="on" />
                <label for="remember_me">Recordar el password</label>
                <br>
                <input type="submit" class="btn btn-success" id="_submit" name="_submit" value="loguear" />
            </form>
        <?php }?>
    </div>
</div>