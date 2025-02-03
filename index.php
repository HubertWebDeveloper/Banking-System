<?php include("includes/loginHeader.php"); ?>


<div class="py-5 mt-4">
    <div class="container mt-4" style="background: black;opacity: 0.7;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="row rounded-4 mt-4 mb-4">
                    <div class="text-center">

                        <div class="row mt-3">
                            <?php if ((date("H") >= 0) && (date("H") < 12))
                            {?>
                                <h5 style="color: white; font-weight: bold;font-size:32px" class="textAnimation" id="h5">Good Morning !</h5>
                                <p class="mt-3" style="font-size:32px"><b style="color:#1f3864">Blue</b> <b style="color:#00b0f0">River</b>.</p><?php
                            }
                            else if ((date("H") >= 12) && (date("H") < 17))
                            {?>
                                <h5 style="color: white; font-weight: bold;font-size:32px" class="textAnimation" id="h5">Good Afternoon !</h5>
                                <p class="mt-3" style="font-size:32px"><b style="color:#1f3864">Blue</b> <b style="color:#00b0f0">River</b>.</p><?php
                            }
                            else
                            {?>
                                <h5 style="color: white; font-weight: bold;font-size:32px" class="textAnimation" id="h5">Good Evening !</h5>
                                <p class="mt-3" style="font-size:32px"><b style="color:#1f3864">Blue</b> <b style="color:#00b0f0">River</b>.</p><?php
                            } ?>

                        </div>
                        <p class="mt-4 text-white"style="text-align:justify">Blue River, we help you turn your finances and properties into opportunities. 
                            Whether it’s achieving your dreams or fulfilling specific needs, 
                            we guide you to unlock the full potential of your assets, 
                            creating tailored strategies to transform what you have into what you truly desire.
                        </p>
                        <p class="text-white">Join Blue River now! <a href="Registration.php">JoinUs</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row rounded-4 mt-4 mb-4">
                    <form action="EditCode.php" method="POST" class="text-center">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="username"><i class="fa fa-envelope" style="margin-right:5px"></i> User PIN</label>
                                    <input type="text" name="pin" class="form-control" id="username" placeholder="Enter PIN">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="password"><i class="fa fa-envelope" style="margin-right:5px"></i> Password</label>
                                    <input type="Password" name="password" class="form-control" id="userpassword" placeholder="Enter Password">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" name="login" class="btn w-100" style="background: #00b0f0;color: white">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include("includes/loginFooter.php"); ?>
  
    
    
    
    
      
      
      
      

          
          
        

