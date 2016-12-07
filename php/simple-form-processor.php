<?php

// If request is a form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $company = $_POST['company'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $comments = strip_tags($_POST['comments']);

    $errors = array();

    // Validation

    // Check first_name is not blank
    if (0 === preg_match("/\S+/", $firstName)) {
        $errors['firstName'] = "Please enter a first name.";
    }

    // Check last_name is not blank
    if (0 === preg_match("/\S+/", $lastName)) {
        $errors['lastName'] = "Please enter a last name.";
    }

    // Check first and last names for identical input
    if ($firstName == $lastName) {
        if (!empty($firstName) || !empty($lastName)) {
            $errors[] = "First and last names can not match.";
        }
    }

    // Check email is valid (enough)
    if (0 === preg_match("/.+@.+\..+/", $_POST['email'])) {
        $errors['email'] = "Please enter a valid email address.";
    }

    // If there are validation errors, render this HTML
    if (!empty($errors)) {  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
    .error-list {
        width: 475px;
        margin: 50px auto 0;
        font-family: 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;
        text-align: center;
    }
    ul {
        margin: 50px 0;
    }
    li {
        color: red;
        font-weight: bold;
    }
    .notice {
        font-size: 18px;
        text-transform: uppercase;
    }
    .action {
        font-weight: bold;
    }
    </style>
    <title>Your form has errors!</title>
</head>
<body>

    <div class="error-list">
        <p class="notice">Your form contained the following errors:</p>
        <ul>
            <?php foreach($errors as $error) { ?>
            <li><?php echo($error) ?></li>
            <?php } ?>
        </ul>
        <p class="action">Press your browser's back button to correct your entries.</p>
    </div>

</body>
</html>
    <?php // If there are no errors
    } else {

$headers = "MIME-Version: 1.0"."\n";
$headers .= "Content-type: text/html; charset=iso-8859-1"."\n";
$headers .= "From: NAME <name@example.com>"."\n";
$headers .= "Return-Path: NAME <name@example.com>"."\n";
$headers .= "Reply-To: NAME <name@example.com>";
$emailSubject = 'Email subject';

// Email body. There must be NO WHITESPACE after <<<EOD and start of email HTML
$body = <<<EOD
<table width='500' border='0' cellspacing='10' cellpadding='0'>
    <tr>
      <td width='50%' align='right'><strong>Name</strong></td>
      <td width='50%'>$firstName $lastName</td>
    </tr>
    <tr>
      <td width='50%' align='right'><strong>Email</strong></td>
      <td width='50%'><a href="mailto:$email">$email</a></td>
    </tr>
    <tr>
      <td width='50%' align='right'><strong>Phone</strong></td>
      <td width='50%'>$telephone</td>
    </tr>
    <tr>
      <td width='50%' align='right'><strong>Address</strong></td>
      <td width='50%'>$address<br/>$city, $state $zip</td>
    </tr>
    <tr>
      <td width='50%' align='right' valign='top'><strong>Comments</strong></td>
      <td width='50%' valign='top'>$comments</td>
    </tr>
</table>
EOD;


// Send the email. This line duplicated for each recipient defined above.
$success = mail("adam@adamwalter.com", $emailSubject, $body, $headers);

// Location of Thank You page
header('Location: nextpage.php');

    }
}
