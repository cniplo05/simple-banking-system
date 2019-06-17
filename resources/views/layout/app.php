
<?php require_once '../classes/lib/ti.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exam</title>
    <!--css links -->
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- end of css links -->
</head>
<body>
    <header>
        <nav class="navbar-b navbar-trans navbar-expand-md fixed-top">
        </nav>
    </header>
        <div id="app">
            <div class="container full-width">
                <?php startblock('content') ?>
                <?php endblock() ?>
            </div>
        </div>
    <!--script links -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
    <!--end of script links -->
</body>
</html>