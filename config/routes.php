<?php
return array(
	'_root_'  => 'm3/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route 
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
