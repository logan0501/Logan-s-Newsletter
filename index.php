<?php
$fname = filter_input(INPUT_POST, 'fname');
$lname = filter_input(INPUT_POST, 'lname');
$mobile = filter_input(INPUT_POST, 'mobile');
$email = filter_input(INPUT_POST, 'email');
$bdate = filter_input(INPUT_POST, 'bdate');
$pass = filter_input(INPUT_POST, 'pass');
$cpass = filter_input(INPUT_POST, 'cpass');
if (!empty($lname) && !empty($fname) && !empty($email) && !empty($bdate) && !empty($pass) && !empty($cpass)){
            $namepattern = "/^[a-zA-Z]+$/i";
            $mobilepattern = "/^[0-9]{10}$/i";
            $emailpattern ='/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i';
            $passpattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/i";
            
            if(preg_match($namepattern,$lname)==0 && preg_match($namepattern,$fname)==0){
                echo "\nProvide a valid name";
                die();
            }
            if(preg_match($mobilepattern,$mobile)==0){
                echo "\nProvide a valid mobile number";
                die();
            }
            if(preg_match($emailpattern,$email)==0){
                echo "\nProvide a valid email address";
                die();
            }
            if(preg_match($passpattern,$pass)==0){
                echo "\nProvide a valid password(Ex:DEMo@1234)";
                die();
            }
            if($pass!=$cpass){
                echo "\nPasswords doesn't match";
                die();
            }

            $host = "localhost";
            $dbusername = "root";
            $dbpassword = "logan";
            $dbname = "mysql";
    // Create connection
            $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
    
    
            if (mysqli_connect_error()){
                
                die('Connect Error ('. mysqli_connect_errno() .')'. mysqli_connect_error());
            
            }
            else{
            
                $sql = "INSERT INTO root (fname, lname,mobile,email,bdate,pass,cpass)
                values ('$fname','$lname','$mobile','$email','$bdate','$pass','$cpass')";
                if ($conn->query($sql)){
                    echo "New record is inserted sucessfully";
                }
                else{
                    echo "Error: ". $sql ."". $conn->error;
                }
                $conn->close();
            }
    }

    else{
    echo "Kindly fill all data.";
    die();
    }
