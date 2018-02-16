<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/backend/inc.php';

class abcd extends table {
    protected $table = __CLASS__;
}

$abcd = new abcd();

$abcd
// ->where('deleted_at', 'IS NOT', 'NULL')
// ->where('q','=','1')
// ->get(1,2);
// ->withTrashed()
// ->trashed()
->all();
// ->first()
// ->trash();
// ->update('q', 1);
// ->restore();

echo '<pre>';
print_r($abcd);
echo '</pre>';

?>