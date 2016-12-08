<?php
// Fetch the hidden fields which contain __VIEWSTATE & others on existing form
$loginPage = 'https://login.webgistix.com'; // Existing ASPX login form URL
$loginPageContents = file_get_contents($loginPage);
preg_match_all('/<input type="hidden" name="(.*?)" id="(.*?)" value="(.*?)" \/>/si', $loginPageContents, $loginPageHiddenFields);

// This part goes in your form along with the other necessary fields, such as username & password
if(is_array($loginPageHiddenFields[0])):
    foreach($loginPageHiddenFields[0] as $f):
        echo $f;
    endforeach;
endif;