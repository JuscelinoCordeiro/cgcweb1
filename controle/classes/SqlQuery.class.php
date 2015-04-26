<?php

    /* Classe de Manipulação do Banco de Dados
     * 
     * @author juscelino
     */
    include_once 'db.class.php';

    class sqlQuery {
        //put your code here
    }

    class Viaturas extends DB {

        public function getViaturaCd($cd = null) {
            if ($cd != null) {
                $select = self::conn()->prepare("SELECT VIATURAS.*, FABRICANTE.*, MODELO.*, STATUS_VTR.* FROM VIATURAS INNER JOIN MODELO ON MODELO.CD_MOD = VIATURAS.CD_MOD INNER JOIN STATUS_VTR ON STATUS_VTR.CD_STATUS = VIATURAS.CD_STATUS INNER JOIN FABRICANTE ON FABRICANTE.CD_FAB = MODELO.CD_FAB WHERE VIATURAS.CD_VTR=$cd");

                $select->execute();
                return $select->fetchObject();
            }
        }

        public function cadViatura($dados = null) {
            if ($dados != null) {
                $insert = self::conn()->prepare("INSERT INTO VIATURAS (ANO, PLACA, EB, TIPO, FIM_GARANTIA, CD_MOD, CD_STATUS) VALUES (?, ?, ?, ?, ?, ?, ?)");

                if ($insert->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function editViatura($dados = null) {
            if ($dados != null) {
                $update = self::conn()->prepare("UPDATE VIATURAS SET ANO=?, PLACA=?, EB=?, TIPO=?, FIM_GARANTIA=?, CD_MOD=?, CD_STATUS=? WHERE CD_VTR=?");
                if ($update->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function editStatusViatura($dados = null) {
            if ($dados != null) {
                $update = self::conn()->prepare("UPDATE VIATURAS SET CD_STATUS=? WHERE CD_VTR=?");
                if ($update->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function editViaturaOd($dados = null) {
            if ($dados != null) {
                $update = self::conn()->prepare("UPDATE VIATURAS SET OD_ATUAL = ? WHERE CD_VTR = ?");
                if ($update->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function delViatura($cd = null) {
            if ($cd != null) {
                $delete = self::conn()->prepare("DELETE FROM VIATURAS WHERE CD_VTR=$cd");

                if ($delete->execute()) {
                    return true;
                } else {
                    return false;
                }
            }
        }

//    public function getViaturas() {
//        $select = self::conn()->query("SELECT VIATURAS.CD_VTR, VIATURAS.EB, VIATURAS.PLACA, FABRICANTE.CD_FAB, FABRICANTE.FABRICANTE, MODELO.CD_MOD, MODELO.MODELO, VIATURAS.TIPO, VIATURAS.ANO, STATUS_VTR.CD_STATUS, STATUS_VTR.STATUS, VIATURAS.OD_ATUAL, VIATURAS.FIM_GARANTIA FROM VIATURAS INNER JOIN FABRICANTE ON FABRICANTE.CD_FAB = VIATURAS.CD_FAB INNER JOIN MODELO ON MODELO.CD_MOD = VIATURAS.CD_MOD INNER JOIN STATUS_VTR ON STATUS_VTR.CD_STATUS = VIATURAS.CD_STATUS ORDER BY STATUS_VTR.CD_STATUS LIMIT 8");
//        return $select->fetchAll(PDO::FETCH_OBJ);
//    }

        public function getViaturas($inicio = null, $maximo = null) {
            $select = self::conn()->query("SELECT VIATURAS.*, MODELO.*, FABRICANTE.*, STATUS_VTR.* "
                    . "FROM VIATURAS INNER JOIN MODELO ON MODELO.CD_MOD = VIATURAS.CD_MOD "
                    . "INNER JOIN STATUS_VTR ON STATUS_VTR.CD_STATUS = VIATURAS.CD_STATUS "
                    . "INNER JOIN FABRICANTE ON FABRICANTE.CD_FAB = MODELO.CD_FAB "
                    . "ORDER BY STATUS_VTR.CD_STATUS LIMIT $inicio, $maximo");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getViaturaNDisp($inicio = NULL, $maximo = NULL) {
            $select = self::conn()->query("SELECT VIATURAS.*, FABRICANTE.*, MODELO.*, STATUS_VTR.* "
                    . "FROM VIATURAS INNER JOIN MODELO ON MODELO.CD_MOD = VIATURAS.CD_MOD "
                    . "INNER JOIN STATUS_VTR ON STATUS_VTR.CD_STATUS = VIATURAS.CD_STATUS "
                    . "INNER JOIN FABRICANTE ON FABRICANTE.CD_FAB = MODELO.CD_FAB "
                    . "WHERE VIATURAS.CD_STATUS  <> 1 LIMIT $inicio, $maximo");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getViaturasDisp() {
            $select = self::conn()->query("SELECT VIATURAS.*, MODELO.*, FABRICANTE.*, STATUS_VTR.* "
                    . "FROM VIATURAS INNER JOIN MODELO ON MODELO.CD_MOD = VIATURAS.CD_MOD "
                    . "INNER JOIN STATUS_VTR ON STATUS_VTR.CD_STATUS = VIATURAS.CD_STATUS "
                    . "INNER JOIN FABRICANTE ON FABRICANTE.CD_FAB = MODELO.CD_FAB "
                    . "WHERE VIATURAS.CD_STATUS = 1 ORDER BY MODELO.MODELO");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getFabricante() {
            $select = self::conn()->query("SELECT * FROM FABRICANTE");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getFabVtr($cd = null) {
            if ($cd != null) {
                $select = self::conn()->query("SELECT * FROM FABRICANTE WHERE CD_FAB NOT IN (SELECT CD_FAB FROM VIATURAS WHERE CD_VTR=$cd)");

                return $select->fetchAll(PDO::FETCH_OBJ);
            }
        }

        public function getModelo() {
            $select = self::conn()->query("SELECT MODELO.*, FABRICANTE.* FROM MODELO INNER JOIN FABRICANTE ON MODELO.CD_FAB = FABRICANTE.CD_FAB");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getModVtr($cd = null) {
            if ($cd != null) {
                $select = self::conn()->query("SELECT MODELO.*, FABRICANTE.* FROM MODELO INNER JOIN FABRICANTE ON MODELO.CD_FAB = FABRICANTE.CD_FAB WHERE CD_MOD NOT IN (SELECT CD_MOD FROM VIATURAS WHERE CD_VTR=$cd)");

                return $select->fetchAll(PDO::FETCH_OBJ);
            }
        }

        public function getStatus() {
            $select = self::conn()->query("SELECT * FROM STATUS_VTR");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getStatVtr($cd = null) {
            if ($cd != null) {
                $select = self::conn()->query("SELECT * FROM STATUS_VTR WHERE CD_STATUS NOT IN (SELECT CD_STATUS FROM VIATURAS WHERE CD_VTR=$cd)");

                return $select->fetchAll(PDO::FETCH_OBJ);
            }
        }

    }

// Fim da Classe Viaturas -->

    class Manutencao extends DB {

        public function getManutencaoCd($cd = null) {
            if ($cd != null) {

                $select = self::conn()->prepare("SELECT MANUTENCAO.*, VIATURAS.CD_VTR, VIATURAS.EB, VIATURAS.PLACA, "
                        . "VIATURAS.CD_STATUS, VIATURAS.CD_MOD, MODELO.*, FABRICANTE.*, STATUS_VTR.*, STATUS_MNT.*, "
                        . "SERVICOS.*, TIPO_MNT.*, USERS.CD_USER, USERS.NOME_GUERRA, USERS.CD_PG, USERS.CD_NIVEL, "
                        . "NIVEL_USER.*, POSTO_GRAD.* FROM MANUTENCAO "
                        . "INNER JOIN VIATURAS ON VIATURAS.CD_VTR = MANUTENCAO.CD_VTR "
                        . "INNER JOIN MODELO ON MODELO.CD_MOD = VIATURAS.CD_MOD "
                        . "INNER JOIN FABRICANTE ON FABRICANTE.CD_FAB = MODELO.CD_FAB "
                        . "INNER JOIN STATUS_VTR ON STATUS_VTR.CD_STATUS = VIATURAS.CD_STATUS "
                        . "INNER JOIN STATUS_MNT ON STATUS_MNT.CD_STAT_MNT = MANUTENCAO.CD_STAT_MNT "
                        . "INNER JOIN SERVICOS ON SERVICOS.CD_SV = MANUTENCAO.CD_SV "
                        . "INNER JOIN TIPO_MNT ON TIPO_MNT.CD_TIPO = MANUTENCAO.CD_TIPO "
                        . "INNER JOIN USERS ON USERS.CD_USER = MANUTENCAO.CD_USER_REG "
                        . "INNER JOIN NIVEL_USER ON NIVEL_USER.CD_NIVEL = USERS.CD_NIVEL "
                        . "INNER JOIN POSTO_GRAD ON POSTO_GRAD.CD_PG = USERS.CD_PG WHERE MANUTENCAO.CD_MNT=$cd");

                $select->execute();
                return $select->fetchObject();
            }
        }

        public function getViatura($vtr = null) {
            if ($vtr != null) {
                $select = self::conn()->query("SELECT * FROM VIATURAS WHERE CD_VTR=$vtr");
//            $select = self::conn()->prepare("SELECT MANUTENCAO.CD_MNT, MANUTENCAO.DATA, MANUTENCAO.DESCRICAO, MANUTENCAO.MECANICO, MANUTENCAO.CD_TIPO, MANUTENCAO.CD_SV, MANUTENCAO.CD_STAT_MNT, MANUTENCAO.CD_VTR, MANUTENCAO.CD_USER_REG, VIATURAS.CD_VTR, VIATURAS.EB, VIATURAS.PLACA, VIATURAS.CD_STATUS, VIATURAS.CD_FAB, VIATURAS.CD_MOD, FABRICANTE.CD_FAB, FABRICANTE.FABRICANTE, MODELO.CD_MOD, MODELO.MODELO, STATUS_VTR.CD_STATUS, STATUS_VTR.STATUS, STATUS_MNT.CD_STAT_MNT, STATUS_MNT.STATUS_MNT, SERVICOS.CD_SV, SERVICOS.SERVICO, TIPO_MNT.CD_TIPO, TIPO_MNT.TIPO_MNT, USERS.CD_USER, USERS.NOME_GUERRA, USERS.CD_PG, USERS.CD_NIVEL, NIVEL_USER.CD_NIVEL, NIVEL_USER.NIVEL_USER, POSTO_GRAD.CD_PG, POSTO_GRAD.POSTO_GRAD FROM MANUTENCAO INNER JOIN VIATURAS ON VIATURAS.CD_VTR = MANUTENCAO.CD_VTR INNER JOIN FABRICANTE ON FABRICANTE.CD_FAB = VIATURAS.CD_FAB INNER JOIN MODELO ON MODELO.CD_MOD = VIATURAS.CD_MOD INNER JOIN STATUS_VTR ON STATUS_VTR.CD_STATUS = VIATURAS.CD_STATUS INNER JOIN STATUS_MNT ON STATUS_MNT.CD_STAT_MNT = MANUTENCAO.CD_STAT_MNT INNER JOIN SERVICOS ON SERVICOS.CD_SV = MANUTENCAO.CD_SV INNER JOIN TIPO_MNT ON TIPO_MNT.CD_TIPO = MANUTENCAO.CD_TIPO INNER JOIN USERS ON USERS.CD_USER = MANUTENCAO.CD_USER_REG INNER JOIN NIVEL_USER ON NIVEL_USER.CD_NIVEL = USERS.CD_NIVEL INNER JOIN POSTO_GRAD ON POSTO_GRAD.CD_PG = USERS.CD_PG WHERE MANUTENCAO.CD_VTR=$vtr");

                $select->execute();
                return $select->fetchObject();
            }
        }

        public function cadManutencao($dados = null) {
            if ($dados != null) {
//                $insert = self::conn()->prepare("INSERT INTO MANUTENCAO (DATA, DESCRICAO, MECANICO, OD_MNT, CD_TIPO, CD_SV, CD_STAT_MNT, CD_VTR, CD_USER_REG) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $insert = self::conn()->prepare("INSERT INTO MANUTENCAO "
                        . "(DATA, DESCRICAO, CD_TIPO, CD_SV, CD_STAT_MNT, CD_VTR, "
                        . "CD_USER_REG) VALUES (?, ?, ?, ?, ?, ?, ?)");

                if ($insert->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function editManutencao($dados = null) {
            if ($dados != null) {
                $update = self::conn()->prepare("UPDATE MANUTENCAO SET DATA=?, "
                        . "DESCRICAO=?, MECANICO=?, CD_TIPO=?, CD_SV=?, CD_STAT_MNT=?, "
                        . "CD_VTR=?, CD_USER_REG=? WHERE CD_MNT=?");
                if ($update->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function fimManutencao($dados = null) {
            if ($dados != null) {
                $update = self::conn()->prepare("UPDATE MANUTENCAO SET DT_FIM=?, "
                        . "DESCRICAO=?, MECANICO=?, OD_MNT=?, CD_STAT_MNT=?, "
                        . "CD_USER_FIM=? WHERE CD_MNT=?");
                if ($update->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function delManutencao($cd = null) {
            if ($cd != null) {
                $delete = self::conn()->prepare("DELETE FROM MANUTENCAO WHERE CD_MNT=$cd");

                if ($delete->execute()) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function getManutencao($inicio = null, $maximo = null) {
//        
            $select = self::conn()->query("SELECT MANUTENCAO.*, VIATURAS.CD_VTR, VIATURAS.EB, VIATURAS.PLACA, VIATURAS.CD_STATUS, "
                    . "VIATURAS.CD_MOD, MODELO.*, FABRICANTE.*, STATUS_VTR.*, STATUS_MNT.*, SERVICOS.*, TIPO_MNT.*, "
                    . "USERS.CD_USER, USERS.NOME_GUERRA, USERS.CD_PG, USERS.CD_NIVEL, NIVEL_USER.*, POSTO_GRAD.* FROM MANUTENCAO "
                    . "INNER JOIN VIATURAS ON VIATURAS.CD_VTR = MANUTENCAO.CD_VTR "
                    . "INNER JOIN MODELO ON MODELO.CD_MOD = VIATURAS.CD_MOD "
                    . "INNER JOIN FABRICANTE ON FABRICANTE.CD_FAB = MODELO.CD_FAB "
                    . "INNER JOIN STATUS_VTR ON STATUS_VTR.CD_STATUS = VIATURAS.CD_STATUS "
                    . "INNER JOIN STATUS_MNT ON STATUS_MNT.CD_STAT_MNT = MANUTENCAO.CD_STAT_MNT "
                    . "INNER JOIN SERVICOS ON SERVICOS.CD_SV = MANUTENCAO.CD_SV "
                    . "INNER JOIN TIPO_MNT ON TIPO_MNT.CD_TIPO = MANUTENCAO.CD_TIPO "
                    . "INNER JOIN USERS ON USERS.CD_USER = MANUTENCAO.CD_USER_REG "
                    . "INNER JOIN NIVEL_USER ON NIVEL_USER.CD_NIVEL = USERS.CD_NIVEL "
                    . "INNER JOIN POSTO_GRAD ON POSTO_GRAD.CD_PG = USERS.CD_PG ORDER BY MANUTENCAO.DATA LIMIT $inicio, $maximo");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getManutencaoPend($inicio = null, $maximo = null) {
            $select = self::conn()->query("SELECT MANUTENCAO.*, VIATURAS.CD_VTR, VIATURAS.EB, VIATURAS.PLACA, VIATURAS.CD_STATUS, "
                    . "VIATURAS.CD_MOD, MODELO.*, FABRICANTE.*, STATUS_VTR.*, STATUS_MNT.*, SERVICOS.*, TIPO_MNT.*, "
                    . "USERS.CD_USER, USERS.NOME_GUERRA, USERS.CD_PG, USERS.CD_NIVEL, NIVEL_USER.*, POSTO_GRAD.* FROM MANUTENCAO "
                    . "INNER JOIN VIATURAS ON VIATURAS.CD_VTR = MANUTENCAO.CD_VTR "
                    . "INNER JOIN MODELO ON MODELO.CD_MOD = VIATURAS.CD_MOD "
                    . "INNER JOIN FABRICANTE ON FABRICANTE.CD_FAB = MODELO.CD_FAB "
                    . "INNER JOIN STATUS_VTR ON STATUS_VTR.CD_STATUS = VIATURAS.CD_STATUS "
                    . "INNER JOIN STATUS_MNT ON STATUS_MNT.CD_STAT_MNT = MANUTENCAO.CD_STAT_MNT "
                    . "INNER JOIN SERVICOS ON SERVICOS.CD_SV = MANUTENCAO.CD_SV "
                    . "INNER JOIN TIPO_MNT ON TIPO_MNT.CD_TIPO = MANUTENCAO.CD_TIPO "
                    . "INNER JOIN USERS ON USERS.CD_USER = MANUTENCAO.CD_USER_REG "
                    . "INNER JOIN NIVEL_USER ON NIVEL_USER.CD_NIVEL = USERS.CD_NIVEL "
                    . "INNER JOIN POSTO_GRAD ON POSTO_GRAD.CD_PG = USERS.CD_PG "
                    . "WHERE MANUTENCAO.CD_STAT_MNT <> 1 AND MANUTENCAO.CD_STAT_MNT <> 3 "
                    . "ORDER BY MANUTENCAO.DATA LIMIT $inicio, $maximo");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getTipo() {
            $select = self::conn()->query("SELECT * FROM TIPO_MNT");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getTipoMnt($cd = null) {
            if ($cd != null) {
                $select = self::conn()->query("SELECT * FROM TIPO_MNT WHERE CD_TIPO NOT IN (SELECT CD_TIPO FROM MANUTENCAO WHERE CD_MNT=$cd)");

                return $select->fetchAll(PDO::FETCH_OBJ);
            }
        }

        public function getSv() {
            $select = self::conn()->query("SELECT * FROM SERVICOS");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getSvMnt($cd = null) {
            if ($cd != null) {
                $select = self::conn()->query("SELECT * FROM SERVICOS WHERE CD_SV NOT IN (SELECT CD_SV FROM MANUTENCAO WHERE CD_MNT=$cd)");

                return $select->fetchAll(PDO::FETCH_OBJ);
            }
        }

        public function getStatus() {
            $select = self::conn()->query("SELECT * FROM STATUS_MNT");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getStatusMenos() {
            $select = self::conn()->query("SELECT * FROM STATUS_MNT WHERE STATUS_MNT <> 'REALIZADA'");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getStatMnt($cd = null) {
            if ($cd != null) {
//                $select = self::conn()->query("SELECT * FROM STATUS_MNT WHERE CD_STAT_MNT NOT IN (SELECT CD_STAT_MNT FROM MANUTENCAO WHERE CD_MNT=$cd)");
                $select = self::conn()->query("SELECT * FROM STATUS_MNT WHERE STATUS_MNT <> 'REALIZADA' AND CD_STAT_MNT NOT IN (SELECT CD_STAT_MNT FROM MANUTENCAO WHERE CD_MNT=$cd)");

                return $select->fetchAll(PDO::FETCH_OBJ);
            }
        }

        public function getVtrMnt($cd = null) {
            if ($cd != null) {
                $select = self::conn()->query("SELECT * FROM VIATURAS WHERE CD_VTR NOT IN (SELECT CD_VTR FROM MANUTENCAO WHERE CD_MNT=$cd)");

                return $select->fetchAll(PDO::FETCH_OBJ);
            }
        }

        public function getUser() {
            $select = self::conn()->query("SELECT * FROM USERS");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getUserMnt($cd = null) {
            if ($cd != null) {
                $select = self::conn()->query("SELECT * FROM USERS WHERE CD_USER NOT IN (SELECT CD_USER_REG FROM MANUTENCAO WHERE CD_MNT=$cd)");

                return $select->fetchAll(PDO::FETCH_OBJ);
            }
        }

        public function getMnt2EscFim($inicio = null, $maximo = null) {
            $select = self::conn()->query("SELECT MANUTENCAO.DT_FIM, MANUTENCAO.OD_MNT, MANUTENCAO.CD_STAT_MNT, MANUTENCAO.CD_TIPO, "
                    . "VIATURAS.CD_VTR, VIATURAS.PLACA, VIATURAS.EB, VIATURAS.OD_ATUAL, "
                    . "MODELO.MODELO, FABRICANTE.FABRICANTE "
                    . "FROM MANUTENCAO INNER JOIN VIATURAS ON MANUTENCAO.CD_VTR = VIATURAS.CD_VTR "
                    . "INNER JOIN MODELO ON VIATURAS.CD_MOD = MODELO.CD_MOD "
                    . "INNER JOIN FABRICANTE ON FABRICANTE.CD_FAB = MODELO.CD_FAB "
                    . "WHERE MANUTENCAO.CD_TIPO = 1 AND MANUTENCAO.CD_STAT_MNT = 3 "
                    . "GROUP BY VIATURAS.CD_VTR "
                    . "ORDER BY MANUTENCAO.DT_FIM LIMIT $inicio, $maximo");

//            return $select->execute();
//            return $select->fetchObject();
            return $select->fetchAll(PDO::FETCH_OBJ);
        }

    }

// Fim da Classe Manutencao -->

    class Fabricante extends DB {

        public function getFabricante($inicio = null, $maximo = null) {
            $select = self::conn()->query("SELECT * FROM FABRICANTE ORDER BY FABRICANTE LIMIT $inicio, $maximo");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getFabricanteCd($cd = null) {
            if ($cd != null) {
                $select = self::conn()->prepare("SELECT * FROM FABRICANTE WHERE CD_FAB=$cd");

                $select->execute();
                return $select->fetchObject();
            }
        }

        public function cadFabricante($dados = null) {
            if ($dados != null) {
                $insert = self::conn()->prepare("INSERT INTO FABRICANTE (FABRICANTE) VALUES (?)");

                if ($insert->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function editFabricante($dados = null) {
            if ($dados != null) {
                $update = self::conn()->prepare("UPDATE FABRICANTE SET FABRICANTE=? WHERE CD_FAB=?");
                if ($update->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function delFabricante($cd = null) {
            if ($cd != null) {
                $delete = self::conn()->prepare("DELETE FROM FABRICANTE WHERE CD_FAB=$cd");

                if ($delete->execute()) {
                    return true;
                } else {
                    return false;
                }
            }
        }

    }

// Fim da Classe Fabricante -->

    class Modelo extends DB {

        public function getModelo($inicio = null, $maximo = null) {
            $select = self::conn()->query("SELECT MODELO.*, FABRICANTE.* FROM MODELO "
                    . "INNER JOIN FABRICANTE ON MODELO.CD_FAB = FABRICANTE.CD_FAB "
                    . "ORDER BY FABRICANTE LIMIT $inicio, $maximo");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getModeloCd($cd = null) {
            if ($cd != null) {
                $select = self::conn()->prepare("SELECT MODELO.*, FABRICANTE.* FROM MODELO INNER JOIN FABRICANTE ON MODELO.CD_FAB = FABRICANTE.CD_FAB WHERE MODELO.CD_MOD=$cd");

                $select->execute();
                return $select->fetchObject();
            }
        }

        public function getFabricantes() {
            $select = self::conn()->query("SELECT FABRICANTE.* FROM FABRICANTE ORDER BY FABRICANTE");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getModFab($cd) {
            $select = self::conn()->query("SELECT * FROM FABRICANTE WHERE CD_FAB NOT IN (SELECT CD_FAB FROM MODELO WHERE CD_MOD=$cd)");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function cadModelo($dados = null) {
            if ($dados != null) {
//            $insert = self::conn()->prepare("INSERT INTO MODELO (MODELO) VALUES (?)");
                $insert = self::conn()->prepare("INSERT INTO MODELO (MODELO, CD_FAB) VALUES (?, ?)");

                if ($insert->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function editModelo($dados = null) {
            if ($dados != null) {
                $update = self::conn()->prepare("UPDATE MODELO SET MODELO=?, CD_FAB=? WHERE CD_MOD=?");
                if ($update->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function delModelo($cd = null) {
            if ($cd != null) {
                $delete = self::conn()->prepare("DELETE FROM MODELO WHERE CD_MOD=$cd");

                if ($delete->execute()) {
                    return true;
                } else {
                    return false;
                }
            }
        }

    }

// Fim da Classe Modelo -->

    class Ficha extends DB {

        public function getFichaCd($cd = null) {
            if ($cd != null) {
                $select = self::conn()->prepare("SELECT * FROM FICHA_VTR WHERE CD_FICHA = $cd");

                $select->execute();
                return $select->fetchObject();
            }
        }

//editar
        public function cadFicha($dados = null) {
            if ($dados != null) {
                $insert = self::conn()->prepare("INSERT INTO FICHA_VTR (STAT_FICHA, DT_SAIDA, OD_SAIDA, H_SAIDA, MOTORISTA, DESTINO, SOLICITANTE, MISSAO, CD_VTR, CD_USER_REG) VALUES (?, ?, ?, ?, ?, ?, ?, ? ,? ,?)");

                if ($insert->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

//editar
        public function editFicha($dados = null) {
            if ($dados != null) {
                $update = self::conn()->prepare("UPDATE FICHA_VTR SET STAT_FICHA = ?, H_SAIDA = ?, DT_SAIDA = ?, OD_SAIDA = ?, MOTORISTA = ?, DESTINO = ?, SOLICITANTE = ?, MISSAO = ?, CD_VTR = ?, CD_USER_REG = ? WHERE CD_FICHA = ?");
                if ($update->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function fimFicha($dados = null) {
            if ($dados != null) {
                $update = self::conn()->prepare("UPDATE FICHA_VTR SET STAT_FICHA = ?, DT_RETORNO = ?, OD_ENT = ?, H_ENT = ?, CD_USER_REG = ? WHERE CD_FICHA = ?");
                if ($update->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function delViatura($cd = null) {
            if ($cd != null) {
                $delete = self::conn()->prepare("DELETE FROM VIATURAS WHERE CD_VTR=$cd");

                if ($delete->execute()) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function getFichaPendente($inicio = null, $maximo = null) {
            $sql = "SELECT FV.* , V.OD_ATUAL, M.MODELO, F.FABRICANTE, U.NOME_GUERRA, PG.POSTO_GRAD "
                    . "FROM FICHA_VTR AS FV INNER JOIN VIATURAS AS V ON FV.CD_VTR = V.CD_VTR "
                    . "INNER JOIN MODELO AS M ON V.CD_MOD = M.CD_MOD "
                    . "INNER JOIN FABRICANTE AS F ON F.CD_FAB = M.CD_FAB "
                    . "INNER JOIN USERS AS U ON U.CD_USER = FV.CD_USER_REG "
                    . "INNER JOIN POSTO_GRAD AS PG ON PG.CD_PG = U.CD_PG "
                    . "WHERE FV.STAT_FICHA = 1 "
                    . "ORDER BY DT_SAIDA DESC LIMIT $inicio, $maximo";
            $select = self::conn()->query($sql);
            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getFicha($inicio = null, $maximo = null) {
            $sql = "SELECT FV.* , V.OD_ATUAL, M.MODELO, F.FABRICANTE, U.NOME_GUERRA, PG.POSTO_GRAD "
                    . "FROM FICHA_VTR AS FV INNER JOIN VIATURAS AS V ON FV.CD_VTR = V.CD_VTR "
                    . "INNER JOIN MODELO AS M ON V.CD_MOD = M.CD_MOD "
                    . "INNER JOIN FABRICANTE AS F ON F.CD_FAB = M.CD_FAB "
                    . "INNER JOIN USERS AS U ON U.CD_USER = FV.CD_USER_REG "
                    . "INNER JOIN POSTO_GRAD AS PG ON PG.CD_PG = U.CD_PG "
                    . "ORDER BY DT_SAIDA DESC LIMIT $inicio, $maximo";
            $select = self::conn()->query($sql);
            return $select->fetchAll(PDO::FETCH_OBJ);
        }

    }

//fim da classe ficha

    class Usuario extends DB {

        public function getAllUsuarios() {
//                $select = self::conn()->prepare("SELECT U.*, P.* FROM USERS AS U INNER JOIN POSTO_GRAD AS P ON U.CD_PG = P.CD_PG ORDER BY U.CD_PG");
            $sql = ("SELECT U.*, P.* FROM USERS AS U INNER JOIN POSTO_GRAD AS P ON U.CD_PG = P.CD_PG ORDER BY U.CD_PG");

            $select = self::conn()->query($sql);
            return $select->fetchAll(PDO::FETCH_OBJ);
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
                }  else {
                    return FALSE;
                }
            }
        }

    }

// fim da classe usuario

    class PostoGrad extends DB {

        public function getPostoGrad() {
            $select = self::conn()->query("SELECT * FROM POSTO_GRAD");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getPostoGradDesc() {
            $select = self::conn()->query("SELECT * FROM POSTO_GRAD WHERE CD_PG > 12 ORDER BY CD_PG DESC");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getPostoGradCd($cd = null) {
            if ($cd != null) {
                $select = self::conn()->prepare("SELECT * FROM POSTO_GRAD WHERE CD_PG=$cd");

                $select->execute();
                return $select->fetchObject();
            }
        }

        public function getPostoGradException($cd = null) {
            if ($cd != null) {
                $select = self::conn()->query("SELECT * FROM POSTO_GRAD WHERE CD_PG NOT IN (SELECT CD_PG FROM POSTO_GRAD WHERE CD_PG = $cd)");

                return $select->fetchAll(PDO::FETCH_OBJ);
            }
        }

        public function getPostoGradExcDesc($cd = null) {
            if ($cd != null) {
//                $select = self::conn()->query("SELECT * FROM POSTO_GRAD WHERE CD_PG NOT IN (SELECT CD_PG FROM POSTO_GRAD WHERE CD_PG = $cd)");
                $select = self::conn()->query("SELECT * FROM POSTO_GRAD WHERE CD_PG <> $cd AND CD_PG > 12 ORDER BY CD_PG DESC");

                return $select->fetchAll(PDO::FETCH_OBJ);
            }
        }

    }

// Fim da Classe PostoGrad -->

    class NivelUser extends DB {

        public function getNivelUser() {
            $select = self::conn()->query("SELECT * FROM NIVEL_USER");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getNivelUserMenos() {
            $select = self::conn()->query("SELECT * FROM NIVEL_USER WHERE NIVEL_USER <> 'MOTORISTA'");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getNivelUserCd($cd = null) {
            if ($cd != null) {
                $select = self::conn()->prepare("SELECT * FROM NIVEL_USER WHERE CD_NIVEL = $cd");

                $select->execute();
                return $select->fetchObject();
            }
        }

        public function getNivelUserException($cd = null) {
            if ($cd != null) {
                $select = self::conn()->query("SELECT * FROM NIVEL_USER WHERE CD_NIVEL NOT IN (SELECT CD_NIVEL FROM NIVEL_USER WHERE CD_NIVEL = $cd)");

                return $select->fetchAll(PDO::FETCH_OBJ);
            }
        }

    }

// Fim da Classe NivelUser -->  

    class Servicos extends DB {

        public function getServicos($inicio = null, $maximo = null) {
            $select = self::conn()->query("SELECT * FROM SERVICOS LIMIT $inicio, $maximo");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getServicoCd($cd = null) {
            if ($cd != null) {
                $select = self::conn()->prepare("SELECT * FROM SERVICOS WHERE CD_SV=$cd");

                $select->execute();
                return $select->fetchObject();
            }
        }

        public function cadServicos($dados = null) {
            if ($dados != null) {
                $insert = self::conn()->prepare("INSERT INTO SERVICOS (SERVICO) VALUES (?)");

                if ($insert->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function editServicos($dados = null) {
            if ($dados != null) {
                $update = self::conn()->prepare("UPDATE SERVICOS SET SERVICO=? WHERE CD_SV=?");
                if ($update->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function delServicos($cd = null) {
            if ($cd != null) {
                $delete = self::conn()->prepare("DELETE FROM SERVICOS WHERE CD_SV=$cd");

                if ($delete->execute()) {
                    return true;
                } else {
                    return false;
                }
            }
        }

    }

// Fim da Classe SERVICOS -->

    class ItemMnt extends DB {

        public function getItems() {
//        $select = self::conn()->prepare("SELECT * FROM ITEM_MNT");
            $select = self::conn()->query("SELECT * FROM ITEM_MNT");
//        $select->execute();
//        return $select->fetchObject();
            return $select->fetchAll(PDO::FETCH_OBJ);
        }

    }

    class TipoMnt extends DB {

        public function getTipoMnt($inicio = null, $maximo = null) {
            $select = self::conn()->query("SELECT * FROM TIPO_MNT LIMIT $inicio, $maximo");

            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        public function getTipoMntCd($cd = null) {
            if ($cd != null) {
                $select = self::conn()->prepare("SELECT * FROM TIPO_MNT WHERE CD_TIPO=$cd");

                $select->execute();
                return $select->fetchObject();
            }
        }

        public function cadTipoMnt($dados = null) {
            if ($dados != null) {
                $insert = self::conn()->prepare("INSERT INTO TIPO_MNT (TIPO_MNT) VALUES (?)");

                if ($insert->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function editTipoMnt($dados = null) {
            if ($dados != null) {
                $update = self::conn()->prepare("UPDATE TIPO_MNT SET TIPO_MNT=? WHERE CD_TIPO=?");
                if ($update->execute($dados)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function delTipoMnt($cd = null) {
            if ($cd != null) {
                $delete = self::conn()->prepare("DELETE FROM TIPO_MNT WHERE CD_TIPO=$cd");

                if ($delete->execute()) {
                    return true;
                } else {
                    return false;
                }
            }
        }

    }

// Fim da Classe TIPOMNT -->    
//     class StatusMnt extends DB {
//
//        public function getStatusMnt($inicio = null, $maximo = null) {
//            $select = self::conn()->query("SELECT * FROM STATUS_MNT LIMIT $inicio, $maximo");
//
//            return $select->fetchAll(PDO::FETCH_OBJ);
//        }
//
//        public function getStatusMntCd($cd = null) {
//            if ($cd != null) {
//                $select = self::conn()->prepare("SELECT * FROM STATUS_MNT WHERE CD_STAT_MNT=$cd");
//
//                $select->execute();
//                return $select->fetchObject();
//            }
//        }
//
//        public function cadStatusMnt($dados = null) {
//            if ($dados != null) {
//                $insert = self::conn()->prepare("INSERT INTO STATUS_MNT (STATUS_MNT) VALUES (?)");
//
//                if ($insert->execute($dados)) {
//                    return true;
//                } else {
//                    return false;
//                }
//            }
//        }
//
//        public function editStatusMnt($dados = null) {
//            if ($dados != null) {
//                $update = self::conn()->prepare("UPDATE STATUS_MNT SET STATUS_MNT=? WHERE CD_STAT_MNT=?");
//                if ($update->execute($dados)) {
//                    return true;
//                } else {
//                    return false;
//                }
//            }
//        }
//
//        public function delStatusMnt($cd = null) {
//            if ($cd != null) {
//                $delete = self::conn()->prepare("DELETE FROM STATUS_MNT WHERE CD_STAT_MNT=$cd");
//
//                if ($delete->execute()) {
//                    return true;
//                } else {
//                    return false;
//                }
//            }
//        }
//
//    }
//
//// Fim da Classe Status de Manutenção -->
?>