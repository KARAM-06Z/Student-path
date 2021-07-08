<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign up - Student Path</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/signupStyle.css">
</head>
<body>

	<div class="main_view">
		<div class="header_container">
			<div class="header">
				<div class="logo_container">
					<a href="../index.php" class="logo_text"> <h1>Student path</h1> </a>
				</div>
			</div>
		</div> 

		<div class="content_container_outer">
			<div class="content_container_inner">
				<div class="signup_header_contianer">
					<div class="sign_up_header_text">
                        Sign up form
                    </div>
				</div>

				<div class="sign_up_info_container">
					<form action="../INCLUDE/Signup_INC.php" method="post">
						<div class="profile_name">
							<label class="profile_info_tag">User name</label>
							<input class='username_input' type="textbox" name="username" autofocus autocomplete="off" placeholder="Only numbers and alphabets">
						</div>
						
						<div class="profile_date">
							<label class="profile_info_tag">Birth date</label>
							<div class="birth">
								<div class='birth_day_input_container' view='false'>
									<input type='textbox' class='day_input' name='day' autocomplete='off'>
								</div>
								<span class='dash_dark'> / </span>

								<div class='birth_month_input_container' view='false'>
									<input type='textbox' class='month_input' name='month' autocomplete='off'>
								</div>
								<span class='dash_dark'> / </span>

								<div class='birth_year_input_container' view='false'>
									<input type='textbox' class='year_input' name='year' autocomplete='off'>
								</div>
							</div>
						</div>

						<div class="profile_password">
							<label class="profile_info_tag">Password</label>
							<input type="password" name="password" class="password_input"  autocomplete="off">
						</div>

						<div class="profile_password">
							<label class="profile_info_tag">Repeat password</label>
							<input type="password" name="passwordrepeat" class="password_input" autocomplete="off">
						</div>

						<div class="button_contianer">
							<button class="submit_button" type="submit" name="submit">Sign up</button>
                        </div>
					</form>
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
							<a href="../INSTRUCTOR/INS_log-in.php">Instructor log in</a>
						</div>
						<div class="link_container">
							<a href="../INSTRUCTOR/INS_Sign-up.php">Become an instructor</a>
						</div>
					</div>

					<div class="HU_logo_container">
						<img src="../CSS/HU-logo.png" class="HU">
					</div>

				</div>
				
				<div class="credits_container">
					<div class="credits">Created by Karam,Waseem and Al-monther as a graduation project 2020-2021</div>
				</div>
			</div>
    	</div>
	</div>


<script type="text/javascript">
	document.addEventListener("DOMContentLoaded" , function(event){
		birth_day_input_container = document.querySelector(".birth_day_input_container");
		birth_day_input_container.innerHTML+="<div class='days_list_select'></div>";
		days_list_select = document.querySelector(".days_list_select");
		for(let j = 1 ; j <= 31 ; ++j){
			days_list_select.innerHTML+="<span class='list_select_input_days'>"+j+"</span>";
		}

		birth_month_input_container = document.querySelector(".birth_month_input_container");
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