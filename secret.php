<?php
    session_start();
    if (!isset($_SESSION['userAcc'])) {
        header ("Location: index.php");
    }
    $userName = $_SESSION['userName'];
    $userId = $_SESSION['userId'];
    $userAcc = $_SESSION['userAcc'];
    $capital = $_SESSION['capital'];
    
    if (isset($_POST['deposit'])) {
        header("Location: deposit.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="secret.css" type="text/css">
    <title>Document</title>
</head>
<body>
    <div class="center">
        <form method="POST" action="">
            <h3> <?= $userName?> </h3>
            <h4> <?= "帳號:" . $userAcc. "  總資本額: NTD" . $capital ?> </h4>
            <button type="submit" id="deposit" name="deposit">存款</button>
            <button type="submit" id="withdrawal" name="withdrawal">提款</button>
            <button type="submit" id="withdrawal" name="withdrawal">查詢明細</button>
            <br>
            <a href="index.php?logout=1">登出</a>
        </form>
    </div>
</body>

</html>