<?php

require 'vendor/autoload.php';
ini_set('display_errors', 1);

use WhcApp\Add;
use WhcApp\Sort;
use WhcApp\GitDescription;
use WhcApp\PerformOperation;

const ADD = 'add';
const SORT = 'sort';
const REPO_DESC = 'repo-desc';

$errors = [];
$data = [];
$input = [];

// Validate input values
if (!empty($_POST['input']) && isset($_POST['input'])) {
    $input = explode(" ", $_POST['input']);
} else {
    $errors['message_1'] = 'Input is required.';
}

// Save command in a variable
$command = $input ? array_shift($input) : null;

// Validate array of arguments
if(empty($input)){
    $errors['message_2'] = 'Arguments are required.';
}

switch($command){
    case ADD:
        if(!validateNumberArray($input)) {
          $errors['message_3'] = 'Please enter number array for addition of numbers';    
        }
        $opp = new Add($input);
        break;

    case SORT:
        if(!validateNumberArray($input)) {
            $errors['message_3'] = 'Please enter number array for sorting of numbers';    
        }
        $opp = new Sort($input);
        break;
    
    case REPO_DESC:
        $opp = new GitDescription($input);
        break;

    default:
        $errors['message_3'] = 'Please enter valid command!';
        break;
}

// Validate numeric array for numeric operations.
function validateNumberArray($arr) 
{
    return array_sum(array_map('is_numeric', $arr)) == count($arr);
}

if (!empty($errors)) {
    $data['errors'] = $errors;
    $data['success'] = false;
} else {
    $app = new PerformOperation;
    $data['result'] = $app->process($opp);
    $data['success'] = true;
}

// Return output to view
echo json_encode($data);
