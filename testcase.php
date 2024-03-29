<?php
/** op-app-skeleton-2020:/testcase.php
 *
 * <pre>
 * How to use: `php -S localhost:8000 ./testcase.php`
 * curl http://localhost:8000/?path=/asset/core/testcase/testcase.php&display=1
 *      http://localhost:8000/?path=/asset/core/testcase/Testcase.php&display=
 * </pre>
 *
 * @created     2023-04-24
 * @version     1.0
 * @package     op-app-skeleton-2020
 * @author      Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright   Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

/** Execute time.
 *
 */
define('_OP_APP_START_', microtime(true));

//  ...
$exit = 0;

//  ...
try {
    //  Set app:/
    $_SERVER['APP_ROOT'] = realpath(__DIR__).'/';

    //  ...
    include(__DIR__.'/asset/init.php');

    //  ...
    if(!OP()->Env()->isAdmin() ){
        echo "-1\n";
        if( OP()->Request('display') ){
            echo "You are not admin.";
        }
        exit(__LINE__);
    }

    //  ...
    if( $_GET['path'] ){
        testcase();
    }else{
        file_list();
    }

}catch( \Throwable $e ){
    //  ...
    $message = $e->getMessage();

    //  ...
    echo "\n\n";
    echo "Exception: {$message}\n\n";
    foreach( $e->getTrace() as $trace){
        echo ' * '.OP::DebugBacktraceToString($trace)."\n";
    }
    echo "\n";

    //  ...
    $exit = __LINE__;
}

//  exit
exit($exit);

/** Return file list by json.
 *
 *  @created    2023-04-24
 */
function file_list()
{
    /* @var $git UNIT\Git */
    $git = OP::Unit('Git');
    $configs = $git->SubmoduleConfig();

    //  ...
    $result = [];
    foreach( $configs as $config ){
        //  ...
        chdir( OP::MetaPath('git:/') );

        //  ...
        $path = "{$config['path']}/testcase/";
        if(!file_exists($path) ){
            continue;
        }

        //  ...
        foreach( glob("{$path}*.php") as $path ){
            //  ...
            $file = basename($path);
            $char = $file[0];

            //  ...
            if( $char === '.' or $char === '_' or $char !== strtoupper($char) ){
                continue;
            }

            $result[] = $path;
        }
    }

    //  ...
    echo json_encode($result);
}

/** Do testcase.
 *
 *  @created    2023-04-24
 */
function testcase()
{
    //  ...
    OP()->MIME('text/plain');
    $path = OP()->Request('path');
    $data = OP()->GetTemplate($path);

    //  ...
    if( OP()->Notice()->Has() ){
        echo "{$path}\n\n{$data}\n";
    }else{
        echo "1\n";
    }

    //  ...
    if( OP()->Request('display') ){
        echo $data;
    }
}
