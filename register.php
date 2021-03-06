<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT customerID FROM user_table WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }        
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password must contain one lowercase letter, uppercase letter, number and min of 8 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user_table (username,password_hash,customer_forename,customer_surname,customer_address1,customer_address2,date_of_birth) VALUES (?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_username, $param_password, $firstname, $lastname, $address1, $address2, $dob);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $firstname=htmlspecialchars($_POST["firstname"]);
            $lastname=htmlspecialchars($_POST["lastname"]);
            $address1=htmlspecialchars($_POST["address1"]);
            $address2=htmlspecialchars($_POST["address2"]);
            $dob=htmlspecialchars($_POST["dob"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
    
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mindsight Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="common.css">   
</head>
<body>
    <div class="wrapper reg">
        <h2>Mindsight Registration</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo(isset($_POST["firstname"])&&empty(trim($_POST["firstname"]))) ? 'has-error' : ''; ?>">
                <label>Firstname</label>
                <input type="text" name="firstname" class="form-control">
                <span class="help-block"><?php echo(isset($_POST["firstname"])&&empty(trim($_POST["firstname"]))) ? 'Please enter a firstname' : '';?></span>
            </div> 
            <div class="form-group <?php echo(isset($_POST["lastname"])&&empty(trim($_POST["lastname"]))) ? 'has-error' : ''; ?>">
                <label>Lastname</label>
                <input type="text" name="lastname" class="form-control">
                <span class="help-block"><?php echo(isset($_POST["lastname"])&&empty(trim($_POST["lastname"]))) ? 'Please enter a lastname' : '';?></span>
            </div>
            <div class="form-group <?php echo(isset($_POST["address1"])&&empty(trim($_POST["address1"]))) ? 'has-error' : ''; ?>">
                <label>Address1</label>
                <input type="text" name="address1" class="form-control">
                <span class="help-block"><?php echo(isset($_POST["address1"])&&empty(trim($_POST["address1"]))) ? 'Please enter address1' : '';?></span>
            </div> 
            <div class="form-group <?php echo(isset($_POST["address2"])&&empty(trim($_POST["address2"]))) ? 'has-error' : ''; ?>">
                <label>Address2</label>
                <input type="text" name="address2" class="form-control">
                <span class="help-block"><?php echo(isset($_POST["address2"])&&empty(trim($_POST["address2"]))) ? 'Please enter address2' : '';?></span>
            </div> 
            <div class="form-group <?php echo(isset($_POST["dob"])&&empty(trim($_POST["dob"]))) ? 'has-error' : ''; ?>">
                <label>D.O.B</label>
                <input type="date" name="dob" max="2001-12-31" title="Should be 18 years atleast" class="form-control">
                <span class="help-block"><?php echo(isset($_POST["dob"])&&empty(trim($_POST["dob"]))) ? 'Please enter date of birth' : '';?></span>
            </div>  
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>