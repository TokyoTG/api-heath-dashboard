<?php
session_start();
if (isset($_POST['api_name'])) {
    if (find_api($_POST['api_name'])) {
        echo "API Name already exits <br>";
        die();
    }
    save_userObject($_POST, $_POST['api_name']);
    $_SESSION['success'] = "Request Sucessful";
    header("location:index.php");
}


function save_userObject($obj, $name)
{
    file_put_contents("db/" . $name . ".json", json_encode($obj));
}

function find_api($name = "")
{
    if (!$name) {
        echo "error", 'name not set';
        die();
    }
    $allapis = scandir('db/');
    $numOfapis = count($allapis);
    for ($counter = 2; $counter < $numOfapis; $counter++) {
        $currentApi = $allapis[$counter];
        if ($currentApi == $name . ".json") {
            return true;
        }
    }
    return false;
}
