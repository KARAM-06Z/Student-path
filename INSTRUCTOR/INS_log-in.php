<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Instructor Log in - STUDENT PATH</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/INS_loginstyle.css">
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
			<div class="content_container_inner">
				<div class="log_in_header_contianer">
					<div class="log_in_header_text">
                        Log in form
                    </div>
				</div>

				<div class="log_in_info_container">
					<form action="../INCLUDE/INS_login_INC.php" method="post">
						<div class="profile_name">
							<label class="profile_info_tag">User name</label>
							<input class="username_input" type="textbox" name="username" autofocus autocomplete="off">
						</div>

						<div class="profile_password">
							<label class="profile_info_tag">Password</label>
							<input class="password_input" type="password" name="password" autocomplete="off">
						</div>
						
						<div class="button_contianer">
							<button class="submit_button" type="submit" name="login">Log in</button>
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

</body>
</html>