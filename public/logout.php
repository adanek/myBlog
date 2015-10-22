<?php
include_once('../app/services/session.php');
include_once('../app/services/HttpService.php');

session_destroy();
HttpService::redirect_to('/');
