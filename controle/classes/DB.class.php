<?php

    /**
     * Classe de Conexão do Banco de Dados DB
     *
     * @author juscelino
     */
    class DB {

        private static $conn;

        public static function conn() {
            if (is_null(self::$conn)) {
                self::$conn = new PDO('mysql:host=localhost;dbname=sgi;', 'root', 'escom');
            }
            return self::$conn;
        }

    }
    