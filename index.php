<?php
session_start();
session_unset();
session_destroy();
?>

<html>
<head>
	<title>STUDENT PATH</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="CSS/index.CSS">
</head>
<body>

<div class="main_view">
		<div class="header_log_in_upper_content">
            <div class="header">
                <div class="logo_container">
                    <a href="index.php" class="logo_text"> <h1>Student path</h1> </a>
                </div>

                <div class="header_navigation_container">
                    <a href="STUDENT/Sign-up.php" class="sign_up_anchor">Sign up</a>
                </div>
            </div> 
            
            <div class="log_in_welcoming_view_container">
                <div class="welcome_text_road_container">
                    <div class="welcome_text_container">
                        <div class="test_yourself">
                            TEST YOURSELF
                        </div>

                        <div class="find_your_path">
                            Find your own path to <span>success</span>.
                        </div>
                    </div>
                </div>

                <div class="log_in_container">
                    <div class="log_in_text">
                        LOG IN FORM
                    </div>

                    <div class="log_in_form_container">
                        <form class="log_in_form" method="POST" action="INCLUDE/Login_INC.php">
                            <label class="username_label">
                                <span class="username_header_text">Username: </span>
                                <input class="username_input" type="textbox" name="username" placeholder="example123">
                            </label>

                            <label class="password_label">
                                <span class="password_header_text">Password: </span>
                                <input class="password_input" type="password" name="password">
                            </label>

                            <div class="submit_button_container">
                                <button class="submit_button" type="submit" name="login">Log in</button>
                            </div>
                        </form>
                    </div>

                    
                    <div class="sign_up_question_container">
                        <div class="sign_up_question">
                            Dont have an account?
                        </div>

                        <div class="sign_up_here">
                            Create one <a href="STUDENT/Sign-up.php">here</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="student_features_container">
            <div class="features_container_outer">
                <div class="features_container_inner">
                    <div class="feature_number_and_context_container">
                        <a href="#features" class="scroll_anchor">
                            <div class="feature_number_container_outer">
                                <div class="feature_number_container_inner">
                                    <div class="number">
                                        1
                                    </div>
                                </div>
                            </div>

                            <div class="feature">
                                Select a material
                            </div>
                        </a>
                    </div>
                </div>

                <div class="features_container_inner">
                    <div class="feature_number_and_context_container">
                        <a href="#features" class="scroll_anchor">
                            <div class="feature_number_container_outer">
                                <div class="feature_number_container_inner">
                                    <div class="number">
                                        2
                                    </div>
                                </div>
                            </div>

                            <div class="feature">
                                Select the desired topics
                            </div>
                        </a>
                    </div>
                </div>

                <div class="features_container_inner">
                    <div class="feature_number_and_context_container">
                        <a href="#features" class="scroll_anchor">
                            <div class="feature_number_container_outer">
                                <div class="feature_number_container_inner">
                                    <div class="number">
                                        3
                                    </div>
                                </div>
                            </div>

                            <div class="feature">
                                Begin to examine yourself
                            </div>
                        </a>
                    </div>
                </div>

                <div class="features_container_inner">
                    <div class="feature_number_and_context_container">
                        <a href="#features" class="scroll_anchor">
                            <div class="feature_number_container_outer">
                                <div class="feature_number_container_inner">
                                    <div class="number">
                                        4
                                    </div>
                                </div>
                            </div>

                            <div class="feature">
                                Review your answers
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="features_explanation_container" id="features">
            <div class="features_explanation">
                <div class="feature_image_para_container_all">
                    <div class="feature_image_para_container">
                        <div class="feature_image_container">
                            <img src="CSS/feature_select_exam.png">
                        </div>

                        <div class="feature_paragrapgh_container">
                            <p class="feature_paragrapgh">A wide verity of materails and exams to choose from, Created by instructors that are trusted by our team and have the knowledge in the material he teaches.</p>
                        </div>
                    </div>

                    <div class="feature_image_para_container">
                        <div class="feature_image_container">
                            <img src="CSS/feature_select_topic.png">
                        </div>

                        <div class="feature_paragrapgh_container">
                            <p class="feature_paragrapgh">Each material has it's own topics of ten and each topic has its own unique carefully made questions, You can choose as minimum of two topics.</p> 
                        </div>
                    </div>

                    <div class="feature_image_para_container">
                        <div class="feature_image_container">
                            <img src="CSS/examination.png">
                        </div>

                        <div class="feature_paragrapgh_container">
                            <p class="feature_paragrapgh">The exam consists of 20 computer random generated questions, Each time you try an exam and each time you select different topics the exam will contain different and new questions.</p>
                        </div>
                    </div>

                    <div class="feature_image_para_container">
                        <div class="feature_image_container">
                            <img src="CSS/Review.png">
                        </div>

                        <div class="feature_paragrapgh_container">
                            <p class="feature_paragrapgh">Review your attempt, Find your mistakes and learn from them, Keep testing yourself with different questions so you can get better at the material.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="excel_feature_container">
            <div class="excel_feature_inner">
                <div class="excel_logo_container">
                    <img src="CSS/excel-logo.png" class="excel_logo">
                </div>

                <div class="excel_feature_paragraph_container">
                        <h1 class="excel_paragraph_header">Microsoft Excel</h1>
                    <p class="excel_paragraph">As an instructor, easily create your own exams in Microsoft Excel and upload them on STUDENT PATH for your students or others who might need help to study.</p>
                    <p class="excel_paragraph">Easy uplaod, In a few seconds your exam will be uploaded and ready to use by the students.</p>
                </div>
            </div>
        </div>

    <div class="footer_container">
        <div class="footer_content">
            <div class="footer_navigation_container">
                <div class="additional">
                    <div class="tag">Additional </div>
                    <div class="link_container">
                        <a href="">Help</a>
                    </div>

                    <div class="link_container">
                        <a href="">Our message</a>
                    </div>

                    <div class="link_container">
                        <a href="">Feedback</a>
                    </div>

                    <div class="link_container">
                        <a href="" class="mobile-contact">Contact us</a>
                    </div>
                </div>

                <div class="contact">
                    <div class="tag">Contact us</div>
                    <div class="email"><span>&#9993;</span> Karam: <a href = "mailto:karam_obida@yahoo.com">karam_obida@yahoo.com</a></div>
                </div>

                <div class="instructor">
                    <div class="tag">Instructor</div>
                    <div class="link_container">
						<a href="INSTRUCTOR/INS_log-in.php">Instructor log in</a>
                    </div>
                    <div class="link_container">
                        <a href="INSTRUCTOR/INS_Sign-up.php">Become an instructor</a>
                    </div>
                </div>

                <div class="HU_logo_container">
                    <img src="CSS/HU-logo.png" class="HU">
                </div>

            </div>
            
            <div class="credits_container">
                <div class="credits">Created by Karam,Waseem and Al-monther as a graduation project 2020-2021</div>
            </div>
        </div>
    </div>
</div>

<script>
    const scroll_anchor = document.querySelectorAll(".scroll_anchor");
    const feature = document.querySelectorAll(".feature_image_para_container");
        for(let i = 0 ; i < scroll_anchor.length ; ++i){
            scroll_anchor[i].addEventListener("click" , function(){
                feature[i].style.backgroundColor = "rgb(252, 163, 17 , 0.3)";

                setTimeout(function(){
                    feature[i].style.backgroundColor = "transparent";
                }, 1000);
            });
        }
</script>
</body>
</html>