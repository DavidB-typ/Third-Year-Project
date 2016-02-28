<?php

/**
*shaneFunctions.php
*Libarary functions for the project so that we can reuse eachothers code without the risk destroying the original
*/

/**
*login 
*Logs the user into the system by retrieving their id from the database
* @author Shane Fitzgerald
* 
*/
function login($DBURL, $DBUser, $DBPassword, $DB){
    echo "Logging in, please wait...";
    // Connect to database
    $dbconnection = mysqli_connect($DBURL, $DBUser, $DBPassword, $DB);
    if($_POST["user"] || $_POST["pass"]){ //check if post variables exist
        //assign post variable values to php variables
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        // Select data from table
        $sql = "SELECT username, password, id FROM users WHERE username = '$user' AND password = '$pass'";
        $result = mysqli_query($dbconnection, $sql); //query the sql statement
        
        //if result has more than 0 rows
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {//echo a form using the id of the user
                echo '<form action="index.php" method="get" id="loginForm">
                <input name="id" type="hidden" value="'.$row['id']. '">
                </form>';
            }
        } else {
            echo "0 results, username/password does not exist.";
        }
        // commit and close connection
        mysqli_commit($dbconnection);
        mysqli_close($dbconnection);
    }
}

/**
*generate_loginbox 
*Generates a login textbox if the user is not logged in on any page.
* currently just redirects you to the current page
* @author Shane Fitzgerald
* 
*/
function generate_loginbox()
{
    if(!isset($_GET['id'])){ //checks if the variable id is set in the url through a get form
        //echo html code for login box if variable is set
        echo '<div class="col width-fill">
        <div class="col">
            <div class="cell panel">
                <div class="header">
                    Login/Register
                </div>
            <div class="body">
                <div class="cell">
                    <div class="col">
                        <div class="cell">
                            <form action="loginPage.php" method="post">
                                <input type="submit" value="Log In">
                                <br><br>
                            </form>
                            <form action="index.php">
                                <input type="submit" value="Register">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>';
                        } 
}//end generate_loginbox

?>

