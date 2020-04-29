<?php



  

    $mail = $_POST['email'];
    $mensaje = $_POST['mensaje'];
    $headers = "From: $mail";
    $sent = mail('nomonoboa@gmail.com', 'Feedback Form Submission', $mensaje, $headers);
    if ($sent) {

    ?> <html>
    <head>
    <title>Thank You</title>
    </head>
    <body>
    <h1>Thank You</h1>
    <p>Thank you for your feedback.</p>
    </body>
    </html>

    <?php

    } else {
    ?><html>
    <head>
    <title>Something went wrong</title>
    </head>
    <body>
    <h1>Something went wrong</h1>
    <p>We could not send your feedback. Please try again.</p>
    </body>
    </html>
    <?php
    }
    ?>

    