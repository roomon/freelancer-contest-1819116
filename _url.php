<?php

return preg_replace('/\/?([a-z]+\.php)$/', '', 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
