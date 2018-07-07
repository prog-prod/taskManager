<?php
namespace Autoloader;

require __DIR__.'/../vendor/autoload.php';
    class Autoloader
    {
        public static function autoload($file)
        {
            $file = str_replace('\\', '/', $file);
            $path = $_SERVER['DOCUMENT_ROOT'] . '/';
            $filepath = $_SERVER['DOCUMENT_ROOT'] . '/' . $file . '.class.php';

            if (file_exists($filepath))
            {
                require_once($filepath);
            }
            else
            {
                $flag = true;
                Autoloader::recursive_autoload($file, $path, $flag);
            }
        }

        public static function recursive_autoload($file, $path, $flag)
        {

            if (FALSE !== ($handle = @opendir($path)) && $flag)
            {
                while (FAlSE !== ($dir = readdir($handle)) && $flag)
                {

                    if (strpos($dir, '.') === FALSE)
                    {
                        $path2 = $path .'/' . $dir;
                        $filepath = $path2 . '/' . $file . '.class.php';
                        if (file_exists($filepath))
                        {
                            $flag = FALSE;
                            require_once($filepath);
                            break;
                        }
                        Autoloader::recursive_autoload($file, $path2, $flag);
                    }
                }
                closedir($handle);
            }
        }
    }
    \spl_autoload_register('Autoloader\Autoloader::autoload');
