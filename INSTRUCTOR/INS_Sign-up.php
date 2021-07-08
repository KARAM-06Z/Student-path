<html>
<head>
	<title>Instructor Sign up - Student Path</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/INS_Signupstyle.css">
</head>
<body>

	<div class="main_view">
		<div class="header_container">
			<div class="header">
				<div class="logo_container">
					<a href="../index.php" class="logo_text"> <h1>Student path<span class="logo_mini">INSTRUCTOR</span></h1></a>
				</div>
			</div>
		</div>

		<div class="content_container_outer">
			<?php 
				if($_GET["error"] === "none" && $_GET["user"] === "registered"){
			?>
			<div class="content_container_inner_thanking" content="thanking">
				<div class="thanking_header_contianer">
					<div class="thanking_header_text">
                        thank you
                    </div>
				</div>

				<div class="paragraph_container">
					<div class="paragraph_text_container">
						<img src="../CSS/tick.png" class="paragraph_icon">
						<p class="paragraph_text">You have successfully sent a request to register an account in STUDENT PATH as an instructor.</p>
					</div>

					<div class="paragraph_text_container">
						<img src="../CSS/clock.png" class="paragraph_icon">
						<p class="paragraph_text">please wait about 2 work days, we will contact you as soon as possible.</p>
					</div>

					<div class="redirection">
						Click <a href="../index.php">here</a> to go back to the main page.
					</div>
				</div>

			</div>
			<svg xmlns="http://www.w3.org/2000/svg" class="background_medal" fill="#fca311" id="Icons" viewBox="0 0 74 74" width="900" height="900"><path d="M27.1,72h-.014a1,1,0,0,1-.912-.622l-3.221-7.89-7.742,3.533a1,1,0,0,1-1.33-1.314L22.31,46.636a1,1,0,0,1,1.83.809L16.776,64.109l6.3-2.873a1,1,0,0,1,1.341.532l2.725,6.673,7.9-17.915a1,1,0,0,1,1.83.807L28.018,71.4A1,1,0,0,1,27.1,72Z"/><path d="M31.1,53.436a3.654,3.654,0,0,1-.957-.123c-1.493-.4-2.491-1.7-3.372-2.85a7.381,7.381,0,0,0-1.8-1.9,7.511,7.511,0,0,0-2.6-.634c-1.49-.2-3.031-.406-4.1-1.477s-1.279-2.614-1.478-4.105a7.556,7.556,0,0,0-.634-2.595,7.431,7.431,0,0,0-1.9-1.8c-1.15-.881-2.452-1.879-2.851-3.371-.383-1.433.2-2.855.768-4.229a7.657,7.657,0,0,0,.764-2.629,7.658,7.658,0,0,0-.764-2.628c-.566-1.374-1.151-2.8-.768-4.229.4-1.492,1.7-2.49,2.851-3.371a7.416,7.416,0,0,0,1.9-1.806,7.522,7.522,0,0,0,.633-2.594c.2-1.491.4-3.032,1.478-4.1s2.613-1.278,4.1-1.478a7.511,7.511,0,0,0,2.6-.634,7.408,7.408,0,0,0,1.8-1.9c.88-1.15,1.879-2.452,3.371-2.851,1.433-.387,2.855.2,4.229.768A7.659,7.659,0,0,0,37,3.653a7.659,7.659,0,0,0,2.629-.763c1.374-.566,2.8-1.152,4.228-.769,1.493.4,2.491,1.7,3.372,2.851a7.4,7.4,0,0,0,1.8,1.9,7.489,7.489,0,0,0,2.595.633c1.49.2,3.031.406,4.1,1.478s1.279,2.614,1.478,4.1a7.55,7.55,0,0,0,.634,2.6,7.4,7.4,0,0,0,1.9,1.8c1.15.881,2.452,1.88,2.851,3.371.383,1.434-.2,2.855-.768,4.23a7.658,7.658,0,0,0-.764,2.628,7.646,7.646,0,0,0,.764,2.628c.566,1.375,1.151,2.8.768,4.23-.4,1.491-1.7,2.49-2.851,3.371a7.4,7.4,0,0,0-1.9,1.8,7.534,7.534,0,0,0-.633,2.594c-.2,1.491-.405,3.033-1.478,4.105s-2.613,1.278-4.1,1.477a7.509,7.509,0,0,0-2.595.635,7.408,7.408,0,0,0-1.8,1.9c-.88,1.149-1.879,2.452-3.371,2.851-1.435.385-2.855-.2-4.229-.768A7.637,7.637,0,0,0,37,51.782a7.637,7.637,0,0,0-2.629.763A8.88,8.88,0,0,1,31.1,53.436ZM31.1,4a1.708,1.708,0,0,0-.441.054c-.835.223-1.547,1.152-2.3,2.135A8.85,8.85,0,0,1,25.968,8.6a8.969,8.969,0,0,1-3.332.885,5.413,5.413,0,0,0-2.955.91,5.4,5.4,0,0,0-.91,2.955,8.977,8.977,0,0,1-.884,3.331,8.858,8.858,0,0,1-2.416,2.391c-.983.754-1.911,1.466-2.135,2.3a5.366,5.366,0,0,0,.685,2.951,9.111,9.111,0,0,1,.915,3.39,9.1,9.1,0,0,1-.915,3.39,5.362,5.362,0,0,0-.685,2.952c.224.835,1.152,1.546,2.135,2.3a8.858,8.858,0,0,1,2.416,2.391,8.958,8.958,0,0,1,.884,3.331,5.419,5.419,0,0,0,.911,2.956,5.41,5.41,0,0,0,2.955.909,8.964,8.964,0,0,1,3.331.885,8.812,8.812,0,0,1,2.39,2.416c.754.982,1.466,1.911,2.3,2.134a5.386,5.386,0,0,0,2.95-.685A9.115,9.115,0,0,1,37,49.782a9.115,9.115,0,0,1,3.391.914,5.345,5.345,0,0,0,2.951.685c.835-.223,1.547-1.152,2.3-2.135a8.836,8.836,0,0,1,2.39-2.415,8.97,8.97,0,0,1,3.332-.886,5.4,5.4,0,0,0,2.955-.909,5.407,5.407,0,0,0,.91-2.955,8.972,8.972,0,0,1,.884-3.331,8.847,8.847,0,0,1,2.416-2.392c.983-.754,1.911-1.465,2.135-2.3a5.366,5.366,0,0,0-.685-2.951,9.1,9.1,0,0,1-.915-3.39,9.111,9.111,0,0,1,.915-3.39,5.357,5.357,0,0,0,.685-2.951c-.224-.835-1.152-1.546-2.135-2.3a8.858,8.858,0,0,1-2.416-2.391,8.963,8.963,0,0,1-.884-3.331,5.416,5.416,0,0,0-.911-2.956,5.4,5.4,0,0,0-2.955-.909A8.983,8.983,0,0,1,48.032,8.6a8.84,8.84,0,0,1-2.39-2.416c-.754-.983-1.466-1.911-2.3-2.135a5.369,5.369,0,0,0-2.95.686A9.134,9.134,0,0,1,37,5.653a9.134,9.134,0,0,1-3.391-.914A7.471,7.471,0,0,0,31.1,4Z"/><path d="M37,44.784A17.067,17.067,0,1,1,54.066,27.717,17.086,17.086,0,0,1,37,44.784Zm0-32.133A15.067,15.067,0,1,0,52.066,27.717,15.083,15.083,0,0,0,37,12.651Z"/><path d="M46.9,72a1,1,0,0,1-.915-.6L37.129,51.333a1,1,0,0,1,1.83-.807l7.9,17.915,2.725-6.673a1,1,0,0,1,1.341-.532l6.3,2.873L49.86,47.445a1,1,0,0,1,1.83-.809l8.426,19.071a1,1,0,0,1-1.33,1.314l-7.742-3.533-3.221,7.89a1,1,0,0,1-.912.622Z"/><path d="M42.47,36.625a.994.994,0,0,1-.465-.115L37,33.879,32,36.51a1,1,0,0,1-1.45-1.054l.956-5.572-4.049-3.947a1,1,0,0,1,.555-1.706l5.595-.812,2.5-5.07a1.041,1.041,0,0,1,1.792,0l2.5,5.07,5.595.812a1,1,0,0,1,.555,1.706L42.5,29.884l.956,5.572a1,1,0,0,1-.985,1.169ZM37,31.75a1,1,0,0,1,.465.114L41.142,33.8l-.7-4.093a1,1,0,0,1,.288-.885l2.973-2.9-4.109-.6a1,1,0,0,1-.753-.548L37,21.051l-1.838,3.724a1,1,0,0,1-.753.548l-4.109.6,2.973,2.9a1,1,0,0,1,.288.885l-.7,4.093,3.677-1.933A1,1,0,0,1,37,31.75Z"/></svg>
			<?php
				}

				else{
			?>

			<div class="content_container_inner_form" content="sign_up_form">
				<div class="sign_up_header_contianer">
					<div class="sign_up_header_text">
                        Sign up form
                    </div>
				</div>

				<form action="../INCLUDE/INS_Signup_INC.php" method="POST">
					<div class="profile_name">
						<label class="profile_info_tag">User name</label>
						<input type="textbox" class="username_input" name="username" autofocus autocomplete="off" placeholder="Only numbers and alphabets">
					</div>

					<div class="profile_email">
						<label class="profile_info_tag">E-mail</label>
						<input type="email" class="email_input" name="email" autocomplete="off" >
					</div>

					<div class="profile_phone">
						<label class="profile_info_tag">Phone number</label>
						<input type="textbox" class="phone_input" name="phone" maxlength="10" autocomplete="off" >
					</div>

					<div class="profile_birth">
						<label class="profile_info_tag">Birth date</label>
						<div class="birth">
							<div class='birth_day_input_container' view='false'>
								<input type="textbox" class="day_input" name="day" autocomplete="off">
							</div>

							<span class='dash_dark'> / </span>

							<div class='birth_month_input_container' view='false'>
								<input type="textbox" class="month_input" name="month" autocomplete="off">
							</div>

							<span class='dash_dark'> / </span>

							<div class='birth_year_input_container' view='false'>
								<input type="textbox" class="year_input" name="year" autocomplete="off">
							</div>
						</div>
					</div>

					<div class="button_contianer">
						<button class="submit_button" type="submit" name="submit">Sign up</button>
					</div>
				</form>
			</div>
			<?php
				}
			?>
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