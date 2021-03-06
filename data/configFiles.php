<?php
return array(
    array(
        'name'    => 'Persistences',
        'title'   => 'The persistence configuration contains a list of persistences' . PHP_EOL .
                     ' * identified by name.',
        'descrip' => 'See common_persistence_Manager for a list of drivers' . PHP_EOL .
                     ' * provided by  generis. Aditional drivers can be used by setting' . PHP_EOL .
                     ' * the drivers full class name',
        'path'    => 'config/generis/persistences.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'Auth',
        'title'   => 'Auth',
        'descrip' => '',
        'path'    => 'config/generis/auth.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'Installation',
        'title'   => 'Installation',
        'descrip' => '',
        'path'    => 'config/generis/installation.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'Log',
        'title'   => 'Log',
        'descrip' => '',
        'path'    => 'config/generis/log.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'Mail',
        'title'   => 'Mail',
        'descrip' => '',
        'path'    => 'config/generis/mail.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'Ontology',
        'title'   => 'Ontology',
        'descrip' => '',
        'path'    => 'config/generis/ontology.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'Permissions',
        'title'   => 'Permissions',
        'descrip' => '',
        'path'    => 'config/generis/permissions.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'Profiler',
        'title'   => 'Profiler',
        'descrip' => '',
        'path'    => 'config/generis/profiler.conf.php',
        'prepend' => '',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_STRING,
    ),
    array(
        'name'    => 'FileSystemAccess',
        'title'   => 'File system access',
        'descrip' => '',
        'path'    => 'config/tao/filesystemAccess.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'DefaultUploadFileSource',
        'title'   => 'Default upload file source',
        'descrip' => '',
        'path'    => 'config/tao/defaultUploadFileSource.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'FuncAccessControl',
        'title'   => 'Func access control',
        'descrip' => '',
        'path'    => 'config/tao/FuncAccessControl.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'ServiceFileStorage',
        'title'   => 'Service file storage',
        'descrip' => '',
        'path'    => 'config/tao/ServiceFileStorage.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'ExecutionService',
        'title'   => 'Execution service',
        'descrip' => '',
        'path'    => 'config/taoDelivery/execution_service.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'DefaultItemFileSource',
        'title'   => 'Default item file source',
        'descrip' => '',
        'path'    => 'config/taoItems/defaultItemFileSource.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'QtiItemHook',
        'title'   => 'Qti item hook',
        'descrip' => '',
        'path'    => 'config/taoQtiItem/hook.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'QtiItemLibraries',
        'title'   => 'Qti item local shared libraries',
        'descrip' => '',
        'path'    => 'config/taoQtiItem/local_shared_libraries.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'QtiAcceptableLatency',
        'title'   => 'Qti acceptable latency',
        'descrip' => '',
        'path'    => 'config/taoQtiTest/qtiAcceptableLatency.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'QtiTestFolder',
        'title'   => 'Qti test folder',
        'descrip' => '',
        'path'    => 'config/taoQtiTest/qtiTestFolder.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'DefaultResultServer',
        'title'   => 'Default result server',
        'descrip' => '',
        'path'    => 'config/taoResultServer/default_resultserver.conf.php',
        'prepend' => 'return ',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_ARRAY,
    ),
    array(
        'name'    => 'Generis',
        'title'   => 'Generis',
        'descrip' => '',
        'path'    => 'config/generis.conf.php',
        'prepend' => '',
        'type'    => taoUpdate_helpers_ConfigWriter::CONFIG_TYPE_STRING,
    ),
);