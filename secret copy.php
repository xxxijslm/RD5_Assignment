<?php
    session_start();
    $userName = $_SESSION['userName'];
    $userId = $_SESSION['userId'];
    $userAcc = $_SESSION['userAcc'];
    $capital = $_SESSION['capital'];
    

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
    <link rel="stylesheet" href="stylesecret.css" type="text/css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="title">
            <h3><?= $userName?></h3>
            <h6><?="總資本額：" .  $capital?></h6>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                <div class="col-md-12">
                    <button type="button" rel="tooltip" class="btn btn-just-icon btn-info btn-sm float-right"
                        data-original-title="" title="" onclick="location.href='add.php'">
                        <i class="material-icons">fiber_new</i>
                    </button>
                    <h4>商品列表</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>商品名稱</th>
                                <th>商品類別</th>
                                <th class="text-right">商品價格</th>
                                <th class="text-right">商品庫存</th>
                                <th class="text-right">商品圖片</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>【日月潭嗆豆】- 芥末花生</td>
                                <td>農特產品</td>
                                <td class="text-right">NTD130.00</td>
                                <td class="text-right">10</td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip"
                                        class="btn btn-success btn-round btn-just-icon btn-sm"
                                        onclick="location.href='edit.php?productId=1'" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip"
                                        class="btn btn-danger btn-round btn-just-icon btn-sm" data-original-title=""
                                        title="" onclick="location.href='delete.php?productId=1'">
                                        <i class="material-icons">close</i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>【日月潭辣豆】- 椒麻花生</td>
                                <td>農特產品</td>
                                <td class="text-right">NTD130.00</td>
                                <td class="text-right">20</td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip"
                                        class="btn btn-success btn-round btn-just-icon btn-sm"
                                        onclick="location.href='edit.php?productId=2'" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip"
                                        class="btn btn-danger btn-round btn-just-icon btn-sm" data-original-title=""
                                        title="" onclick="location.href='delete.php?productId=2'">
                                        <i class="material-icons">close</i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>