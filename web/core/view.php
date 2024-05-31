<?php
function view($name, $values)
{
    foreach ($values as $key => $value) {
        $$key = $value;
    }
    require APP_DIR . 'views/' . $name . '.php';
}

function layout($name)
{
    require APP_DIR . 'views/layout/' . $name . '.php';

}

function setFlashMessage(string $type, string $message){
    $_SESSION['flash_message'] = ['type' => $type, 'message' => $message];
}
function getFlashMessage(): ?array{
    if (isset($_SESSION['flash_message'])){
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $message;
    }else{
        return null;
    }
}