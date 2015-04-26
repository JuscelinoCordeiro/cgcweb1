<?php

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    /**
     * Description of militar
     *
     * @author apolo
     */
    class militar {

        private $nome;
        private $postoGrad;
        private $secao;
        
        public function __construct($nome, $postoGrad, $secao) {
            $this->nome = $nome;
            $this->postoGrad = $postoGrad;
            $this->secao = $secao;
        }

                public function getNome() {
            return $this->nome;
        }

        public function getPostoGrad() {
            return $this->postoGrad;
        }

        public function getSecao() {
            return $this->secao;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setPostoGrad($postoGrad) {
            $this->postoGrad = $postoGrad;
        }

        public function setSecao($secao) {
            $this->secao = $secao;
        }

    }
    