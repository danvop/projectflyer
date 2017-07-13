<?php

/**
 * Display a flash message
 * @param  string $title
 * @param  string $message
 * @return void
 */
function flash($title = null, $message = null)
{
    $flash = app('App\Http\Flash');
    
    if (func_num_args() == 0) {
        return $flash;
    }

    return $flash->info($title, $message);
}

/**
 * The path to a given flyer
 * @param  App\Flyer  $flyer
 * @return string
 */
function flyer_path(App\Flyer $flyer)
{
    return $flyer->zip . '/' . str_replace(' ', '-', $flyer->street);
}

function link_to($body, $path, $type)
{
    $csrf = csrf_field();

    if (is_object($path)) {
        $action = $path->getTable();

        if (in_array($type, ['PUT', 'PATCH', 'DELETE'])) {
            $action .= '/' . $path->getKey();
        } 
    } else {
        $action = $path;
    }

    return <<<EOT
        <form method="POST" action="/photos/{$action}">
            <input type="hidden" name="_method" value='{$type}'>
            $csrf
            <button type="submit">{$body}</button>
        </form>
EOT;
    
}
