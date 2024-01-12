<?php
if (isset($_POST['total_question']) && isset($_POST['currect_ans']) && isset($_POST['wrong_ans'])) {
    $total_question = $_POST['total_question'];
    $currect_ans = $_POST['currect_ans'];
    $wrong_ans = $_POST['wrong_ans'];
    $time = $_POST['time'];
    $attempt_question = $_POST['attempt_question'];

    if (empty($total_question)) {
        header("location:index.php");
    }
     $score = $currect_ans;
        $per = $currect_ans * 100 / $total_question;
} else {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Quiz Result</title>
        <?php include('include-css.php'); ?>
    </head>

    <body class="bg-content-color">

        <?php include('header.php'); ?>  

        <div class="container-bg-set container top-margin">
            <div class="row justify-content-center shadow-box container-bg-set shadow-box-result">
                <div class="col-md-12 col-sm-12 text-center theme-color pt-4">                         
                    <!--<h2>CONGRATULATIONS</h2>--> 
                     <h2 class="pb-2">Practice</h2> 
                     <h4 class="pb-2">Result</h4>
                </div>                    
                <div class="col-md-10 col-sm-10 text-center">
                     <h5 class="alert alert-info"><?= htmlspecialchars($currect_ans) ?> Correct Answer</h5>
                </div>
                <div class="col-md-10 col-sm-10 text-center">                                
                    <h5 class="alert alert-info"><?= htmlspecialchars($wrong_ans) ?> Incorrect Answer</h5>                                                    
                </div>
                <div class="col-md-10 col-sm-10 text-center">
                    <h5 class="alert alert-info">Total Time: <?= $time ?></h5>      
                </div>  
            </div>
        </div>
        <?php include('footer.php'); ?>  

    </body>
</html>

