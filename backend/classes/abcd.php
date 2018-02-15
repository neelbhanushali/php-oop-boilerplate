<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/backend/inc.php';

class abcd extends table {
    protected $table = __CLASS__;
}

$abcd = new abcd();

$abcd
->where('q', '=', '2')
// ->where('sq','=','i')
// ->get(1,2);
// ->all();
// ->first();
// ->update('q', 1);

echo '<pre>';
print_r($abcd);
echo '</pre>';

?>