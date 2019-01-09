<?php
    define("ALLOW_LOG",true);
    define("ALLOW_FILE_LOG",true);

    if (! function_exists('vd')) {
        function vd($var=null,$var_name=null)
        {
            try {
                if(ALLOW_LOG) {
                    echo "{$var_name}: ";
                    // $var_export_str = var_export($var,false);
                    if(is_array($var)) {
                        print_r($var);
                    } elseif(is_object($var)) {
                        print_r($var);
                    } else {
                        var_export($var,false);
                    }
                }
                if(ALLOW_FILE_LOG) {
                    vdfilelog($var,$var_name);
                }
            } catch(\Exception $e) {
            }
        }
    }

    if (! function_exists('vde')) {
        function vde($var=null,$var_name=null)
        {
            try {
                vd($var,$var_name);
                exit();
            } catch(\Exception $e) {
            }
        }
    }

    if (! function_exists('vdln')) {
        function vdln($var=null,$var_name=null)
        {
            try {
                vd($var,$var_name);
                echo "<br />\n";
            } catch(\Exception $e) {
            }
        }
    }

    if (! function_exists('vdfilelog')) {
        function vdfilelog($var,$var_name=null)
        {
            try {
                static $first_call = true;
                if($first_call) {
                    $time = "time: " . date("Y-m-d H:i:s") . "\n";
                } else {
                    $time = null;
                }
                $var_export_str = var_export($var,true);
                $str_end_append  = "--------------------------------------------------------------------------\n";
                $str = "{$time}{$var_name}: {$var_export_str}\n{$str_end_append}";
                
                $file = fopen("vdfilelog.txt","a");
                fwrite($file,$str);
                fclose($file);
                $first_call = false;
            } catch(\Exception $e) {
            }
        }
    }
        
