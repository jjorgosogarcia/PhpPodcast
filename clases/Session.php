<?php

class Session {

    private static $iniciada = false;
    private $trusted = true;

    function __construct() {
        if (!self::$iniciada) {
            session_start();
            $this->_control();
        }
        self::$iniciada = true;
    }

    private function _control() {
        $ip = $this->get('_ip');
        $cliente = $this->get('_cliente');
        if ($ip == null && $cliente == null) {
            $this->set('_ip', Server::getClientAddress());
            $this->set('_cliente', Server::getUserAgent());
        } else {
            if ($ip !== Server::getClientAddress() || $cliente !== Server::getUserAgent()) {
                $this->destroy();
            }
        }
    }

    function get($nombre) {
        if (isset($_SESSION[$nombre])) {
            return $_SESSION[$nombre];
        }
        return null;
    }

    function set($nombre, $valor) {
        $_SESSION[$nombre] = $valor;
    }

    function delete($nombre) {
        if (isset($_SESSION[$nombre])) {
            unset($_SESSION[$nombre]);
        }
    }

    function destroy() {
        session_destroy();
    }
}
