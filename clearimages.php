<?php
function removeDir($path) {
    if (is_file($path)) {
      @unlink($path);
    } else {
        array_map('removeDir',glob('/*')) == @rmdir($path);
    }
    @rmdir($path);
}


function clear_old_files()
{

    $expire_time = 7200; // Время через которое файл считается устаревшим (в сек.)
    $dir = __DIR__ . "/uploads/";
  
 	echo  $dir;
    // проверяем, что $dir - каталог
    if (is_dir($dir))
    {
        // открываем каталог
        if ($dh = opendir($dir))
        {
            // читаем и выводим все элементы
            // от первого до последнего
            while (($file = readdir($dh)) !== false)
            {

                // текущее время
                $time_sec = time();
                // время изменения файла
                $time_file = filemtime($dir . $file);
                // тепрь узнаем сколько прошло времени (в секундах)
                $time = $time_sec - $time_file;

                $unlink = __DIR__ . '/uploads/' . $file;

                if (is_file($unlink))
                {
                    if ($time > $expire_time)
                    {

                        if (unlink($unlink))
                        {

                            echo 'Файл удален <br/>';

                        }
                        else
                        {

                            echo 'Ошибка при удалении файла';

                        }
                    }

                }
            }
            // закрываем каталог
            closedir($dh);
        }
    }

}
clear_old_files();
?>
