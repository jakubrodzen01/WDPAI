<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/login_style.css" />
    <title>GYMplanner</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo_green.svg">
        </div>

        <form class="login_container", action="login" method="POST">
            <div class="messages" style="color: white; text-align: center; margin-bottom: 1em;">
                <?php if(isset($messages)) {
                    foreach ($messages as $message){
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button type="submit">CONTINUE</button>
        </form>
    </div>
</body>

</html>