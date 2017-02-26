<?php

function getConfig() {
    $site_config = array(
        'SITE_SIGLA' => "SITE",
        'SITE_NOME' => "Nome por Extenso do Site",
        'SITE_PATH' => "http://localhost/cige1/",
        'SITE_LOGO' => "img/logo_luva.png",
        'SITE_PASTA' => "cige1",
        'DB_BANCO' => "cige1",
        'DB_USER' => "root",
        'DB_PASS' => "@!@#rf",
        'SITE_CHARSET_AJAX' => "UTF-8" //UTF-8 OU ISO-8859-1
    );
    return $site_config;
}

?>