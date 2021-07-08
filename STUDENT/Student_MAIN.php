<?php
require_once "../INCLUDE/DBH_INC.php";
require_once "../INCLUDE/DBH_ToDo_INC.php";

session_start();

if ($_SESSION["usersUid"]==NULL){
	header("location: Log-in.php");
	exit();
}
	
if(empty($_SESSION["examname"]) == false)
    $_SESSION["examname"]=null;
$_SESSION["access"]=false;

?>

<!DOCTYPE html>
<html>
    <head>
		<title>Student - STUDENT PATH</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/studentMain.css">
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
				<div class="content_navigator_container">
					<div class="content_navigation_header">
						Navigation
					</div>
					<button type="button" class="content_navigation_button" value="search"><img src="../CSS/search.png"> Search</button>
					<button type="button" class="content_navigation_button" value="exams"><img src="../CSS/exam.png"> Exams overview</button>
					<button type="button" class="content_navigation_button" value="todolist"><img src="../CSS/list.png"> To do list</button>
				</div>

				<div class="content_container">
					<div class="search_exams_container">
						<div class="search_header">
							<div class="search_text">Search</div>
						</div>

						<div class="search_container">
							<div class="search_input_container">
								<input type="textbox" class="search_input" placeholder="Search...">
								<img src="../CSS/search_28.png" class="input_search_image">
							</div>
						</div>

						<div class="searched_exams_container">
							<div class="search_something_container">
								<img src='../CSS/search_128.png' class="search_something_image">

								<div class="search_something">
									Search something by typing in the input field
								</div>
							</div>
						</div>
					</div>

					<div class="available_exams_container">
						<div class="exams_overview_header">
							<div class="exams_overview_text">Exams overview</div>
						</div>

						<div class="exams_overview_container"></div>
					</div>

					<div class="to_do_list_container">
						<div class="to_do_list_header">
							<div class="to_do_list_text">To do list</div>
						</div>

						<?php
							$todo_ARR= array();
							$i=0;
							$user=$_SESSION["usersUid"];

							$q="SELECT exam FROM $user;";
								$stmt= mysqli_stmt_init($conn_todo);
									mysqli_stmt_prepare($stmt,$q);
									mysqli_stmt_execute($stmt);

								$resultData= mysqli_stmt_get_result($stmt);
									while($row= mysqli_fetch_assoc($resultData)){
										$todo_ARR[$i] = $row["exam"];
										$i++;
									}

								mysqli_stmt_close($stmt);
							
							if(count($todo_ARR) > 0){
								?>
								<div class='to_do_list_not_empty'>
									<?php
									for($i=0 ; $i < count($todo_ARR) ; $i++){
										?>
										<div class='exam_in_to_do'>
											<form action='select.php' method='POST' class='select_form'>
												<span class='to_do_numbering'><?php echo ($i+1)."- ";?></span>
												<button type='submit' class='exam_input_to_do' name='examname' value="<?php echo $todo_ARR[$i] ; ?>"><?php echo $todo_ARR[$i]; ?></button>
											</form>

											<div class="more_options_button" view="false">
												<img src='../CSS/more_options_dark.png' class='more_options_image'>

												<div class="more_options_list_container">
													<form action='../INCLUDE/remove.php' method='POST' class='todo_button_form'>
														<button type='submit' name='examname' value="<?php echo $todo_ARR[$i]; ?>" class='todo_button'>Remove from list</button>
													</form>
												</div>
											</div>
										</div>
									<?php
								}?>
								</div>
								<?php
							}

							else{?>
								<div class='to_do_list_is_empty'>
									<img src='../CSS/empty-folder_128.png' class="empty_list_image">
									<div class='empty_list_text'> List is empty, Add exams so you can easily find them here</div>
								</div>
							<?php
							}
						?>
						</div>
					</div>
				</div>
			</div>
			<?php
			include_once "../INCLUDE/_Footer.php";
			?>
		</div>
	</div>

<script src="../JS/studentMAIN.js"></script>
</body>
</html>

