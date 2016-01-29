<?php

require INC_ROOT . '/app/routes/home.php';
require INC_ROOT . '/app/routes/auth/register.php';
require INC_ROOT . '/app/routes/auth/login.php';
require INC_ROOT . '/app/routes/auth/logout.php';
require INC_ROOT . '/app/routes/auth/activate.php';
require INC_ROOT . '/app/routes/auth/password/change.php';
require INC_ROOT . '/app/routes/auth/password/recover.php';
require INC_ROOT . '/app/routes/auth/password/reset.php';

require INC_ROOT . '/app/routes/user/all.php';
require INC_ROOT . '/app/routes/user/profile.php';

require INC_ROOT . '/app/routes/admin/example.php';

require INC_ROOT . '/app/routes/account/profile.php';

require INC_ROOT . '/app/routes/errors/404.php';

