user profile<br>
id: <?php echo get('id'); ?>
<br>
<?php
$a = array('b' => array(
        'c', 'd', 'e',
        'f' => array(
            'g', 'h' => 'iii'
        )
        ));
echo json_encode($a);

print_r($_POST);

$r->set(session_id(), serialize($_SESSION));
$a = unserialize($r->get(session_id()));


$_SESSION['a'];

function session_get($key) {
    global $r;
}
