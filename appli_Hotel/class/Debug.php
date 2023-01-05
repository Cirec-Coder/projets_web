<!-- ===================== class pour afficher un print_r ou var_dump =========================== -->

<?php
    class Debug {
        static function debug($var, $info='', $func = 'print_r'){
            echo '<div style="padding:5px 10px; margin-bottom:8px; font-size:13px; background:#FACFD3; color:#8E0E12; line-height:16px; border:1px solid #8E0E12; text-transform:none; overflow:auto; text-align:left;">';
                echo (!empty($info)) ? '<h3 style="color:#8E0E12; font-size:16px; padding:5px 0;">'.$info.'</h3>' : '';
                echo '<pre style="white-space:pre-wrap;">'.$func($var,true).'</pre>
            </div>';
        }
    }
?>