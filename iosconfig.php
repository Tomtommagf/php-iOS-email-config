<?php
/**
 * An array of trusted domains.
 * Requests with any domains not in this array shall be denied.
 * Entries should be in lower case only.
 */
$TRUSTEDDOMAINS = [
    "example.org",
    "example.com"
];

/**
 * @param email: The email address its domain name is to be retrieved
 * @returns the domain name in 'user@example.com'
 */
function getDomainName($email){
    $atPosition = stripos($email, "@", 0);
    return strtolower(substr($email, $atPosition+1));
}

/**
 * @param email: The email address its domain name is to be retrieved
 * @returns the display name for 'user@example.com'
 *          'jane@domain.tld'     -> 'Jane'
 *          'jane.doe@domain.tld' -> 'Jane Doe'
 */
function getDisplayName($email){
    $atPosition = stripos($email, "@", 0);
    $userPart = substr($email, 0, $atPosition);
    $dotPosition = stripos($userPart, ".", 0);
    $displayName = "";
    if ($dotPosition == false) {
      $displayName = ucfirst($userPart); // uppercase first character
    }
    else {
        $firstName = ucfirst(substr($userPart, 0, $dotPosition));
        $lastName = ucfirst(substr($userPart, $dotPosition+1));
        $displayName = $firstName . " " . $lastName;
    }
    return $displayName;
}

/**
 * @param email: the email address to be checked
 * @returns true, if email domain is in trusteddomains
 *          false, otherwise
 */
function isInTrustedDomain($email){
    global $TRUSTEDDOMAINS;
    $domainName = getDomainName($email);
    for($i = 0; $i < count($TRUSTEDDOMAINS); $i++){
        if(strcasecmp($domainName, $TRUSTEDDOMAINS[$i]) == 0) {
            return true;
        }
    }
    return false;
}

// only if all conditions are met, process the request
if (isset($_REQUEST['email']) && (strpos($_REQUEST['email'], "@") !== false) && isInTrustedDomain($_REQUEST['email'])): ?>

<?php
    header('Content-Type: text/plain');
    header("Content-Disposition: attachment; filename=\"email.mobileconfig\"");
    $displayName = getDisplayName($_REQUEST['email']);
    
    $conf = file_get_contents('iosconfig.mobileconfig');
    $conf = str_replace('MAILADDR', $_REQUEST['email'], $conf);
    $conf = str_replace('DISPLAYNAME', $displayName, $conf);
    
    print $conf;
?>

<?php else: ?>

<!DOCTYPE html>

<head>
    <title>iOS Configuration</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
</head>

<body>
    <h2>Download iOS Profile</h2>
    <p style="color:red">Error: Please enter a valid e-mail address!</p>
    <form action="./iosconfig.php" method="post">
        <p>Enter your e-mail address to get an individual iOS profile.</p><br />
        <input name="email" type="email" required><br />
        <button type="submit">Download</button>
    </form>
    <br />
    <p style="color:#f98113">Note: You should download this profile in the safari browser. The password to be entered is the same as your e-mail account's password.</p>
</body>

</html>
<?php endif ?>
