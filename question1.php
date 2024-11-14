<?php
$name = $email= $feedback= "";
$erro_name = $erro_email= $erro_feedback= "";
const Minimum =10;

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if(empty($_POST["name"])){
        $erro_name ="You Must enter a name ";
    }
    else{
        $name= sanitize_input($_POST["name"]);
        if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
            $erro_name="Only Letters are Alowed";
        }
    }

    if(empty($_POST["email"])){
        $erro_email="Please Enter a Email";
    }
    else{
        $email =sanitize_input($_POST["email"]);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $erro_email="Enter a valid email";
            }

        }
    if(empty($_POST)){
        $erro_feedback="Please enter  feedback !";
    }
    else{
         $feedback=$_POST["feedback"];
        if(strlen($feedback) <Minimum){
            $erro_feedback="Feed back must contain 10 characters";
        }
    
    }



}
function sanitize_input($data) {
    $data = trim($data);               // Remove extra spaces
    $data = stripslashes($data);       // Remove backslashes
    $data = htmlspecialchars($data);   // Convert special characters to HTML entities
    return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST" && empty($erro_name) && empty($erro_email) && empty($erro_feedback)){
    echo "Thank You For your feedBAck <br>";
    echo htmlspecialchars($_POST["topic"]);
    echo "<br>".date("y-m-d");
}
else{
    echo htmlspecialchars($erro_feedback);
    echo htmlspecialchars($erro_name);
    echo htmlspecialchars($erro_email); 
}



?>