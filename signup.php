<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post">
        <div class="login">
            <div class="con">
                <label class="label">NAME</label>
                <input type="text" placeholder="first name" name="name"><br>
                <label class="label">EMAIL</label>
                <input type="email" placeholder="email" name="email"><br>
                <label class="label">PASSWORD </label>
                <input type="password" placeholder="password" name="password"><br>
                <input type="submit" name="submit" style="width:150px;height:40px;background-color:#1fa123;margin-top:30px;border-radius:15px;">
                <a id="sign" href="login.php">click for login? login</a>
            </div>
    </form>
    <?php
    include("controller.php");
    if (isset($_POST['submit'])) 
    {
        $obj = new controller();
        $obj->signup($_POST);
        header("location:login.php");
    }
    ?>
    </div>
</body>
</html>