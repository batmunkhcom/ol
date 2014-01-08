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
?>