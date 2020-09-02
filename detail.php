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
    
    $detailSql = <<< ds
        SELECT type, money, `date`, description, balance
        FROM `transactions` WHERE userId = $userId
        ORDER BY date DESC
    ds;
    $detailResult = mysqli_query($link, $detailSql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesheet" href="detail.css" type="text/css">
    <title>Document</title>
    
</head>

<body>
    <div class="container">
        <div class="title">
            <h3><a href="secret.php"><?= $userName?></a></h3>
            <div class="row" id="cashdiv" name="cashdiv">
                <div>總資本額：NTD</div>
                <div id="cash" name="cash">*****</div>
            </div>
            <!-- <h6 id="cash"><?="總資本額：NTD" .  $capital?></h6> -->
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-10 ml-auto mr-auto tables">
                <div class="col-md-12">
                    <h4>明細列表</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text">日期</th>
                                <th class="text-right">存款(NTD)</th>
                                <th class="text-right">提款(NTD)</th>
                                <th class="text-right">敘述</th>
                                <th class="text-right">餘額(NTD)</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                                <?php while ($detailRow = mysqli_fetch_assoc($detailResult)) { ?>
                                    <tr>
                                        <td class="text"><?= $detailRow['date'] ?></td>
                                        <td class="text-right"><?= ($detailRow['type']==0) ? $detailRow['money']: "" ?></td>
                                        <td class="text-right"><?= ($detailRow['type']==1) ? $detailRow['money']: "" ?></td>
                                        <td class="text-right"><?= $detailRow['description'] ?></td>
                                        <td id="balance" name="balance" class="text-right"><?= $detailRow['balance'] ?></td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $("#cashdiv").mouseover(function () {
        $("#cash").text("<?= $capital?>");
    })
    $("#cashdiv").mouseout(function () {
        $("#cash").text("*****");
    })
</script>
</html>