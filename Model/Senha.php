<?php

class Senha {
    private $big = "ABCDEFGHIJKLMNOPQRSTUVYXWZ";
    private $small = "abcdefghijklmnopqrstuvyxwz"; 
    private $number = "0123456789"; 
    private $simbols = "!@#$%&*_+="; 
    private $tamanho = 8;
    private $caracteres = "";
    public $password;

    public function fazSenha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos) {
        $this->caracteres = "";

        if ($maiusculas) {
            $this->caracteres .= str_shuffle($this->big);
        }
        if ($minusculas) {
            $this->caracteres .= str_shuffle($this->small);
        }
        if ($numeros) {
            $this->caracteres .= str_shuffle($this->number);
        }
        if ($simbolos) {
            $this->caracteres .= str_shuffle($this->simbols);
        }

        return substr(str_shuffle($this->caracteres), 0, $this->tamanho);
    }

    public function __construct() {
        $this->password = $this->fazSenha($this->tamanho, true, true, true, true);
    }
}


?>

