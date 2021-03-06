<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="common.css">
</head>
<body class="reflection">
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. welcome to Mindsight.</h1>
    </div>
    <p class="user_options">                        
        <a href="logout.php" class="btn btn-danger">Sign Out</a>
        <a href="#" class="btn btn-primary">Contact us</a>
        <a href="#" class="btn btn-primary">About us</a>        
        <a href="Reflection.php" class="btn btn-primary">Reflections</a>               
    </p>
    <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo(isset($_POST["
            rtime"])&&isset($_POST["rplace"])&&empty(trim($_POST["rtime"])&&empty(trim($_POST["rplace"])))) ? 'has-error'
            : '' ; ?>">
            <label>Time</label>
            <input type="time" name="rtime" class="form-control">
            <label>Place</label>
            <input type="text" name="rplace" class="form-control">
            <span class="help-block">
                <?php echo(isset($_POST["rtime"])&&isset($_POST["rplace"])&&empty(trim($_POST["rtime"])&&empty(trim($_POST["rplace"])))) ? 'Please enter time and place' : ''; ?>
            </span>
        </div>
        <div class="form-group <?php echo(isset($_POST[" step1"])&&empty(trim($_POST["step1"]))) ? 'has-error' : '' ; ?>">
            <label>Step1</label>
            <textarea name="step1" class="form-control"
                placeholder="Focus on the five senses: what can you see, hear, taste, smell, touch? Log what you are observing in the matrix "></textarea>
            <span class="help-block">
                <?php echo(isset($_POST["step1"])&&empty(trim($_POST["step1"]))) ? 'Please enter step1' : ''; ?>
            </span>
        </div>
        <div class="form-group <?php echo(isset($_POST[" step2"])&&empty(trim($_POST["step2"]))) ? 'has-error' : '' ; ?>">
            <label>Step2</label>
            <textarea name="step2" class="form-control"
                placeholder="Do you notice whether you feel relaxed and content, or tense and anxious? Are you aware of any sensations in your body? Describe. Log what you are observing in the matrix"></textarea>
            <span class="help-block">
                <?php echo(isset($_POST["step2"])&&empty(trim($_POST["step2"]))) ? 'Please enter step2' : ''; ?>
            </span>
        </div>
        <div class="form-group <?php echo(isset($_POST[" step3"])&&empty(trim($_POST["step3"]))) ? 'has-error' : '' ; ?>">
            <label>Step3</label>
            <textarea name="step3" class="form-control"
                placeholder="Intentions, images, attitudes, thoughts, feelings. Begin by just becoming aware of what enters your mind. Spend a few moments getting to know what arises in your mind. Notice how it comes about, and when it subsides. Are you of aware of yourself observing your mental activity? Log what you are observing in the matrix "></textarea>
            <span class="help-block">
                <?php echo(isset($_POST["step3"])&&empty(trim($_POST["step3"]))) ? 'Please enter step3' : ''; ?>
            </span>
        </div>
        <div class="form-group <?php echo(isset($_POST[" step4"])&&empty(trim($_POST["step4"]))) ? 'has-error' : '' ; ?>">
            <label>Step4</label>
            <textarea name="step4" class="form-control"
                placeholder="Spend a few moments to sense their intention, mood, expectations, desires, etc. Be patient, focus on developing an intent to connect with others. Observe your own reactions, sensations, feelings, thoughts, desires. Any sense of connecting/disconnecting with others? How is this related to what you’ve just been doing or thinking?  Log what you are observing in the matrix "></textarea>
            <span class="help-block">
                <?php echo(isset($_POST["step4"])&&empty(trim($_POST["step4"]))) ? 'Please enter step4' : ''; ?>
            </span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
    </form>
</body>
</html>