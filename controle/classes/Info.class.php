<?php
    /**
     * Description of Info
     *
     * @author juscelino
     */
    class Info {

        private $msg;

        public function infoStatus($status, $info) {
            $classe = ($status == 1) ? 'alert-info' : 'alert-danger';
            return '<div class="alert ' . $classe . '">
                <button type="button" class="close" data-dismiss="alert">×</button>
                ' . $info . '
                <br>
                <br>
                <span>Redirecionando em 3....2....1...</span>
                </div>';
        }

    }
    