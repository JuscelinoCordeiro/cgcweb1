<?php

    /**
     * Classe para controle de acesso
     *
     * @author juscelino
     */
    class Login extends DB {

        private $tabela;
        private $prefixo;

//==============================================================================    
//      funcao de construcao
//==============================================================================    
        public function __construct($tab = 'USERS', $pref = 'mil_') {
            $this->tabela = $tab;
            $this->prefixo = $pref;
        }

//==============================================================================    
//      funcao de encriptacao de senha
//==============================================================================    
        private function criptar($senha) {
            return md5($senha);
//        return $senha;
        }

//==============================================================================    
        //funcao de validacao de informacoes
//==============================================================================    
        private function validar($idt, $senha) {
            $senha = $this->criptar($senha);
//        $verificar = self::conn()->prepare("SELECT * FROM ".$this->tabela." WHERE USUARIO = '$idt' AND SENHA = '$senha'");
            $verificar = self::conn()->prepare("SELECT * FROM " . $this->tabela . " WHERE IDT = ? AND SENHA = ?");

            $dados = array($idt, $senha);
            $verificar->execute($dados);
            return (($verificar->rowCount() > 0) ? true : false);
        }

//==============================================================================    
        //funcao de contagem de acessos ao sistema
//==============================================================================    
        private function incAccess() {
            $select = self::conn()->prepare("SELECT COUNT_ACCESS AS QTDE FROM CONTROL_ACCESS");
            $select->execute();
            $count = (int) $select->fetchObject()->QTDE;
//            $inc = $count->QTDE;
            $count++;
            $acesso = self::conn()->prepare("UPDATE CONTROL_ACCESS SET COUNT_ACCESS = " . $count);
            $acesso->execute();
        }

//==============================================================================    
//          funcao de logar
//==============================================================================     
        public function logar($idt, $senha) {
            //chamar metodo de validacao
            if ($this->validar($idt, $senha)) {
                $_SESSION[$this->prefixo . 'idt'] = $idt;
                $_SESSION[$this->prefixo . 'senha'] = $senha;

                $dados = array($idt, $this->criptar($senha));
                $exec = self::conn()->prepare("SELECT U.*, P.*, N.* FROM " . $this->tabela . " AS U "
                        . "INNER JOIN POSTO_GRAD AS P ON P.CD_PG = U.CD_PG "
                        . "INNER JOIN NIVEL_USER AS N ON N.CD_NIVEL = U.CD_NIVEL "
                        . "WHERE IDT = ? AND SENHA = ?");
                $exec->execute($dados);

                $User = $exec->fetchObject();

                //scd = security cod - so pra diferenciar
                $_SESSION['scd_user'] = $User->CD_USER;
                $_SESSION['snome_guerra'] = $User->NOME_GUERRA;
                $_SESSION['spg'] = $User->POSTO_GRAD;
                $_SESSION['snivel'] = $User->CD_NIVEL;
                $_SESSION['slastlog'] = $User->LASTLOG;

                $dt_log = date('Y/m/d H:i:s', time());

                //regitrar o acesso do usuario
                $Rlog = self::conn()->prepare("UPDATE " . $this->tabela . " SET LASTLOG = '$dt_log' WHERE IDT = ? AND SENHA = ?");
                $Rlog->execute($dados);

                //incrementa o total de usuarios logados
                $logado = self::conn()->prepare("UPDATE " . $this->tabela . " SET ISLOGADO = 1 WHERE IDT = ? AND SENHA = ?");
                $logado->execute($dados);

                //incrementa acessos ao sistema
                $this->incAccess();

                return true;
            } else {
                return false;
            }
        }

//==============================================================================    
//          funcao para verificar se o usuario esta logado
//==============================================================================    
        public function isLogado() {
            if (isset($_SESSION[$this->prefixo . 'idt']) && ($_SESSION[$this->prefixo . 'idt']) != '') {
                return TRUE;
            } else {
                return FALSE;
            }
        }

//==============================================================================    
//   funcao para decrementar a quantidade de usuarios on quando fizer logout
//==============================================================================     
        private function decUserOn() {
            $logado = self::conn()->prepare("UPDATE " . $this->tabela . " SET ISLOGADO = 0 WHERE CD_USER = " . $_SESSION['scd_user']);
            $logado->execute();
        }

//==============================================================================    
//          funcao para logout
//==============================================================================    
        public function Sair() {
            if ($this->isLogado()) {
                $this->decUserOn();
                //eliminação manual da session pra garantir
                unset($_SESSION[$this->prefixo . 'idt']);
                unset($_SESSION[$this->prefixo . 'senha']);

                //destuição automatica de todas as sessions
                session_destroy();
                return TRUE;
            } else {
                return FALSE;
            }
        }

    }
?>

