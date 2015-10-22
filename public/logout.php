<?php
include_once('../app/services/session.php');
include_once('../app/services/HttpService.php');
include_once('../app/services/AuthenticationService.php');


AuthenticationService::logout();
HttpService::redirect_to('/');
