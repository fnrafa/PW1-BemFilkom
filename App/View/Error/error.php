<?php
if (!isset($alertMessage)) {
    $alertMessage = "Internal Server Error";
}
?>
<html lang="en">
<head>
    <title><?= $alertMessage ?></title>
</head>
<body>
<style>
    .container {
        width: 100%;
        height: 100%;
        margin: 0 auto;
        position: relative;
    }

    .content {
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
    }

    a {
        border: 2px solid black;
        padding: 5px;
        color: black;
        text-decoration: none;
    }
</style>
<div class="container">
    <div class="content">
        <h1><?= $alertMessage ?></h1>
        <a href="/">Go Back</a>
    </div>
</div>
</body>
</html>