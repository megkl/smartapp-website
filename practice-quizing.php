<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Practice</title>
        <?php include('include-css.php'); ?>
    </head>

    <body class="bg-content-color">
        <?php include('header.php'); ?>   

        <div class="container-bg-set container"> 

            <div class="row justify-content-center">
                <div class="justify-content-center col-md-9">
                    <div class="row justify-content-center pt-20">
                        <div class="">
                            <div id="counter"></div> 
                        </div>
                    </div>

                    <div class="row justify-content-center pt-4 pb-4">                            
                        <div class="question-box">
                            <div id="my-fonts-questions"></div>
                            <div id="questionsimg"></div>
                        </div>                          
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6 col-11">
                            <label class="shadow-box-options quizing-options" id="a">
                                <div class="table_q">
                                    <div class="tbody_q">
                                        <div class="tr_q">
                                            <div class="td_q quizing-op"><img alt="a" src="assets/images/a.png" class="options_img"></div>
                                            <div class="td_q questions-options-td"><span id="option_a" class="my-fonts"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <input type="radio" class="hiddenRadioButton" name="sample-radio" id="radio-01" value="a" />
                            </label>
                        </div>
                        <div class="col-md-6 col-11">
                            <label class="shadow-box-options quizing-options" id="b">
                                <div class="table_q">
                                    <div class="tbody_q">
                                        <div class="tr_q">
                                            <div class="td_q quizing-op"><img alt="b" src="assets/images/b.png" class="options_img"></div>
                                            <div class="td_q questions-options-td"><span id="option_b" class="my-fonts"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <input type="radio" class="hiddenRadioButton" name="sample-radio" id="radio-02" value="b" />
                            </label>
                        </div>
                    </div> 

                    <div class="row justify-content-center">
                        <div class="col-md-6 col-11">
                            <label class="shadow-box-options quizing-options" id="c">
                                <div class="table_q">
                                    <div class="tbody_q">
                                        <div class="tr_q">
                                            <div class="td_q quizing-op"><img alt="c" src="assets/images/c.png" class="options_img"></div>
                                            <div class="td_q questions-options-td"><span id="option_c" class="my-fonts"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <input type="radio" class="hiddenRadioButton" name="sample-radio" id="radio-03" value="c" />
                            </label>
                        </div>
                        <div class="col-md-6 col-11">
                            <label class="shadow-box-options quizing-options" id="d">
                                <div class="table_q">
                                    <div class="tbody_q">
                                        <div class="tr_q">
                                            <div class="td_q quizing-op"><img alt="d" src="assets/images/d.png" class="options_img"></div>
                                            <div class="td_q questions-options-td"><span id="option_d" class="my-fonts"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <input type="radio" class="hiddenRadioButton" name="sample-radio" id="radio-04" value="d" />
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </div> 

        <audio id="FirstLooped" loop="loop">
            <source src="assets/sounds/TimerSound/timer_groupevent.mp3"/>
        </audio>

        <audio id="endtime">
            <source src="assets/sounds/TimerSound/countdown_ten_to_one.mp3"/>
        </audio>  

        <audio id="Right">
            <source src="assets/sounds/TimerSound/rightsound.wav"/>
        </audio>   

        <audio id="wrong">
            <source src="assets/sounds/TimerSound/wrongsound.wav"/>
        </audio>  

        <script>
            window.exit = false;
            window.correct = 0;
            window.incorrect = 0;
            window.current_question = 1;
            window.count = 0;
            window.attempt = 0;
        </script>
        
        <?php include('include-js.php'); ?>
        
        <script src="assets/js/pages/practice.js"></script>

    </body> 
</html> 