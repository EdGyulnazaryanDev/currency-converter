<?php

function dd(...$vars)
{
    if (!in_array(PHP_SAPI, ['cli', 'phpdbg'], true)) {
        header('Content-Type: text/html');
        echo '<style>
            pre.dump {
                background: #f5f5f5;
                padding: 15px;
                border-radius: 4px;
                border-left: 4px solid #3f9ae5;
                color: #333;
                font-family: monospace;
                font-size: 14px;
                line-height: 1.5;
                margin: 15px 0;
                overflow: auto;
            }
            .dump-title {
                color: #3f9ae5;
                font-weight: bold;
                margin-bottom: 5px;
            }
        </style>';
    }

    $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
    $calledFrom = basename($backtrace['file']) . ':' . $backtrace['line'];

    foreach ($vars as $var) {
        if (!in_array(PHP_SAPI, ['cli', 'phpdbg'], true)) {
            echo '<div class="dump">';
            echo '<div class="dump-title">' . $calledFrom . '</div>';
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
            echo '</div>';
        } else {
            echo "\n" . $calledFrom . "\n";
            var_dump($var);
            echo "\n";
        }
    }

    die(1);
}