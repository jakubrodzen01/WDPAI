<html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/register_style.css" />
    <title>Register</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo_green.svg">
        </div>

        <form class="register_container" action="register" method="POST">
            <div class="messages" style="color: white; text-align: center; margin-bottom: 1em;">
                <?php if(isset($messages)) {
                    foreach ($messages as $message){
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="name" type="text" placeholder="name" required>
            <input name="surname" type="text" placeholder="surname" required>
            <label name="question">What is your gender?:</label>
            <div class="gender">
                <label>
                    <input type="radio" name="gender" value="male" required> Male
                </label>
                <label>
                    <input type="radio" name="gender" value="female" required> Female
                </label>
            </div>
            <input name="email" type="text" placeholder="email" required>
            <input name="password" type="password" placeholder="password" required>
            <button type="submit">SIGN UP</button>
        </form>
    </div>
</body>

</html>