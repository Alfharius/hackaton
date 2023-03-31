<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.$_SERVER["REMOTE_ADDR"].':3306;dbname=intensive',
    'username' => 'tuneyadec',
    'password' => 'tuneyadec',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
