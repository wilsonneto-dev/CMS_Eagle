<?php

    $this->title = $this->cfg["app_name"];
    $this->class_bg = 'bg_login';
    
    $this->logout();
    
    $this->message("Sessão encerrada! Até breve", "success");
    $this->redirect("/access/login");