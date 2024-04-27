<html lang="en">
<head>
    <title>Program | BemFilkom</title>
    <link rel="stylesheet" href="../Public/css/main.css">
</head>
<body>
<div class="container">
    <div class="content">
        <form class="form" action="/login" method="post">
            <h2>Welcome, <?= $_COOKIE['name'] ?>!</h2>
            <label>
                <input type="text" name="nim" placeholder="Nim">
            </label>
            <label>
                <input type="password" name="password" placeholder="Password">
            </label>
            <input type="submit" value="Login">
        </form>
    </div>
</div>
</body>
</html>