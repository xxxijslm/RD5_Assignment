<?php
    session_start();
    require_once("config.php");
    if (!isset($_SESSION['userAcc'])) {
        header ("Location: index.php");
    }
    $userName = $_SESSION['userName'];
    $userId = $_SESSION['userId'];
    $userAcc = $_SESSION['userAcc'];
    $capital = $_SESSION['capital'];
    $depositAcc = $_POST['userAccount'];
    if (isset($_POST['okButton'])) {
        $userAccSql = <<<ua
            SELECT userAcc, userId
            FROM `users`
            WHERE userAcc = '$depositAcc'
        ua;
        $userAccResult = mysqli_query($link, $userAccSql);
        $userAccRow = mysqli_fetch_assoc($userAccResult);
        $userCapitalId = $userAccRow['userId'];
        if ($userAccRow) {
            $capitalSql = <<<cs
                SELECT * 
                FROM `accounts`
                WHERE userId = '$userCapitalId'
            cs;
            $capitalResult = mysqli_query($link, $capitalSql);
            $capitalRow = mysqli_fetch_assoc($capitalResult);
            $findCapital = $capitalRow['capital'];
            
        }
        else {
            $mss = "帳號" . $depositAcc . "不存在或輸入錯誤!";            
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="formStyle.css">

    <title>Document</title>
</head>

<body>
    <div class="registration-form">
        <form method="POST" action="">
            <div class="form-group row">
                <label for="userAccount" class="col-4 col-form-label">存款帳號：</label>
                <div class="col-8">
                    <input id="userAccount" name="userAccount" type="text" class="form-control item" value="<?= $depositAcc ?>" required="required">
                    <span><?= $mss?></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label">現有帳號金額：</label>
                <div class="col-8">
                <input id="nowCapital" name="nowCapital" type="number" min="10" max="100000" class="form-control item" value="<?= $capital?>" readonly="readonly">
                </div>
            </div>
            <div class="form-group row">
                <label for="depositNum" class="col-4 col-form-label">存款金額(NTD)：</label>
                <div class="col-8">
                    <input id="depositNum" name="depositNum" type="number" min="10" max="100000" class="form-control item" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-4 col-form-label">敘述：</label>
                <div class="col-8">
                    <textarea id="description" name="description" cols="20" rows="3" class="form-control item"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="okButton" type="submit" class="btn btn-primary" value="OK">新增</button>
                    <button name="cancelButton" type="cancel" class="btn btn-danger" onclick="javascript:location.href='secret.php'">取消</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>