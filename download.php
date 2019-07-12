<?php

    session_start();
    include_once 'php/config/config.php';

    if(isset( $_GET['entidade'], $_GET['id'] ))
    {
    	$entidade = $_GET['entidade'];
    	$id = $_GET['id'];	
    	switch ($entidade) {
            case 'landing':
                $obj = Landing::get(['url' => $_GET['id']]);
                Download::exec($obj->arquivo, $obj->url);
                break;
            case 'material':
                $obj = BlogMaterial::get(['url' => $_GET['id']]);
                Download::exec($obj->arquivo, $obj->url);
                break;
    		default:
    			break;
    	}
    }




?>