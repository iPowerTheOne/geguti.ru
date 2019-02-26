<?php
router::add('index\.html','home/home/default');
router::add('callback\.html','callback/callback/default');
router::add('thanks\.html','callback/thanks/default');
router::add('404\.html','error/error/404');
router::add('admin','admin/admin/default');
router::add('([a-z0-9\-]+ as name)\.html',  'pages/pages/default');
?>