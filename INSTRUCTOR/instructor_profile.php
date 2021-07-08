<?php
session_start();

if ($_SESSION["userUid"]==NULL){
	header("location: Log-in.php");
	exit();
}

include_once "../INCLUDE/DBH_INC.php";
$user = $_SESSION["userUid"];

$q="SELECT userID,userUid,email,phone,day,month,year FROM instructors WHERE userUid=?;";
    $stmt= mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$q);
    mysqli_stmt_bind_param($stmt,"s", $user);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close();
?>

<html>

<head>
    <title>My profile - STUDENT PATH</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/INS_update_profile.css">
    <link rel="stylesheet" href="../CSS/_footer_style.css">
	<link rel="stylesheet" href="../CSS/_header_style.css">
</head>

<body>
    <div class="main_view">
        <div class="header_container">
            <div class="header">
                <div class="logo_container">
                    <a href="INS_MAIN.php" class="logo_text"><h1>Student path<span class="logo_mini">INSTRUCTOR</span></h1></a>
                </div>

                <button class="header_navigation_container_button" view="false">
                    <img src="../CSS/navigation_icon_24.png" class="navigation_image">

                    <div class="header_navigation_container">
                        <a class="user_profile_anchor"><?php echo $_SESSION["userUid"]; ?></a>
                        <a href="../index.php" class="log_out_anchor">Log out</a>
                    </div>
                </button>
            </div> 
        </div>
        
        <div class="content_container_outer">
            <div class="content_container_inner">
                <div class="my_profile_header_container">
                    <div class="my_profile_header_text">
                        My profile
                    </div>

                    <div class="profile_id">
                        <div><?php echo $data["userID"];?></div>
                    </div>
                </div>

                <form action="../INCLUDE/INS_update_profile.php" method="POST">
                    <input type="hidden" value="<?php echo $data["userID"]; ?>" name="id">
                    
                    <div class="profile_info_container">
                        <div class="profile_name">
                            <label class="profile_info_tag">Username:</label>
                            <div class="input_control">
                                <div class="name_before"><?php echo $data["userUid"]; ?></div>
                            </div>
                            <input type="hidden" value="<?php echo $_SESSION["userUid"]; ?>" name="old_username">
                        </div>

                        <div class="profile_date">
                            <label class="profile_info_tag">Birth date:</label>
                            <div class="birth">  
                                <div class="input_control">
                                    <div class="day"><?php echo $data["day"]; ?></div>
                                        <span class='dash'>/</span>
                                    <div class="month"><?php echo $data["month"]; ?></div>
                                        <span class='dash'>/</span>
                                    <div class="year"><?php echo $data["year"]; ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="profile_email">
                            <label class="profile_info_tag">E-mail:</label>
                            <div class="input_control">
                                <div class="email_before"><?php echo $data["email"]; ?></div>
                            </div>
                        </div>

                        <div class="profile_phone">
                            <label class="profile_info_tag">Phone:</label>
                            <div class="input_control">
                                <div class="phone_before"><?php echo $data["phone"]; ?></div>
                            </div>
                        </div>

                        <div class="profile_password">
                            <label class="profile_info_tag">New password:</label>
                            <div class="input_control">
                                <div class="password_before"></div>
                            </div>
                        </div>

                        <div class="profile_password">
                            <label class="profile_info_tag">Repeat password:</label>
                            <div class="input_control">
                                <div class="repeat_password_before"></div>
                            </div>
                        </div>

                        <div class="button_contianer">
                            <button class="edit_button" type="button">Edit profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php
            include_once "../INCLUDE/_Footer.php";
        ?>
    </div>

    <script type="text/javascript">
        const edit_button = document.querySelector(".edit_button");
        const input_controllers = document.querySelectorAll(".input_control");
        const username = document.querySelector(".name_before").innerHTML;
        const day = document.querySelector(".day");
        const day_value = document.querySelector(".day").innerHTML;
        const month = document.querySelector(".month");
        const month_value = document.querySelector(".month").innerHTML;
        const year = document.querySelector(".year");
        const year_value = document.querySelector(".year").innerHTML;
        const email_value = document.querySelector(".email_before").innerHTML;
        const phone_value = document.querySelector(".phone_before").innerHTML;
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

            edit_button.addEventListener("click" , function(){
                for(let i = 0 ; i < input_controllers.length ; ++i){
                    if(i === 0){
                        input_controllers[i].innerHTML="<input type='textbox' value='"+username+"' name='username' class='name_after' autocomplete='off'>";
                    }

                    else if(i === 1){
                        input_controllers[i].innerHTML="<div class='birth_day_input_container' view='false'></div>";
                        input_controllers[i].innerHTML+="<span class='dash_dark'> / </span>";
                        input_controllers[i].innerHTML+="<div class='birth_month_input_container' view='false'></div>";
                        input_controllers[i].innerHTML+="<span class='dash_dark'> / </span>";
                        input_controllers[i].innerHTML+="<div class='birth_year_input_container' view='false'></div>";

                        birth_day_input_container = document.querySelector(".birth_day_input_container");
                        birth_day_input_container.innerHTML+="<input type='textbox' class='day_input' value='"+day_value+"' name='day' autocomplete='off'>";
                        birth_day_input_container.innerHTML+="<div class='days_list_select'></div>";
                        days_list_select = document.querySelector(".days_list_select");
                        for(let j = 1 ; j <= 31 ; ++j){
                            days_list_select.innerHTML+="<span class='list_select_input_days'>"+j+"</span>";
                        }

                        birth_month_input_container = document.querySelector(".birth_month_input_container");
                        birth_month_input_container.innerHTML+="<input type='textbox' class='month_input' value='"+month_value+"' name='month' autocomplete='off'>";
                        birth_month_input_container.innerHTML+="<div class='months_list_select'></div>";
                        month_list_select=document.querySelector(".months_list_select");
                        month_list_select.innerHTML+="<span class='list_select_input_months'>January</span>";
                        month_list_select.innerHTML+="<span class='list_select_input_months'>February</span>";
                        month_list_select.innerHTML+="<span class='list_select_input_months'>March</span>";
                        month_list_select.innerHTML+="<span class='list_select_input_months'>April</span>";
                        month_list_select.innerHTML+="<span class='list_select_input_months'>May</span>";
                        month_list_select.innerHTML+="<span class='list_select_input_months'>June</span>";
                        month_list_select.innerHTML+="<span class='list_select_input_months'>July</span>";
                        month_list_select.innerHTML+="<span class='list_select_input_months'>August</span>";
                        month_list_select.innerHTML+="<span class='list_select_input_months'>September</span>";
                        month_list_select.innerHTML+="<span class='list_select_input_months'>October</span>";
                        month_list_select.innerHTML+="<span class='list_select_input_months'>November</span>";
                        month_list_select.innerHTML+="<span class='list_select_input_months'>december</span>";

                        birth_year_input_container = document.querySelector(".birth_year_input_container");
                        birth_year_input_container.innerHTML+="<input type='textbox' class='year_input' value='"+year_value+"' name='year' autocomplete='off'>";
                        birth_year_input_container.innerHTML+="<div class='years_list_select'></div>";
                        years_list_select=document.querySelector(".years_list_select");
                        for(let j = 1930 ; j <= 2003 ; ++j){
                            years_list_select.innerHTML+="<span class='list_select_input_years'>"+j+"</span>";
                        }
                        
                        const select_day = document.querySelectorAll(".list_select_input_days");
                            for(let i =0 ; i < select_day.length ; ++i){
                                select_day[i].addEventListener("click" , function(){
                                    let value = select_day[i].innerHTML;
                                    document.getElementsByClassName("day_input")[0].value = value;
                                });
                            }

                            const select_month = document.querySelectorAll(".list_select_input_months");
                            for(let i =0 ; i < select_month.length ; ++i){
                                select_month[i].addEventListener("click" , function(){
                                    let value = select_month[i].innerHTML;
                                    document.getElementsByClassName("month_input")[0].value = value;
                                });
                            }

                            const select_year = document.querySelectorAll(".list_select_input_years");
                            for(let i =0 ; i < select_year.length ; ++i){
                                select_year[i].addEventListener("click" , function(){
                                    let value = select_year[i].innerHTML;
                                    document.getElementsByClassName("year_input")[0].value = value;
                                });
                            }
                    }

                    else if(i === 2){
                        input_controllers[i].innerHTML="<input type='text' name='email' value='"+email_value+"' class='email_after' autocomplete='off'>";
                    }

                    else if(i === 3){
                        input_controllers[i].innerHTML="<input type='text' name='phone' value='"+phone_value+"' class='phone_after' maxlength='10' autocomplete='off'>";
                    }

                    else if(i === 4){
                        input_controllers[i].innerHTML="<input type='password' name='new_password' class='password_after' autocomplete='off'>";
                    }

                    else if(i === 5){
                        input_controllers[i].innerHTML="<input type='password' name='repeat_password' class='password_after' autocomplete='off'>";
                    }
                }

                button_container = document.querySelector(".button_contianer");
                button_container.innerHTML="<button class='submit_button' type='submit' name='submit'>Save</button>";
            });

            document.addEventListener("click" , function(event){
            let view_day = document.querySelector(".birth_day_input_container").getAttribute("view");
            let view_month = document.querySelector(".birth_month_input_container").getAttribute("view");
            let view_year = document.querySelector(".birth_year_input_container").getAttribute("view");

            if(event.target.closest(".day_input")){
                if(view_day === "false"){
                    document.querySelector(".days_list_select").style.display="block";
                    document.querySelector(".birth_day_input_container").setAttribute("view" , "true");
                }
            }

            if(event.target.closest(".days_list_select"))
                return;

            else if(!event.target.closest(".days_list_select") && view_day === "true"){
                document.querySelector(".days_list_select").style.display="none";
                    document.querySelector(".birth_day_input_container").setAttribute("view" , "false");
            }

            if(event.target.closest(".month_input")){
                if(view_month === "false"){
                    document.querySelector(".months_list_select").style.display="block";
                    document.querySelector(".birth_month_input_container").setAttribute("view" , "true");
                }
            }

            if(event.target.closest(".months_list_select"))
                return;

            else if(!event.target.closest(".months_list_select") && view_month === "true"){
                document.querySelector(".months_list_select").style.display="none";
                    document.querySelector(".birth_month_input_container").setAttribute("view" , "false");
            }

            if(event.target.closest(".year_input")){
                if(view_year === "false"){
                    document.querySelector(".years_list_select").style.display="block";
                    document.querySelector(".birth_year_input_container").setAttribute("view" , "true");
                }
            }

            if(event.target.closest(".years_list_select"))
                return;

            else if(!event.target.closest(".years_list_select") && view_year === "true"){
                document.querySelector(".years_list_select").style.display="none";
                    document.querySelector(".birth_year_input_container").setAttribute("view" , "false");
            }
        });


    </script>

</body>
</html>