<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master\src\Exception.php';
require 'PHPMailer-master\src\PHPMailer.php';
require 'PHPMailer-master\src\SMTP.php';

class ModelProfessor{
    public $db = null;
    public $id = 0;
    public $nome = null;
    public $email = null;
    public $senha = null;
    public $statusProfessor = null;
    public $remetente = 'senacprojetosapin@outlook.com';
    public $primeiro_acesso = null;
    public function __construct($conexaoBanco){
        $this->db = $conexaoBanco;
    }


    public function cadastroProfessor(){
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('
            INSERT INTO professor(nome, email, senha)
            VALUES (:nome, :email, :senha);
            ');
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':senha', $this->primeiro_acesso);
            $stmt->execute();


            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.outlook.com';  // Endereço do servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'senacprojetosapin@outlook.com';  // Seu e-mail
            $mail->Password = 'pass@word45';  // Sua senha de e-mail
            $mail->SMTPSecure = 'tls';  // Tipo de criptografia
            $mail->Port = 587;  // Porta do servidor SMTP

            $mail->setFrom($this->remetente);
            $mail->addAddress($this->email);
            $mail->Subject = 'Primeiro Acesso - SENAC';
            $mail->Body = "Olá,".$this->nome."\r\nUse essa senha para o seu primeiro acesso: ".$this->primeiro_acesso;

            $mail->send();

            $retorno['status'] = 1;
        } catch (PDOException $ex) {
            echo 'Erro ao cadastrar o Coordenador' . $ex->getMessage();
        }
        return $retorno;
    }


    public function listarProfessor() {
        $retorno = ['status' => 0, 'dados' => null];
        try{
            $query = $this->db->query('SELECT * FROM professor;');
            $dados = $query->fetchALL();
            $retorno['status'] = 1;
            $retorno['dados'] = $dados;
    }
    catch (PDOException $ex) {
        echo 'Erro ao listar todos os usuarios' .$ex->getMessage();
    }
    return $retorno;
    }



    public function editarProfessor(){
        $retorno = ['status' => 0, 'dados' => null];
        try{
            $stmt = $this->db->prepare('
            UPDATE professor
            SET nome = :nome, email = :email, senha = :senha
            WHERE id = :id;
            ');
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();
            $retorno['status'] = 1;
            $retorno['dados'] = 'User updated successfully';
        } catch (PDOException $ex) {
            $retorno['status'] = 0;
            $retorno['dados'] = 'Erro ao atualizar usuário: ' . $ex->getMessage();
        }
        return $retorno;
    }



        public function listarIdProfessor(){
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('SELECT * FROM professor WHERE id = :id;');
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();
            $dados = $stmt->fetchAll();
            if ($dados) {
                $retorno['status'] = 1;
                $retorno['dados'] = $dados;
            } else {
                $retorno['status'] = 0;
                $retorno['dados'] = 'No data found';
            }
        } catch (PDOException $ex) {
            $retorno['status'] = 0;
            $retorno['dados'] = 'Erro ao buscar os dados deste usuário: ' . $ex->getMessage();
        }
        return $retorno;
    }


    public function statusProfessor(){
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('UPDATE professor
            SET status_professor = :statusProfessor
            WHERE id = :id;');

            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':statusProfessor', $this->statusProfessor, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt-> rowCount() > 0){
                $retorno['status'] = 1;
                $retorno['dados'] = 'Status Atualizado';
            } else{
                $retorno['dados'] = 'Erro de atualização';
            }
    } catch (PDOException $ex){
        $retorno['dados'] = 'Erro ao atualizar os dados deste usuário: ' . $ex->getMessage();
    }
    return $retorno;
    }


    public function logar() {
    $retorno = ['status' => 0, 'dados' => null];
    try {
 
        $stmt = $this->db->prepare('
       select id, email, senha FROM professor WHERE email = :email and senha = :senha and status_professor = 1;
        ');
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this->senha); 
        $stmt->execute();
        $dado = $stmt->fetch();
        
        if ($dado && $dado['id'] && $dado['id'] > 0) {
            $retorno['status'] = 1;
            $retorno['dados'] = $dado;
        } else {
            $retorno['status'] = 0;
            $retorno['dados'] = '';
            //echo 'Login ou senha incorretos.';
        }
    } catch (PDOException $ex) {
        echo 'Erro ao logar: ' . $ex->getMessage();
    }
    return $retorno;
}


public function SenhaEsquecidaProfessor()
{
    $retorno = ['status' => 0,  'dados' => null];

    try {
        $stmt = $this->db->prepare('
        SELECT email FROM professor
        WHERE email = :email and status_professor = 1;
        ');
        $stmt->bindValue(':email', $this->email);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            $stmt = $this->db->prepare('
                UPDATE professor
                SET senha = :senha
                WHERE email = :email;
            ');

            $stmt->bindValue(':senha', $this->primeiro_acesso);
            $stmt->bindValue(':email', $this->email);
            $stmt->execute();

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.outlook.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'senacprojetosapin@outlook.com';
            $mail->Password = 'pass@word45';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($this->remetente);
            $mail->addAddress($this->email);
            $mail->Subject = 'Redefinir Senha - SENAC';
            $mail->Body = "Use essa senha para conseguir acessar a plataforma: " . $this->primeiro_acesso;

            $mail->send();

            $retorno['status'] = 1;
            $retorno['dados'] = 'Sua senha foi atualizada';
        }
    } catch (PDOException $ex) {
        $retorno['status'] = 0;
        $retorno['dados'] = 'Erro ao atualizar sua senha ' . $ex->getMessage();
    }
    return $retorno;
}

}
