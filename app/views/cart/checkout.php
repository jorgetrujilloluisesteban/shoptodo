<h3>Checkout </h3>

  
        <a href="?c=Home&a=index" class = "btn btn-info">Main page</a>&nbsp;&nbsp;

        <br><br>
        <div class="row">
            <div class="col-md-6 m-t-2">

                    <form action="?c=Cart&a=checkout" method="post">

                        <label for="name"><b>Name *</b></label>
                            <input type="text" id="name" name="_name" value="" required="required"  class="form-control"/>

                        <label for="email"><b>Email *</b></label>
                            <input type="email" id="email" name="_email" value="" required="required"  class="form-control"/>

                        <label for="address"><b>Address *</b></label>
                        <input type="text" id="text" name="_address" required="required" maxlength="150"  class="form-control"/>

                        <b>Fields marked with an asterisk (*) are required.</b>
                        <br>
                        <br>
                        <input type="submit" class="btn btn-success" id="_submit" name="_submit" value="Place Order" />
                    </form>

            </div>
        </div>

