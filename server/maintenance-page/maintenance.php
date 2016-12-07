<?php
$protocol = 'HTTP/1.0';
if ('HTTP/1.1' == $_SERVER['SERVER_PROTOCOL']) $protocol = 'HTTP/1.1';
header("$protocol 503 Service Unavailable", true, 503);
header('Retry-After: 3600');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="none">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600' rel='stylesheet' type='text/css'>
    <style>
        * {
            -webkit-box-sizing: border-box;
               -moz-box-sizing: border-box;
                    box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            background: #f1f1f1;
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
        }
        div {
            max-width: 23.75em;
            margin: 5% auto 0;
            padding: 0 5%;
            color: #464646;
            font-family: 'Source Sans Pro', sans-serif;
            line-height: 1.25;
        }
        h1 {
            font-size: 1.75em;
            letter-spacing: -1px;
        }
        hr {
            clear: both;
            width: 50%;
            height: 1px;
            margin: 1.5em 0;
            padding: 0;
            border: 0;
            border-top: 1px solid #D7D7D7;
        }
        p {
            font-size: 1em;
            line-height: 1.5;
        }
        a {
            font-weight: bold;
        }
        @media (min-width: 37.5em) {
            div {
                max-width: 28.125em;
                padding: 0;
            }
            h1 {
                font-size: 2.375em;
            }
            hr {
                margin: 1.75em 0;
            }
            p {
                font-size: 1.125em;
            }
        }
    </style>

    <title>Scheduled Maintenance</title>

</head>
<body>

    <div>
        <h1>We are currently undergoing scheduled maintenance.</h1>
        <hr>
        <p>We are sorry for the inconvenience and will be back online as soon as possible.</p>
    </div>

</body>
</html>