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

$a[session_id] = $_SESSION;

$r->set('a', serialize($a));
$a = unserialize($r->get(session_id()));


$_SESSION['a'];

function session_get($key) {
    global $r;
    $a = unserialize($r->get('a'));

    return $a[session_id()][$key];
}

echo session_get('a');
