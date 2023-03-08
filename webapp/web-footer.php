<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

$_rootURL = $_SESSION['WEB_ROOTURL_LOCAL'];
$_rootSource = $_rootURL . "source";

$_rawscript = <<<RAWSCRIPT

<script type="text/javascript" src="$_rootSource/jQuery/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="$_rootSource/bootstrap5/5.3.0/js/bootstrap.js"></script>
<script type="text/javascript" src="$_rootSource/DataTables/1.13.2/js/jquery.dataTables.js"></script>

<script>
$(document).ready( function() {
    $('.gridview').DataTable({
        'columnDefs': [{'orderable': false, 'targets': [0, 1] }],
        'order': [2, 'asc'],
        'aaSorting': []
    });
    $('.onetomany').DataTable({
        'columnDefs': [{'orderable': false, 'targets': [0, 1] }],
        'order': [2, 'asc'],
        'aaSorting': [],
        'paging': false,
        'searching': false
    });
});
</script>

RAWSCRIPT;
echo $_rawscript;

?>