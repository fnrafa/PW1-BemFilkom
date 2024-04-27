<?php
if (!isset($data)) {
    $data = "Internal Server Error";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $data ?></title>
    <link rel="stylesheet" href="../Public/css/alert.css">
</head>
<body>

<div id="alertModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h1><?= $data ?></h1>
        <p><a href="/">Go Back</a></p>
    </div>
</div>

<script src="../Public/js/alert.js"></script>
</body>
</html>
