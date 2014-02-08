<?php
return array(
 
   'driver' => 'smtp',
 
   'host' => 'smtp.gmail.com',
 
   'port' => 587,
 
   'from' => array('address' => 'webapp@contact.com', 'name' => 'WebApp Message'),
 
   'encryption' => 'tls',
 
   'username' => 'thomalucho@gmail.com',
 
   'password' => 'motogp2009',
 
   'sendmail' => '/usr/sbin/sendmail -bs',
 
   'pretend' => false,
 
);