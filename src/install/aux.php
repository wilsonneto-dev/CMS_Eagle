<?php 

function ok($str)
{
    echo "<br /><span class=\"ok\">{$str}</span><br />";
}

function err($err)
{
    echo "<br /><span class=\"err\">{$err}</span><br />";
}

?>

<style>
    .ok {
        color: white;
        background-color: green;
        padding: 2px 5px;
        display: inline-block;
    }
    .err {
        color: white;
        background-color: red;
        display: inline-block;
    }
</style>