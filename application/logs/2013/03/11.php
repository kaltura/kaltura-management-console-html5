<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2013-03-11 18:43:43 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined function ldap_connect() ~ APPPATH/vendor/bcsldap.php [ 80 ] in :
2013-03-11 18:43:43 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in :
2013-03-11 19:13:12 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: sessionID ~ APPPATH/classes/Controller/User.php [ 39 ] in /opt/kaltura/app/alpha/web/kaltura/application/classes/Controller/User.php:39
2013-03-11 19:13:12 --- DEBUG: #0 /opt/kaltura/app/alpha/web/kaltura/application/classes/Controller/User.php(39): Kohana_Core::error_handler(8, 'Undefined varia...', '/opt/kaltura/ap...', 39, Array)
#1 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Controller.php(84): Controller_User->action_login()
#2 [internal function]: Kohana_Controller->execute()
#3 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_User))
#4 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 /opt/kaltura/app/alpha/web/kaltura/index.php(118): Kohana_Request->execute()
#7 {main} in /opt/kaltura/app/alpha/web/kaltura/application/classes/Controller/User.php:39
2013-03-11 19:14:12 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: sessionID ~ APPPATH/classes/Controller/User.php [ 40 ] in /opt/kaltura/app/alpha/web/kaltura/application/classes/Controller/User.php:40
2013-03-11 19:14:12 --- DEBUG: #0 /opt/kaltura/app/alpha/web/kaltura/application/classes/Controller/User.php(40): Kohana_Core::error_handler(8, 'Undefined varia...', '/opt/kaltura/ap...', 40, Array)
#1 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Controller.php(84): Controller_User->action_login()
#2 [internal function]: Kohana_Controller->execute()
#3 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_User))
#4 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 /opt/kaltura/app/alpha/web/kaltura/index.php(118): Kohana_Request->execute()
#7 {main} in /opt/kaltura/app/alpha/web/kaltura/application/classes/Controller/User.php:40
2013-03-11 19:17:47 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: url_var ~ APPPATH/classes/Controller/Categories.php [ 47 ] in /opt/kaltura/app/alpha/web/kaltura/application/classes/Controller/Categories.php:47
2013-03-11 19:17:47 --- DEBUG: #0 /opt/kaltura/app/alpha/web/kaltura/application/classes/Controller/Categories.php(47): Kohana_Core::error_handler(8, 'Undefined varia...', '/opt/kaltura/ap...', 47, Array)
#1 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Controller.php(84): Controller_Categories->action_list()
#2 [internal function]: Kohana_Controller->execute()
#3 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Categories))
#4 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 /opt/kaltura/app/alpha/web/kaltura/index.php(118): Kohana_Request->execute()
#7 {main} in /opt/kaltura/app/alpha/web/kaltura/application/classes/Controller/Categories.php:47
2013-03-11 19:18:45 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: url_var ~ APPPATH/classes/Controller/Categories.php [ 47 ] in /opt/kaltura/app/alpha/web/kaltura/application/classes/Controller/Categories.php:47
2013-03-11 19:18:45 --- DEBUG: #0 /opt/kaltura/app/alpha/web/kaltura/application/classes/Controller/Categories.php(47): Kohana_Core::error_handler(8, 'Undefined varia...', '/opt/kaltura/ap...', 47, Array)
#1 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Controller.php(84): Controller_Categories->action_list()
#2 [internal function]: Kohana_Controller->execute()
#3 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Categories))
#4 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /opt/kaltura/app/alpha/web/kaltura/system/classes/Kohana/Request.php(990): Kohana_Request_Client->execute(Object(Request))
#6 /opt/kaltura/app/alpha/web/kaltura/index.php(118): Kohana_Request->execute()
#7 {main} in /opt/kaltura/app/alpha/web/kaltura/application/classes/Controller/Categories.php:47