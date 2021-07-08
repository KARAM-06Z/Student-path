<div class="header_container">
    <div class="header">
        <div class="logo_container">
            <?php 
                if(isset($_SESSION["usersUid"])){?>
                    <a href="Student_MAIN.php" class="logo_text"><h1>Student path</h1></a>
                <?php
                }

                else if(isset($_SESSION["userUid"])){?>
                    <a href="INS_MAIN.php" class="logo_text"><h1>Student path<span class="logo_mini">INSTRUCTOR</span></h1></a>
                <?php
                }
            ?>
        </div>

        <button class="header_navigation_container_button" view="false">
            <img src="../CSS/navigation_icon_24.png" class="navigation_image">

            <div class="header_navigation_container">

                <?php 
                    if(isset($_SESSION["usersUid"])){?>
                        <a class="user_profile_anchor"><?php echo $_SESSION["usersUid"];?></a> 
                        <a href="../STUDENT/student_profile.php" class="my_profile_anchor">My profile</a> 
                <?php
                    }

                    else if(isset($_SESSION["userUid"])){?>
                        <a class="user_profile_anchor"><?php echo $_SESSION["userUid"];?></a> 
                        <a href="../INSTRUCTOR/instructor_profile.php" class="my_profile_anchor">My profile</a> 
                <?php
                    }
                ?> 
                <a href="../index.php" class="log_out_anchor">Log out</a>
            </div>
        </button>
    </div> 
</div>