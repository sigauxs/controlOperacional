<?php  


require 'vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = Mailgun::create('29fe08ed8985e3d324682fb0ed7c2e95-4dd50799-97ae7165', 'https://api.mailgun.net/v3/sandboxdc085a213c484c2da8ac23dc705df5b2.mailgun.org');
$domain = "sandboxdc085a213c484c2da8ac23dc705df5b2.mailgun.org";
$params = array(
  'from'    => 'jsalgadoecheverria@gmail.com',
  'to'      => 'jasen192021@gmail.com',
  'subject' => 'Hello',
  'text'    => 'Testing some Mailgun awesomness!'
);

# Make the call to the client.
$mgClient->messages()->send($domain, $params);


?>