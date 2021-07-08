document.addEventListener("DOMContentLoaded", function() { 
    let set_nav_button = document.querySelectorAll(".content_navigation_button");
        set_nav_button[1].style.backgroundColor="#14213D";
        set_nav_button[1].style.color="#ffffff";


    var request = new XMLHttpRequest();
    const url = "../API/getAllExams.php";

    request.open("GET" , url , true);
    request.send();

    request.onreadystatechange = function(){
        if(this.readyState === 4 && this.status === 200){
            var json = JSON.parse(this.responseText);

            for(let i = 0 ; i < json.length ; ++i){
                let owner_name = json[i].owner_name;
                let exam_name = json[i].exam_name;
                let likes = parseInt(json[i].likes);
                let unlikes = parseInt(json[i].unlikes);

                if(likes != 0 || unlikes != 0){
                    let ratio_value = likes / (likes + unlikes) * 100;
                    let ratio_value_rounded= Math.round(ratio_value * 10) / 10;
                    var ratio_value_text = ratio_value_rounded+"%";
                }

                else{
                    var ratio_value_text = "Not rated yet";
                }

                let exam = document.createElement("div");
                exam.className="exam";
                
                let card="<div class='exam_upper'>";
                    card+="<form class='select_form' action='../INCLUDE/Set_Up_Topics.php' method='POST' >";
                    card+="<button class='exam_input' type='submit' name='examname' value='" + exam_name + "'>" + exam_name + "</button>";
                    card+="</form>";
                    card+="<button class='more_options_button' view='false' id='"+i+"'>";
                    card+="<img src='../CSS/more_options.png' class='more_options_image'>";
                    card+="<div class='more_options_list_container'>";
                    card+="</div>";
                    card+="</button>";
                    card+="</div>";
                    card+="<div class='exam_lower'>";
                    card+="<div class='created_by'>Created by: ";
                    card+="<span>" +owner_name+ "</span>";
                    card+="</div>";
                    card+="<div class='ratio_span'>Rating: ";
                    card+="<span>" +ratio_value_text+ "</span>";
                    card+="</div>";
                    card+="</div>";

                exam.innerHTML+= card;
                document.querySelector(".exams_overview_container").appendChild(exam);
            }
            

            var request_todo_list = new XMLHttpRequest();
            const url_todo_list= "../API/getToDoList.php";

            request_todo_list.open("GET" , url_todo_list , true);
            request_todo_list.send();

            request_todo_list.onreadystatechange = function(){
                if(this.readyState === 4 && this.status === 200){
                    var json_todo = JSON.parse(this.responseText);

                    let to_do_input_button;
                    let card = document.querySelectorAll(".more_options_list_container");
                        
                    if(json_todo.message === "0"){
                        for(let j = 0 ; j < json.length ; j++){
                            let exam_name = json[j].exam_name;
                            
                            to_do_input_form = document.createElement("form");
                            to_do_input_form.className="todo_button_form";
                            to_do_input_form.setAttribute("method" , "POST");
                            to_do_input_form.setAttribute("action" , "../INCLUDE/add.php");

                            to_do_input_button="<button class='todo_button' type='submit' value='"+ exam_name +"' name='examname'>Add to your list</button>";

                            to_do_input_form.innerHTML = to_do_input_button;

                            card[j].appendChild(to_do_input_form);
                        }
                    }

                    else if(json_todo.length > 0){
                        for(let j = 0 ; j < json.length ; j++){
                            let exam_name = json[j].exam_name;
                            let flag = false;

                            for(let k = 0 ; k < json_todo.length ; k++){
                                if(exam_name === json_todo[k]){
                                    to_do_input_form = document.createElement("form");
                                    to_do_input_form.className="todo_button_form";
                                    to_do_input_form.setAttribute("method" , "POST");
                                    to_do_input_form.setAttribute("action" , "../INCLUDE/remove.php");
        
                                    to_do_input_button="<button class='todo_button' type='submit' value='"+ exam_name +"' name='examname'>Remove from your list</button>";
        
                                    to_do_input_form.innerHTML = to_do_input_button;
        
                                    card[j].appendChild(to_do_input_form);

                                    flag= true;
                                    break;
                                }
                            }

                            if(!flag){
                                to_do_input_form = document.createElement("form");
                                to_do_input_form.className="todo_button_form";
                                to_do_input_form.setAttribute("method" , "POST");
                                to_do_input_form.setAttribute("action" , "../INCLUDE/add.php");
    
                                to_do_input_button="<button class='todo_button' type='submit' value='"+ exam_name +"' name='examname'>Add to your list</button>";
    
                                to_do_input_form.innerHTML = to_do_input_button;
    
                                card[j].appendChild(to_do_input_form);  
                            }
                        }
                    }

                    const more_options = document.querySelectorAll(".more_options_button");
                    const more_options_container = document.querySelectorAll(".more_options_list_container");
                        for(let b = 0 ; b < more_options.length ; ++b){
                            more_options[b].addEventListener("click" , function(){
                                let view = more_options[b].getAttribute("view");
                                let option_list = document.querySelectorAll(".more_options_list_container");
                    
                                if(view == "false"){
                                    option_list[b].style.display="block";
                                    more_options[b].setAttribute("view" , "true");
                                }
                    
                                else if (view == "true"){
                                    option_list[b].style.display="none";
                                    more_options[b].setAttribute("view" , "false");
                                }
                    
                            });
                        }
                };
            }
        }
    };
});

var search_something_container = "<div class='search_something_container'>";
    search_something_container+="<img src='../CSS/search_128.png' class='search_something_image'>";
    search_something_container+="<div class='search_something'>";
    search_something_container+="Search something by typing in the input field";
    search_something_container+="</div>";
    search_something_container+="</div>";

const search_input_field = document.querySelector(".search_input");
    search_input_field.addEventListener("input" , function(){
        setTimeout(function(){
            let search_div = document.querySelector(".searched_exams_container");
    
            if(search_input_field.value !== ""){
                search_div.innerHTML="";
    
                var request_search = new XMLHttpRequest();
                const url = "../API/getSearchedExams.php";
    
                let search_value = search_input_field.value;
                let data = {"search_value" : search_value};
    
                request_search.open("POST" , url , true);
                request_search.send(JSON.stringify(data));
    
                request_search.onreadystatechange = function(){
                    if(this.readyState === 4 && this.status === 200){
                        var json = JSON.parse(this.responseText);
    
                        for(let i = 0 ; i < json.length ; ++i){
                            let owner_name = json[i].owner_name;
                            let exam_name = json[i].exam_name;
                            let likes = parseInt(json[i].likes);
                            let unlikes = parseInt(json[i].unlikes);
    
                            if(likes != 0 || unlikes != 0){
                                let ratio_value = likes / (likes + unlikes) * 100;
                                let ratio_value_rounded= Math.round(ratio_value * 10) / 10;
                                var ratio_value_text = ratio_value_rounded+"%";
                            }
    
                            else{
                                ratio_value_text = "Not rated yet";
                            }
    
                            let exam = document.createElement("div");
                            exam.className="exam";
                            
                            let card="<div class='exam_upper'>";
                            card+="<form class='select_form' action='../INCLUDE/Set_Up_Topics.php' method='POST' >";
                            card+="<button class='exam_input' type='submit' name='examname' value='" + exam_name + "'>" + exam_name + "</button>";
                            card+="</form>";
                            card+="<button class='more_options_button_searched' view='false'>";
                            card+="<img src='../CSS/more_options.png' class='more_options_image'>";
                            card+="<div class='more_options_list_container_searched'>";
                            card+="</div>";
                            card+="</button>";
                            card+="</div>";
                            card+="<div class='exam_lower'>";
                            card+="<div class='created_by'>Created by: ";
                            card+="<span>" +owner_name+ "</span>";
                            card+="</div>";
                            card+="<div class='ratio_span'>Rating: ";
                            card+="<span>" +ratio_value_text+ "</span>";
                            card+="</div>";
                            card+="</div>";
    
                            exam.innerHTML+= card;
    
                            document.querySelector(".searched_exams_container").appendChild(exam);
                        }
    
    
    
                        var request_todo_list = new XMLHttpRequest();
                        const url_todo_list= "../API/getToDoList.php";
    
                        request_todo_list.open("GET" , url_todo_list , true);
                        request_todo_list.send();
    
                        request_todo_list.onreadystatechange = function(){
                            if(this.readyState === 4 && this.status === 200){
                                var json_todo = JSON.parse(this.responseText);
                                let card = document.querySelectorAll(".more_options_list_container_searched");
                                let to_do_input_button;
                                    
                                if(json_todo.message === "0"){
                                    for(let j = 0 ; j < json.length ; j++){
                                        let exam_name = json[j].exam_name;
    
                                        to_do_input_form = document.createElement("form");
                                        to_do_input_form.className="todo_button_form";
                                        to_do_input_form.setAttribute("method" , "POST");
                                        to_do_input_form.setAttribute("action" , "../INCLUDE/add.php");
    
                                        to_do_input_button="<button class='todo_button' type='submit' value='"+ exam_name +"' name='examname'>Add to your list</button>";
    
                                        to_do_input_form.innerHTML = to_do_input_button;
    
                                        card[j].appendChild(to_do_input_form);
                                    }
                                }
    
                                else if(json_todo.length > 0){
                                    for(let j = 0 ; j < json.length ; j++){
                                        let exam_name = json[j].exam_name;
                                        let flag = false;
    
                                        for(let k = 0 ; k < json_todo.length ; k++){
                                            if(exam_name === json_todo[k]){
                                                to_do_input_form = document.createElement("form");
                                                to_do_input_form.className="todo_button_form";
                                                to_do_input_form.setAttribute("method" , "POST");
                                                to_do_input_form.setAttribute("action" , "../INCLUDE/remove.php");
                    
                                                to_do_input_button="<button class='todo_button' type='submit' value='"+ exam_name +"' name='examname'>Remove from your list</button>";
                    
                                                to_do_input_form.innerHTML = to_do_input_button;
                    
                                                card[j].appendChild(to_do_input_form);
    
                                                flag= true;
                                                break;
                                            }
                                        }
    
                                        if(!flag){
                                            to_do_input_form = document.createElement("form");
                                            to_do_input_form.className="todo_button_form";
                                            to_do_input_form.setAttribute("method" , "POST");
                                            to_do_input_form.setAttribute("action" , "../INCLUDE/add.php");
                
                                            to_do_input_button="<button class='todo_button' type='submit' value='"+ exam_name +"' name='examname'>Add to your list</button>";
                
                                            to_do_input_form.innerHTML = to_do_input_button;
                
                                            card[j].appendChild(to_do_input_form);  
                                        }
                                    }
                                }

                                const more_options = document.querySelectorAll(".more_options_button_searched");
                                for(let b = 0 ; b < more_options.length ; ++b){
                                    more_options[b].addEventListener("click" , function(){
                                        let view = more_options[b].getAttribute("view");
                                        let option_list = document.querySelectorAll(".more_options_list_container_searched");
                            
                                        if(view == "false"){
                                            option_list[b].style.display="block";
                                            more_options[b].setAttribute("view" , "true");
                                        }
                            
                                        else if (view == "true"){
                                            option_list[b].style.display="none";
                                            more_options[b].setAttribute("view" , "false");
                                        }
                                    });
                                }
                            };
                        }
                    };
                }
            }
    
            else if(search_input_field.value === ""){
                document.querySelector(".searched_exams_container").innerHTML= search_something_container;
            }
        },250);
    });

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

    const navigation_button = document.querySelectorAll(".content_navigation_button");
        for(let i =0 ; i < navigation_button.length ; ++i){
            navigation_button[i].addEventListener("click", function(){
                let button_value = navigation_button[i].getAttribute("value");

                for (let j =0 ; j < navigation_button.length ; ++j){
                    navigation_button[j].style.backgroundColor = "#f7f7f7";
                    navigation_button[j].style.color = "#535353";
                }

                if(button_value === "search"){
                    navigation_button[i].style.backgroundColor ="#14213D";
                    navigation_button[i].style.color ="#ffffff";
                        
                    document.querySelector(".available_exams_container").style.display="none";
                    document.querySelector(".to_do_list_container").style.display="none";
                    document.querySelector(".search_exams_container").style.display="block";
                }

                if(button_value === "exams"){
                    navigation_button[i].style.backgroundColor ="#14213D";
                    navigation_button[i].style.color ="#ffffff";
                    
                    document.querySelector(".search_exams_container").style.display="none";
                    document.querySelector(".to_do_list_container").style.display="none";
                    document.querySelector(".available_exams_container").style.display="block";
                }

                if(button_value === "todolist"){
                    navigation_button[i].style.backgroundColor ="#14213D";
                    navigation_button[i].style.color ="#ffffff";

                    document.querySelector(".search_exams_container").style.display="none";
                    document.querySelector(".available_exams_container").style.display="none";
                    document.querySelector(".to_do_list_container").style.display="block";
                }
            });
        }