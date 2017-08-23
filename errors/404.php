<?php
echo "404";

if (file_exists('debug.txt')) {
    pr($e->getMessage() );
}