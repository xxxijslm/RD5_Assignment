<?php
    session_start();
    if(isset($_POST['signUpButton'])) {
        $userName = $_POST['userName'];
        $userAcc = $_POST['userAcc'];
        $password = $_POST['password'];
        $passwordAgain = $_POST['passwordAgain'];
        if ($password == $passwordAgain) {
            $hash = hash('sha256', $password);
            $command = <<<lines
                SELECT * FROM `users`
                WHERE userAcc='$userAcc'
            lines;
            require_once("config.php");
            $result = mysqli_query($link, $command);
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $erracc = "*帳號已經註冊";
                echo($erracc);
            }
            else {
                $sql = <<<multi
                    INSERT INTO users
                    (userAcc, userName, password)
                    VALUE
                    ('$userAcc', '$userName', '$hash')
                multi;
                // echo($sql);              
                mysqli_query($link, $sql);
                $selectIdSql = <<<si
                    SELECT userId FROM `users`
                    WHERE userAcc = '$userAcc'
                si;
                $selectIdResult = mysqli_query($link, $selectIdSql);
                $selectIdRow = mysqli_fetch_assoc($selectIdResult);
                $userId = $selectIdRow['userId'];
                $insertAccSql = <<<ia
                    INSERT INTO accounts
                    (userId)
                    VALUES
                    ($userId)
                ia;
                mysqli_query($link, $insertAccSql);
                echo("註冊成功請重新登入");
            }
        }
        else {
            $err = "*輸入密碼不一致";
            echo($err);
        }
    }

    if (isset($_POST['signInButton'])) {
        $userAcc = $_POST['loginUserAcc'];
        $password = $_POST['loginPassword'];
        if ($userAcc != "" and $password != "") {
            $hash = hash('sha256', $password);
            $sql = <<<multi
                SELECT * 
                FROM `users`
                WHERE userAcc = '$userAcc' AND password = '$hash'
            multi;
            require_once("config.php");
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($result);
            $userId = $row['userId'];
            // var_dump($row["userName"]);
            $findCapitalSql = <<<fc
                SELECT capital
                FROM `accounts`
                WHERE userId = $userId
            fc;
            $findCapitalResult = mysqli_query($link, $findCapitalSql);
            $findCapitalRow = mysqli_fetch_assoc($findCapitalResult);
            // header ("Location: secret.php");
            if ($row) {
                $_SESSION['userId'] = $row['userId'];
                $_SESSION['userAcc'] = $row['userAcc'];
                $_SESSION['userName'] = $row['userName'];
                $_SESSION['capital'] = $findCapitalRow['capital'];
                header("Location: secret.php");
            }
            else {
                echo("帳號未註冊或帳號密碼錯誤！請重新輸入");
            }
        }
    }

    if(isset($_GET['logout'])) {
        unset($_SESSION['userName']);
        unset($_SESSION['userId']);
        unset($_SESSION['userAcc']);
        unset($_SESSION['capital']);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Bank</title>
</head>

<body>
    <h2>登入/註冊帳號</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form method="POST" action="#">
                <h1>註冊帳號</h1>
                <input type="text" id="userName" name ="userName" placeholder="真實姓名" value="<?= $userName?>" required/>
                <input type="text" id="userAcc" name ="userAcc" placeholder="帳號(登入使用)" value="<?= $userAcc?>" required/>
                    <span><?= $erracc?></span>
                <input type="password" id="password" name ="password" placeholder="密碼(請設定6-15位英數字含大小寫)" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,30}$" required/>
                <input type="password" id="passwordAgain" name ="passwordAgain" placeholder="確認密碼" required/>
                    <span><?= $err ?></span>
                <button id="signUpButton" name="signUpButton">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form method="POST" action="#">
                <h1>登入</h1>
                <input type="text" id="loginUserAcc" name ="loginUserAcc" placeholder="帳號" required/>
                <input type="password" id="loginPassword" name ="loginPassword" placeholder="密碼" required/>
                <a href="secret.php">已經登入？進入個人網銀頁面</a>
                <button id="signInButton" name="signInButton">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });

</script>

</html>