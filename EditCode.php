<?php include("includes/function.php"); ?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['registration'])){

    $code = rand(999999999, 111111111);
    $pin = "BR-" . $code . "-N";
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $countryCode = $_POST['countryCode'];
    $phoneNumber = $_POST['phoneNumber'];
    $curr = $_POST['currency'];

    $contact = $countryCode . $phoneNumber;

    $nationality = $_POST['nationality'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $_SESSION['warning'] = "Please make sure Password and Confirm Password match!";
        echo "<script>window.open('Registration.php', '_self')</script>";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email or contact exists in the database
    $checkQuery = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$email' OR `phone` = '$contact'");
    if (mysqli_num_rows($checkQuery) > 0) {
        $_SESSION['warning'] = "Email or Contact already exists. try another one!";
        echo "<script>window.open('Registration.php', '_self')</script>";
        exit;
    }

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Username   = 'dont123.miss@gmail.com';                     //SMTP username
        $mail->Password   = 'ncuwcipwmxufbmug';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // ENCRYPTION_SMTPS - Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('dont123.miss@gmail.com', 'Blue River');
        $mail->addAddress($email, $firstname);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Your Credition Information';
        $mail->Body    = '
            <h4>Thank you for Joining Blue River</h4>
            <p>Name : '.$firstname.'</p>
            <p>YOUR PIN : <b>'.$pin.'</b></p>
        ';

        if($mail->send())
        {
            $InsertQuery = mysqli_query($con, "INSERT INTO `users`(`pin`, `firstname`, `lastname`, `email`, `phone`, `nationality`, `gender`, `profile`, `currency`, `password`) 
            VALUES ('$pin','$firstname','$lastname','$email','$contact','$nationality','$gender','','$curr','$hashedPassword')");
            if($InsertQuery){
                echo "<script>window.open('index.php', '_self')</script>";
                $_SESSION['success'] = "Thank You for Joining Blue river. Check on your email to comfirm and procced";
            } else {
                echo "<script>window.open('Registration.php', '_self')</script>";
                $_SESSION['warning'] = "Something Went Wrong!!.";
            }
        }else{
            echo "<script>window.open('Registration.php', '_self')</script>";
            $_SESSION['warning'] = "Something Went Wrong!!.";
        }
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}
if(isset($_POST['login'])){

    $pin = $_POST['pin'];
    $password = $_POST['password'];

    $checkQuery = mysqli_query($con, "SELECT * FROM `users` WHERE `pin` = '$pin'");
    if (mysqli_num_rows($checkQuery) > 0) {
        $row = mysqli_fetch_assoc($checkQuery);

        if($row['gender'] == "Male"){
            $gender = "Mr";
        }else{
            $gender = "Miss";
        }
        
        $_SESSION['LoggedInUser'] = [
            'pin' => $pin,
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'contact' => $row['phone'],
            'nationality' => $row['nationality'],
            'gender' => $row['gender'],
            'email' => $row['email'],
            'gns' => $gender,
            'ID' => $row['id'],
            'Currency' => $row['currency'],
        ];
        $name = $row['firstname'] . $row['lastname'];
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['success'] = "Welcome $gender, $name to Blue River, enjoy changing life with Us.";
            echo "<script>window.open('Dashboard.php', '_self')</script>";
        } else {
            // Password does not match
            $_SESSION['warning'] = "Incorrect PIN or password!";
            echo "<script>window.open('index.php', '_self')</script>";
            exit;
        }
        
        exit;
    } else {
        // If user does not exist, show error message
        $_SESSION['warning'] = "PIN and password do not match!";
        echo "<script>window.open('index.php', '_self')</script>";
        exit;
    } 
}

if(isset($_POST['saveBudget']))
{
    $name = $_POST['name'];
    $created_at = date('Y-m-d');
    $status = "Wait to be execute";
    $userPIN = $_SESSION['LoggedInUser']['pin'];

    $query = mysqli_query($con, "INSERT INTO `budget`(`usePIN`, `name`, `create_at`, `executed_at`, `status`) 
    VALUES ('$userPIN','$name','$created_at','','$status')");
    if($query){
        $_SESSION['success'] = "Budget Created";
        echo "<script>window.open('budget.php', '_self')</script>";
    }else{
        $_SESSION['danger'] = "Something went wrong try again.";
        echo "<script>window.open('budget.php', '_self')</script>";
    }
}
if(isset($_POST['editBudget'])){
    if (isset($_POST['selected']) && !empty($_POST['selected'])) {
        $selected_ids = $_POST['selected'];

        foreach ($selected_ids as $id) {

            $name = $_POST['name'][$id];
            $create_at = date('Y-m-d');

            $Comp = mysqli_query($con, " UPDATE `budget` SET `name`='$name',
            `create_at`='$create_at' WHERE `id` = $id");
            if($Comp){
                echo "<script>window.open('budget.php','_self')</script>";
                $_SESSION['success'] = "Budget Updated Successfully.";
            }else{
                echo "<script>window.open('budget.php','_self')</script>";
                $_SESSION['warning'] = "Something Went Wrong!!.";
            }
        }
    }else {
        echo "<script>window.open('budget.php','_self')</script>";
        $_SESSION['warning'] = "There is no Data selected.";
    }
}
if(isset($_POST['deleteBudget'])){
    if (isset($_POST['selected']) && !empty($_POST['selected'])) {
        $selected_ids = $_POST['selected'];

        foreach ($selected_ids as $id) {
            $budgetList = mysqli_query($con, "DELETE FROM `budget_list` WHERE `budget_id` = $id");
            $Comp = mysqli_query($con, "DELETE FROM `budget` WHERE `id` = $id");
            if($Comp){
                echo "<script>window.open('budget.php','_self')</script>";
                $_SESSION['success'] = "Budget has been Deleted.";
            }else{
                echo "<script>window.open('budget.php','_self')</script>";
                $_SESSION['warning'] = "Something Went Wrong!!.";
            }
        }
    }else {
        echo "<script>window.open('budget.php','_self')</script>";
        $_SESSION['warning'] = "There is no Data selected.";
    }
}
if(isset($_POST['executeBudget'])){
    
}
if(isset($_POST['saveBudgetList'])){
    $budget_id = $_POST['budget_id'];
    $title = $_POST['title'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];
    $total_amount = $unit * $price;

    $query = mysqli_query($con, "INSERT INTO `budget_list`(`budget_id`, `title`, `unit`, `price`, `total_amount`) 
    VALUES ('$budget_id','$title','$unit','$price','$total_amount')");
    if($query){
        $_SESSION['success'] = "Budget List Added";
        echo "<script>window.open('budget.php', '_self')</script>";
    }else{
        $_SESSION['danger'] = "Something went wrong try again.";
        echo "<script>window.open('budget.php', '_self')</script>";
    }
}
if(isset($_POST['editBudgetList'])){
    if (isset($_POST['selected']) && !empty($_POST['selected'])) {
        $selected_ids = $_POST['selected'];

        foreach ($selected_ids as $id) {

            $title = $_POST['title'][$id];
            $unit = $_POST['unit'][$id];;
            $price = $_POST['price'][$id];
            $total_amount = $unit * $price;

            $Comp = mysqli_query($con, " UPDATE `budget_list` SET `title`='$title',
            `unit`='$unit',`price`='$price',`total_amount`='$total_amount' WHERE `id` = $id");
            if($Comp){
                echo "<script>window.open('budget.php','_self')</script>";
                $_SESSION['success'] = "Budget List Updated Successfully.";
            }else{
                echo "<script>window.open('budget.php','_self')</script>";
                $_SESSION['warning'] = "Something Went Wrong!!.";
            }
        }
    }else {
        echo "<script>window.open('budget.php','_self')</script>";
        $_SESSION['warning'] = "There is no Data selected.";
    }
}
if(isset($_POST['deleteBudgetList'])){
    if (isset($_POST['selected']) && !empty($_POST['selected'])) {
        $selected_ids = $_POST['selected'];

        foreach ($selected_ids as $id) {

            $Comp = mysqli_query($con, "DELETE FROM `budget_list` WHERE `id` = $id");
            if($Comp){
                echo "<script>window.open('budget.php','_self')</script>";
                $_SESSION['success'] = "Budget List has been Deleted.";
            }else{
                echo "<script>window.open('budget.php','_self')</script>";
                $_SESSION['warning'] = "Something Went Wrong!!.";
            }
        }
    }else {
        echo "<script>window.open('budget.php','_self')</script>";
        $_SESSION['warning'] = "There is no Data selected.";
    }
}
if(isset($_POST['saveDebit'])){
    $transactionType = $_POST['transactionType'];
    $amount = $_POST['amount'];
    $desc = $_POST['desc'];
    $userPIN = $_POST['userPIN'];
    $date = date('Y-m-d');

    $query = mysqli_query($con, "INSERT INTO `assets`(`usePIN`, `transcation_type`, `amount`, `description`, `asset_type`, `date`) 
    VALUES ('$userPIN','$transactionType','$amount','$desc','debit','$date')");
    if($query){
        $_SESSION['success'] = "Debit Added";
        echo "<script>window.open('debitManagement.php', '_self')</script>";
    }else{
        $_SESSION['danger'] = "Something went wrong try again.";
        echo "<script>window.open('debitManagement.php', '_self')</script>";
    }
}
if(isset($_POST['editDebit'])){
    if (isset($_POST['selected']) && !empty($_POST['selected'])) {
        $selected_ids = $_POST['selected'];

        foreach ($selected_ids as $id) {

            $transactionType = $_POST['transactionType'][$id];
            $amount = $_POST['amount'][$id];
            $desc = $_POST['desc'][$id];

            $Comp = mysqli_query($con, " UPDATE `assets` SET `transcation_type`='$transactionType',`amount`='$amount',`description`='$desc' WHERE `id` = $id");
            if($Comp){
                echo "<script>window.open('debitManagement.php','_self')</script>";
                $_SESSION['success'] = "Credit Updated Successfully.";
            }else{
                echo "<script>window.open('debitManagement.php','_self')</script>";
                $_SESSION['warning'] = "Something Went Wrong!!.";
            }
        }
    }else {
        echo "<script>window.open('debitManagement.php','_self')</script>";
        $_SESSION['warning'] = "There is no Data selected.";
    }
}
if(isset($_POST['deleteDebit'])){
    if (isset($_POST['selected']) && !empty($_POST['selected'])) {
        $selected_ids = $_POST['selected'];

        foreach ($selected_ids as $id) {

            $Comp = mysqli_query($con, " DELETE FROM `assets` WHERE `id` = $id");
            if($Comp){
                echo "<script>window.open('debitManagement.php','_self')</script>";
                $_SESSION['success'] = "Credit Deleted Successfully.";
            }else{
                echo "<script>window.open('debitManagement.php','_self')</script>";
                $_SESSION['warning'] = "Something Went Wrong!!.";
            }
        }
    }else {
        echo "<script>window.open('debitManagement.php','_self')</script>";
        $_SESSION['warning'] = "There is no Data selected.";
    }
}
if(isset($_POST['saveCredit'])){
    $transactionType = $_POST['transactionType'];
    $amount = $_POST['amount'];
    $desc = $_POST['desc'];
    $userPIN = $_POST['userPIN'];
    $date = date('Y-m-d');

    $query = mysqli_query($con, "INSERT INTO `assets`(`usePIN`, `transcation_type`, `amount`, `description`, `asset_type`, `date`) 
    VALUES ('$userPIN','$transactionType','$amount','$desc','credit','$date')");
    if($query){
        $_SESSION['success'] = "Credit Added";
        echo "<script>window.open('creditManagement.php', '_self')</script>";
    }else{
        $_SESSION['danger'] = "Something went wrong try again.";
        echo "<script>window.open('creditManagement.php', '_self')</script>";
    }
}
if(isset($_POST['editCredit'])){
    if (isset($_POST['selected']) && !empty($_POST['selected'])) {
        $selected_ids = $_POST['selected'];

        foreach ($selected_ids as $id) {

            $transactionType = $_POST['transactionType'][$id];
            $amount = $_POST['amount'][$id];
            $desc = $_POST['desc'][$id];

            $Comp = mysqli_query($con, " UPDATE `assets` SET `transcation_type`='$transactionType',`amount`='$amount',`description`='$desc' WHERE `id` = $id");
            if($Comp){
                echo "<script>window.open('creditManagement.php','_self')</script>";
                $_SESSION['success'] = "Credit Updated Successfully.";
            }else{
                echo "<script>window.open('creditManagement.php','_self')</script>";
                $_SESSION['warning'] = "Something Went Wrong!!.";
            }
        }
    }else {
        echo "<script>window.open('creditManagement.php','_self')</script>";
        $_SESSION['warning'] = "There is no Data selected.";
    }
}
if(isset($_POST['deleteCredit'])){
    if (isset($_POST['selected']) && !empty($_POST['selected'])) {
        $selected_ids = $_POST['selected'];

        foreach ($selected_ids as $id) {

            $Comp = mysqli_query($con, " DELETE FROM `assets` WHERE `id` = $id");
            if($Comp){
                echo "<script>window.open('creditManagement.php','_self')</script>";
                $_SESSION['success'] = "Credit Deleted Successfully.";
            }else{
                echo "<script>window.open('creditManagement.php','_self')</script>";
                $_SESSION['warning'] = "Something Went Wrong!!.";
            }
        }
    }else {
        echo "<script>window.open('creditManagement.php','_self')</script>";
        $_SESSION['warning'] = "There is no Data selected.";
    }
}
if(isset($_POST['saveProperties'])){
    $propertyType = $_POST['properties'];
    $amount = $_POST['amount'];
    $desc = $_POST['desc'];
    $userPIN = $_POST['userPIN'];
    $s = $_POST['date'];
    $date = date('Y-m-d',strtotime($s));

    $query = mysqli_query($con, "INSERT INTO `property`(`usePIN`, `property_name`, `amount`, `description`, `issued_date`) 
    VALUES ('$userPIN','$propertyType','$amount','$desc','$date')");
    if($query){
        $_SESSION['success'] = "Property has been Added";
        echo "<script>window.open('property.php', '_self')</script>";
    }else{
        $_SESSION['danger'] = "Something went wrong try again.";
        echo "<script>window.open('property.php', '_self')</script>";
    }
}
if(isset($_POST['editProperties'])){
    if (isset($_POST['selected']) && !empty($_POST['selected'])) {
        $selected_ids = $_POST['selected'];

        foreach ($selected_ids as $id) {

            $propertiesType = $_POST['properties'][$id];
            $amount = $_POST['amount'][$id];
            $desc = $_POST['desc'][$id];

            $Comp = mysqli_query($con, " UPDATE `property` SET `property_name`='$propertiesType',`amount`='$amount',`description`='$desc' WHERE `id` = $id");
            if($Comp){
                echo "<script>window.open('property.php','_self')</script>";
                $_SESSION['success'] = "Property Details Updated Successfully.";
            }else{
                echo "<script>window.open('property.php','_self')</script>";
                $_SESSION['warning'] = "Something Went Wrong!!.";
            }
        }
    }else {
        echo "<script>window.open('property.php','_self')</script>";
        $_SESSION['warning'] = "There is no Data selected.";
    }
}
if(isset($_POST['deleteProperties'])){
    if (isset($_POST['selected']) && !empty($_POST['selected'])) {
        $selected_ids = $_POST['selected'];

        foreach ($selected_ids as $id) {

            $Comp = mysqli_query($con, " DELETE FROM `property` WHERE `id` = $id");
            if($Comp){
                echo "<script>window.open('property.php','_self')</script>";
                $_SESSION['success'] = "Property Deleted Successfully.";
            }else{
                echo "<script>window.open('property.php','_self')</script>";
                $_SESSION['warning'] = "Something Went Wrong!!.";
            }
        }
    }else {
        echo "<script>window.open('property.php','_self')</script>";
        $_SESSION['warning'] = "There is no Data selected.";
    }
}


?>