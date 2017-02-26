<?php

    /**
     * Description of Usuario
     *
     * @author juscelino
     */
    class Usuario extends DB{

        public function getAllUsuarios() {
//                $select = self::conn()->prepare("SELECT U.*, P.* FROM USERS AS U INNER JOIN POSTO_GRAD AS P ON U.CD_PG = P.CD_PG ORDER BY U.CD_PG");
            $sql = ("SELECT U.*, P.* FROM USERS AS U INNER JOIN POSTO_GRAD AS P ON U.CD_PG = P.CD_PG ORDER BY U.CD_PG");

            try {
                $select = self::conn()->query($sql);
                return $select->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $ex) {
                echo $ex;
            }
        }

        public function getAllUsuariosAtivos() {
//                $select = self::conn()->prepare("SELECT U.*, P.* FROM USERS AS U INNER JOIN POSTO_GRAD AS P ON U.CD_PG = P.CD_PG ORDER BY U.CD_PG");
            $sql = ("SELECT U.*, P.* FROM USERS AS U INNER JOIN POSTO_GRAD AS P ON U.CD_PG = P.CD_PG WHERE U.STATUS = 1 ORDER BY U.CD_PG");

            $select = self::conn()->query($sql);
            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getAllUsuariosMot() {
            $sql = ("SELECT U.*, P.* FROM USERS AS U INNER JOIN POSTO_GRAD AS P ON U.CD_PG = P.CD_PG WHERE U.CD_NIVEL = 5 ORDER BY U.CD_PG");

            $select = self::conn()->query($sql);
            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getUsuarioCd($cd = null) {
            if ($cd != null) {
                $select = self::conn()->prepare("SELECT U.*, PG.* FROM USERS AS U INNER JOIN POSTO_GRAD AS PG ON U.CD_PG = PG.CD_PG WHERE CD_USER = $cd");

                $select->execute();
                return $select->fetchObject();
            }
        }

        public function cadUsuario($dados = null) {
            if ($dados != null) {
                $insert = self::conn()->prepare("INSERT INTO USERS (NOME, IDT, NOME_GUERRA, STATUS, CD_NIVEL, CD_PG, SENHA) VALUES (?, ?, ?, ?, ?, ?, ?)");

                if ($insert->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function cadUsuarioMot($dados = null) {
            if ($dados != null) {
                $insert = self::conn()->prepare("INSERT INTO USERS (NOME, IDT, NOME_GUERRA, STATUS, CD_NIVEL, CD_PG)"
                        . " VALUES (?, ?, ?, ?, ?, ?)");

                if ($insert->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function editUsuario($dados = null) {
            if ($dados != null) {
                $sql = "UPDATE USERS SET NOME = ?, IDT = ?, NOME_GUERRA = ?, STATUS = ?, CD_NIVEL = ?, CD_PG = ? "
                        . "WHERE CD_USER = ?";
                $update = self::conn()->prepare($sql);

                if ($update->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function editUsuarioMot($dados = null) {
            if ($dados != null) {
                $sql = "UPDATE USERS SET NOME = ?, IDT = ?, NOME_GUERRA = ?, CD_PG = ? "
                        . "WHERE CD_USER = ?";
                $update = self::conn()->prepare($sql);

                if ($update->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function delUsuario($cd = null) {
            if ($cd != null) {
                $delete = self::conn()->prepare("DELETE FROM USERS WHERE CD_USER = $cd");

                if ($delete->execute()) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function alterUsuarioP($dados = null) {
            if ($dados != null) {
                $up = self::conn()->prepare("UPDATE USERS SET SENHA = ? WHERE CD_USER = ?");

                if ($up->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function getTotalUsers() {
            $select = self::conn()->prepare("SELECT COUNT(CD_USER) AS QTDE FROM USERS");

            $select->execute();
            return $select->fetchObject();
        }

        public function confirmaUnicoUser($dados = null) {
            if ($dados != null) {
                $select = self::conn()->prepare("SELECT CD_USER FROM USERS WHERE IDT = $dados");
                $select->execute();
                return $select->fetchObject();
            }
        }

        public function getUsersOn() {
            $select = self::conn()->prepare("SELECT COUNT(CD_USER) AS QTDE FROM USERS WHERE ISLOGADO = 1");
            $select->execute();
            return $select->fetchObject();
        }

        public function sessionOn() {
            $select = self::conn()->query("SELECT CD_USER, IDT, LASTLOG, ISLOGADO FROM USERS WHERE ISLOGADO = 1");
            return $select->fetchALL(PDO::FETCH_OBJ);
        }

        public function killSessionOff($dados = null) {
            if ($dados != null) {
                $select = self::conn()->prepare("UPDATE USERS SET ISLOGADO = 0 WHERE CD_USER = ?");
                if ($select->execute()) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }

    }
    