<?php

class Session {

    private $logged_in;
    public $user_id;
    public $message;
    public $cusid;
    private $cu_logged_in;
    public $cart;
    public $wishlist;

    function __construct() {
        session_start();
        //$this->cart = $_SESSION['cart'] = array();
        $this->check_message();
        $this->check_login();
        $this->cu_check_login();
        //$this->get_wishlist();
        if ($this->logged_in) {
            
        } else {
            
        }
    }

    public function is_logged_in() {
        return $this->logged_in;
    }

    public function cu_is_logged_in() {
        return $this->cu_logged_in;
    }

    public function login($user) {
        if ($user) {

            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->logged_in = true;
        }
        //var_dump($_SESSION);
    }

    public function cu_login($user) {
        if ($user) {

            $this->cusid = $_SESSION['cusid'] = $user->cusid;
            //$this->cart = $_SESSION['cart'] = array();
            $this->cu_logged_in = true;
        }
        //var_dump($_SESSION);
    }

    public function cu_logout() {
        unset($_SESSION['cusid']);
        unset($_SESSION['cart']);
        unset($this->cusid);
        unset($this->cart);
        $this->cu_logged_in = false;
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->logged_in = false;
    }

    public function message($msg = "") {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    private function cu_check_login() {
        if (isset($_SESSION['cart']))
            $this->cart = $_SESSION['cart'];
        if (isset($_SESSION['cusid'])) {
            $this->cusid = $_SESSION['cusid'];
//            if(isset($_SESSION['cart']))
//                $this->cart = $_SESSION['cart'];
            $this->cu_logged_in = true;
        } else {
            unset($this->cusid);
            $this->cu_logged_in = false;
        }
    }

    private function check_login() {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->logged_in = true;
        } else {
            unset($this->user_id);
            $this->logged_in = false;
        }
    }

    private function check_message() {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }

    public function add_to_cart($itemId, $quantity) {
        if (empty($_SESSION['cart']))
            $_SESSION['cart'] = array();

        $_SESSION['cart'][$itemId] = $quantity;
        $this->cart = $_SESSION['cart'];
    }

    public function remove_from_cart($itemId) {
        if (empty($_SESSION['cart']))
            $_SESSION['cart'] = array();

        unset($_SESSION['cart'][$itemId]);
        $this->cart = $_SESSION['cart'];
    }

    public function clear_cart() {
        $_SESSION['cart'] = array();
        $this->cart = $_SESSION['cart'];
    }
    
}

$session = new Session();
$message = $session->message();
?>