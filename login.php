<?php
    
    error_reporting (E_All ^ E_NOTICE);
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
    <title> Member System - Log In </title>
    </head>

    <body>

        <?php
            
            $form = "<form action='./login.php' method='post'>
            
            <table>
            <tr>
                <td> Username: </td>
                <td><input type ='text' name='user' /> </td>
            </tr>

            <tr>
                <td> Password: </td>
                <td><input type ='password' name='password' /> </td>
            </tr>
            
            <tr>
                <td></td>
                <td><input type ='submit' name='loginbtn' value = 'Login' /> </td>
            </tr>
           
            </table>
            
            </form>";
            
            if ($_POST['loginbtn']) {
                $user = $_POST['user'];
                $password = $_POST['password'];
                
                if ($user) {
                    if ($password){
                        require("connect.php");
                        $password = md5(md5("ae5544".$password."eef520d66aaa")); //This adds salt and md5 encryption to the user's password.
                        $query = mysql_query("");
                        
                        mysql_close();
                    }
                    else
                        echo "You must enter your password. $form";
                }
                else
                    echo "You must enter your username. $form";

            }
            
            else
                echo $form;
            
        ?>

    </body>
</html>