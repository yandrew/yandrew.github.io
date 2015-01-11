<?php
// Information to be modified
$your_email = "you@mail.com"; // email address to which the form data will be sent
$subject = "Contact Form"; // subject of the email that is sent
$thanks_page = "index.html"; // path to the thank you page following successful form submission
$contact_page = "index.html"; // path to the HTML contact page where the form appears


// Nothing needs to be modified below this line

if (!isset($_POST['submit'])) {
    header( "Location: $contact_page" );
  }

if (isset($_POST["submit"])) {
	$nam = $_POST["name"];
	$ema = trim($_POST["email"]);
	$com = $_POST["comments"];
	$spa = $_POST["spam"];

	if (get_magic_quotes_gpc()) { 
	$nam = stripslashes($nam);
	$ema = stripslashes($ema);
	$com = stripslashes($com);
	}

$error_msg=array(); 

if (empty($nam) || !preg_match("/^[A-Za-z\-'\s\p{Arabic}]+$/u", $nam)) { 
$error_msg[] = "Use True Characters for Name and ...";
}

if (empty($ema) || !filter_var($ema, FILTER_VALIDATE_EMAIL)) {
	$error_msg[] = "Your Mail Must Be Like this: name@example.com";
}

$limit = 1000;

if (empty($com) || !preg_match("/^[A-Za-z\.,\-\/'\(\)!\?\s\p{Arabic}]+$/u", $com) || (strlen($com) > $limit)) { 
$error_msg[] = "Use True Characters for Message and ...";
}

if (!empty($spa) && !($spa == "4" || $spa == "four")) {
	echo "You failed the spam test!";
	exit ();
}

// Assuming there's an error, refresh the page with error list and repeat the form

if ($error_msg) {
echo '<h1>Bad Email Address! or External Error...</h1>';
foreach ($error_msg as $err) {
echo '<li>'.$err.'</li>';
}
echo '';
exit();
} 

$email_body = 
	"from: $nam\n\n" .
	"email: $ema\n\n" .
    "message:\n\n" .
	"$com" ; 

// Assuming there's no error, send the email and redirect to Thank You page

if (isset($_REQUEST['comments']) && !$error_msg) {
mail ($your_email, $subject, $email_body, "From: $nam <$ema>" . "\r\n" . "Reply-To: $nam <$ema>");
header ("Location: $thanks_page");
exit();
}  
}