<!DOCTYPE html>
<html>
    <head>
        <title>e-mail template page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scle=1.0">
        <link rel="stylesheet" href="style.css">
        <script scr="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>
    <body>
        <div id="container">
            <header>
                <div class="h">bossearn</div>
            </header>
            <main style="height: auto;">
                <h1>Welcome To Bossearn</h1>
                <br>
                <h4>please click on the button to verify your email</h4>
                <br>
                <a href="http://bossearn.com/verifyemail.php/?email=<?php echo $email; ?>&expire=<?php echo $expire; ?>">
                    <button style="
                            background-color: lightblue; 
                            color: white;
                            padding: 10px 50px 10px 50px;
                            border: none;
                            border-radius: 5px;
                            font-size: 20px;
                    ">
                        verify email
                    </button>
                </a>
            </main>
            <footer style="height: 50px;">
                <div>
                    <ul>
                        <li style="color: white;">&copy; bossearn inc. <?php echo date('Y'); ?></li>
                    <ul>
                </div>                  
            </footer>
        </div>
    </body>
</html>
