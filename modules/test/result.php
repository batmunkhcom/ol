result text
<?php
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents('php://input'), $requestData);

    dump($requestData);
}
