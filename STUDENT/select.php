<?php 
session_start();
include_once "../INCLUDE/DBH_Exams_INC.php";
include_once "../INCLUDE/classes.php";

if ($_SESSION["usersUid"]==NULL){
	header("location: Log-in.php");
	exit();
}

if(empty($_SESSION["examname"]) !== false)
    $_SESSION["examname"]=$_POST["examname"];

$selected_topics= unserialize($_SESSION["selected_topics"]);
?>

<html>
    <head>
        <title>Topics - STUDENT PATH</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/Select.CSS">
        <link rel="stylesheet" href="../CSS/_footer_style.css">
		<link rel="stylesheet" href="../CSS/_header_style.css">
    </head>

<body>
<div class="main_view">
        <?php
            include_once "../INCLUDE/_header.php";
        ?>

    <div class="content_container_outer">
        <div class="content_container_inner">    
            <div class="examname_container">
                <div class='examname'><?php echo $_SESSION["examname"]; ?></div>

                <div class="select_all_container">
                                <label class="select_all_label">
                                    <div class="select_all_text">Select all</div>

                                    <svg class="check_mark" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 148.961 148.961" style="enable-background:new 0 0 148.961 148.961;" xml:space="preserve" fill="#ffffff" width="21px" height="21px">
                                    <g>
                                        <path d="M146.764,17.379c-2.93-2.93-7.679-2.929-10.606,0.001L68.852,84.697L37.847,53.691c-2.93-2.929-7.679-2.93-10.606-0.001
                                            c-2.93,2.929-2.93,7.678-0.001,10.606l36.309,36.311c1.407,1.407,3.314,2.197,5.304,2.197c1.989,0,3.897-0.79,5.304-2.197
                                            l72.609-72.622C149.693,25.057,149.693,20.308,146.764,17.379z"/>
                                        <path d="M130.57,65.445c-4.142,0-7.5,3.357-7.5,7.5v55.57H15V20.445h85.57c4.143,0,7.5-3.357,7.5-7.5c0-4.142-3.357-7.5-7.5-7.5
                                            H7.5c-4.142,0-7.5,3.357-7.5,7.5v123.07c0,4.143,3.358,7.5,7.5,7.5h123.07c4.143,0,7.5-3.357,7.5-7.5v-63.07
                                            C138.07,68.803,134.713,65.445,130.57,65.445z"/>
                                    </g>
                                    </svg>

                                    <input type="checkbox" class="checkbox_select_all" id="select-all" check_all="false">
                                </label>
                            </div>
            </div>

            <div class="topics_container">
                <div class="topics_select">
                    <form action='../INCLUDE/Exam_Set_Up.php' method='POST'> 
                        <?php
                        for($i=0 ; $i < count($selected_topics->topics) ; $i++){
                        ?>
                            <label class="topic">
                                <div class="topic_numbering">
                                    <?php echo $i+1 ; ?>
                                </div>

                                <div class="topic_checkmark_name">
                                        <input type='checkbox' class='topic_checkbox' id='<?php echo "CB".$i;?>' name='chk[]' value='<?php echo "topic".($i+1);?>'>
                                        <div class='topic_name'><?php echo $selected_topics->topics[$i];?></div>

                                        <svg class="check_mark_for_each" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 148.961 148.961" style="enable-background:new 0 0 148.961 148.961;" xml:space="preserve" fill="#cccccc" width="21px" height="21px">
                                        <g>
                                            <path d="M146.764,17.379c-2.93-2.93-7.679-2.929-10.606,0.001L68.852,84.697L37.847,53.691c-2.93-2.929-7.679-2.93-10.606-0.001
                                                c-2.93,2.929-2.93,7.678-0.001,10.606l36.309,36.311c1.407,1.407,3.314,2.197,5.304,2.197c1.989,0,3.897-0.79,5.304-2.197
                                                l72.609-72.622C149.693,25.057,149.693,20.308,146.764,17.379z"/>
                                            <path d="M130.57,65.445c-4.142,0-7.5,3.357-7.5,7.5v55.57H15V20.445h85.57c4.143,0,7.5-3.357,7.5-7.5c0-4.142-3.357-7.5-7.5-7.5
                                                H7.5c-4.142,0-7.5,3.357-7.5,7.5v123.07c0,4.143,3.358,7.5,7.5,7.5h123.07c4.143,0,7.5-3.357,7.5-7.5v-63.07
                                                C138.07,68.803,134.713,65.445,130.57,65.445z"/>
                                        </g>
                                        </svg>
                                    </div>
                            </label>
                        <?php
                        }
                        ?>

                        <div class='topics_lower_container'>
                            <div class="hint">At least 4 topics must be selected</div>
                            <button type='submit' name='enroll' class='submit_button'>Begin</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>   
    </div>

        <?php
            include_once "../INCLUDE/_Footer.php";
        ?>
</div>


    <script type="text/javascript">
        function checkall(master,cn){
            var CBarray= document.getElementsByClassName(cn);
                for(var i=0 ; i < CBarray.length ; i++){
                    var cb = document.getElementById(CBarray[i].id);
                    cb.checked= master.checked;
                }
        }

        const header_navbar_button = document.querySelector(".header_navigation_container_button");
        const header_navbar = document.querySelector(".header_navigation_container");

            document.addEventListener("click" , function(event){
                let view = header_navbar_button.getAttribute("view");

                if(event.target.closest(".header_navigation_container_button")){
                    if(view === "false"){
                    header_navbar.style.display="block";
                    header_navbar_button.setAttribute("view" , "true");
                    }
                }

                if(event.target.closest(".header_navigation_container"))
                    return;

                else if(!event.target.closest(".header_navigation_container") && view === "true"){
                    header_navbar.style.display="none";
                    header_navbar_button.setAttribute("view" , "false");
                }
            });


        const topics_checkbox = document.querySelectorAll(".topic_checkbox");
        const division = document.querySelectorAll(".topic_checkmark_name");
        const checkmark = document.querySelectorAll(".check_mark_for_each");
        const topics = document.querySelectorAll(".topic");
            for(let i = 0 ; i < topics.length ; ++i){
                topics[i].addEventListener("click" , function(){
                    if (topics_checkbox[i].checked == true){
                        division[i].style.backgroundColor="#eeeeee";
                        checkmark[i].setAttribute("fill", "#14213D");
                    }

                    else{
                        division[i].style.backgroundColor="#f7f7f7";
                        checkmark[i].setAttribute("fill", "#cccccc");
                    }
                });
            }

        const check_all = document.querySelector(".checkbox_select_all");
            check_all.addEventListener("click" , function(){
                if(check_all.getAttribute("check_all") === "false"){
                    for(let i = 0 ; i < topics_checkbox.length ; ++i){
                        division[i].style.backgroundColor="#eeeeee";
                        checkmark[i].setAttribute("fill", "#14213D");
                        topics_checkbox[i].checked = true;
                    }
                    check_all.setAttribute("check_all","true");
                }

                else if(check_all.getAttribute("check_all") === "true"){
                    for(let i = 0 ; i < topics_checkbox.length ; ++i){
                        topics_checkbox[i].checked = false;
                        division[i].style.backgroundColor="#f7f7f7";
                        checkmark[i].setAttribute("fill", "#cccccc");
                    }
                    check_all.setAttribute("check_all","false");
                }
            });
    </script>

</body>
</html>