<!DOCTYPE html>
<?php
require("class.phpmailer.php");
if ($_POST) {
    if ($_POST['submit']) {
        $mail = new PHPMailer();

        $mail->IsSMTP();
        $mail->Host = "mail.top10contest.com";

        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = "noreply@top10contest.com"; // SMTP username
        $mail->Password = "Top10@123#$";      // SMTP password 

        $mail->From = "noreply@top10contest.com";
        $mail->FromName = $_POST['fname'].' '.$_POST['lname'];
        $mail->AddAddress("info@top10contest.com");

        $mail->IsHTML(true);

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];
        $mail->Subject = "Enquiry Form Website";
        $mail->Body = "
                <h2>Contact request details</h2>
                <p><b>First Name: </b>" . $fname . "</p>
                <p><b>Last Name: </b>" . $lname . "</p>
                <p><b>Email: </b>" . $email . "</p>                
                <p><b>Message: </b>" . $comment . "</p>
            ";
        
            if (!$mail->Send()) {
                echo "<script>alert('Message could not be sent. Please try again');top.location='contact-us.php';</script>";
               exit;
            } else {
                echo "<script>alert('Message has been sent');top.location='contact-us.php';</script>";
            }
    }
}
?>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact Us</title>

        <style>
            body,html{overflow-x:hidden;font-family:'Leckerli One',cursive;width:100%}
            a{text-decoration:none}
            ul{list-style-type:none}
            a:focus,a:hover{text-decoration:none}
            h1,h2,h3,h4,h5,h6{text-transform:none;font-weight:600;font-family:'Leckerli One',cursive;text-align:center}
            hr{border-color:#ffc266;border-width:5px;max-width:100%}
            .container-h1{text-align:center;font-size:50px;font-weight:700;margin:50px auto;color:#333;font-family:'Leckerli One',cursive}
            .btn,.btn:focus{color:#fff;background-color:#182c39;margin:20px auto;font-weight:500;display:table;padding:10px;border:1px solid #182c39;margin-left:50%;border-radius:0}
            .btn:focus,.btn:hover{color:#182c39;background-color:transparent;border:1px solid #182c39}
            .hr-h3s{border:3px solid #e94b3c;width:70px;margin:0 auto 35px auto}
            textarea{resize:none}
            section{align-items:center;padding:50px 60px}
            .bg-section h2{font-family:'Leckerli One',cursive;text-transform:none;margin:50px 0;padding:25px 20px;border-radius:50px}
            @keyframes slide{0%{opacity:0;transform:translateX(50%)}100%{opacity:1;transform:translateX(0)}}
            @-webkit-keyframes slide{0%{opacity:0;-webkit-transform:translateX(50%);transform:translateX(50%)}100%{opacity:1;-webkit-transform:translateX(0);transform:translateX(0)}}
            #contact .form-group input,#contact .form-group textarea{border:1px solid #000;border-radius:0;font-family:'Leckerli One',cursive}
            #contact .form-group input:hover,#contact .form-group textarea:hover{border-color:#ababee;box-shadow:2px 2px 2px rgba(0,0,0,.2)}#contact .contact-buttons input,#contact .contact-buttons input:focus{color:#fff;background-color:#777673;margin:20px auto 40px auto;border-radius:0;font-weight:500;padding:10px;border:1px solid #777673;cursor:pointer;font-family:'Leckerli One',cursive}
            #contact .contact-buttons input:hover{color:#777673;background-color:#fff}
            #contact .left-box{background-color:#777673;margin:0 20px;font-size:15px;text-transform:none;line-height:1.8em;font-weight:500;padding:30px 50px;color:#fff;font-family:'Leckerli One',cursive}
            #contact .left-box .span-contact{color:#fff;font-weight:700;padding-right:20px;font-size:17px}
        </style>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    </head>
    <body>

        <section class="bg-contact bg-section" id="contact">
            <div class="container-fluid">
                <h1 class="container-h1">Contact us</h1>
                <div class="row">
                    <div class="col-md-6 col-sm-6 contact-left">
                        <div class="left-box">
                            <address class="contact">
                                <br><span class="span-contact">Call:</span>
                                <br> +256 0733513760
                                <br> <span class="span-contact">Email:</span> 
                                <br> info@top10contest.com
                                <br> <span class="span-contact">Visit:</span>  
                                <br> Bandari plaza
                                <br> Westlands
                                <br> Nairobi.
                            </address>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 contact-right" >

                        <form name="frm" method="post">
                            <div class="form-group has-feedback">
                                <label class="sr-only">First name:</label>
                                <input type="text" name="fname" class="form-control" placeholder="First name" required>
                            </div>
                            <div class="form-group has-feedback">
                                <label class="sr-only">Last name:</label>
                                <input type="text" name="lname" class="form-control" placeholder="Last name" required>
                            </div>
                            <div class="form-group has-feedback">
                                <label class="sr-only">Email:</label>
                                <input type="email" name="email" class="form-control"  placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" name="comment" for="comment">Comment:</label>
                                <textarea class="form-control" rows="3" name="comment" id="comment" placeholder="Description"></textarea>
                            </div>
                            <div class="contact-buttons pull-left">
                                <input type="submit" name="submit" class="form-control" value="Send" />
                            </div>
                        </form>

                    </div>
                </div>
            </div>    
        </section>  

    </body>
</html>