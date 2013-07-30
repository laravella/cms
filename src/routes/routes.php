<?php

Route::get('/cms', 'CMSController');

Route::get('/db/api/{call}', function() {echo DbGopher::greeting();});

?>
