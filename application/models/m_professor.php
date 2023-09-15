<?php

 

defined('BASEPATH') or exit('No direct script access allowed');

 

 

 

class M_Professor extends CI_Model

 

{

 

    public function inserirProfessor($id, $nome, $estatus)

 

    {

 

        $sql = "insert into professor (id_professor,nome,estatus) values ( '$id','$nome','$estatus')";

 

 

 

        $this->db->query($sql);

 

 

 

        if ($this->db->affected_rows() > 0) {

 

            $dados = array('codigo' => 1, 'msg' => 'professor cadastrado corretamente');

        } else {

 

            $dados = array('codigo' => 2, 'msg' => ' houve algum problema na inserçao na tabela professor');

        }

 

 

 

        return $dados;

    }

 

 

 

    public function consultarProfessor($id, $nome, $estatus)

 

    {

 

        $sql = "select * from professor where estatus = '$estatus' ";

 

 

 

        if ($id != "" && $id != 0) {

 

            $sql = $sql . "and id_professor = '$id' ";

        }

 

 

 

        if (trim($nome) != '') {

 

            $sql = $sql . " and nome like '%$nome%'";

        }

 

     

 

 

 

        $retorno = $this->db->query($sql);

 

        if ($estatus = 'D'){

            $dados = array('codigo' => 8, 'msg' => 'Esse Professor está desativado.', 'dados' => $retorno->result());

        };

 

        if ($retorno->num_rows() > 0) {

 

            $dados = array('codigo' => 1, 'msg' => 'consulta efetuada com sucesso.', 'dados' => $retorno->result());

        } else {

 

            $dados =  array('codigo' => 2, 'msg' => 'dados nao encontrados');

        }

 

       

 

   

 

        return $dados;

    }

 

 

    public function consultarSoProfessor($id)

 

    {

 

 

 

        $sql = "select * from professor where id_professor = '$id' ";

 

 

 

        $retorno = $this->db->query($sql);

 

 

 

        if ($retorno->num_rows() > 0) {

 

            $dados = array('codigo' => 1, 'msg' => 'consulta efetuada com sucesso.');

        } else {

 

            $dados = array('codigo' => 2, 'msg' => 'dados nao encontrados');

        }

 

 

 

        return $dados;

    }

 

 

 

    public function alterarProfessor($id, $nome,  $estatus)

 

    {

 

 

 

        $retornoCurso = $this->consultarSoProfessor($id);

 

 

 

        if ($retornoCurso['codigo'] == 1) {

 

 

 

            $sql = "update professor set nome = '$nome' where id_professor = $id" and "select*from professor where estatus = '$estatus'";

 

 

 

            $this->db->query($sql);

 

 

 

            if ($this->db->affected_rows() > 0) {

 

                $dados = array('codigo' => 1, 'msg' => 'nome do professor atualizado com sucesso.');

            } else {

 

                $dados = array('codigo' => 2, 'msg' => 'houve algum problema no nome do professor.');

            }

        } else {

 

            $dados = array('codigo' => 5, 'msg' => ' o id do professor nao esta na base de dados');

        }

 

 

 

        return $dados;

    }

 

 

 

    public function apagarCurso($id)

 

    {

 

        $retornoCurso = $this-> consultarSoProfessor($id);

 

        if ($retornoCurso['codigo'] == 1) {

 

            $sql = "select* from curso where id_professor = '$id' and estatus = 'D'  ";

            $this->db->query($sql);

 

            if($this->db->affected_rows()>0){

                $dados = array('codigo' => 0, 'msg' => 'professor já foi apagado');

 

            } else{

 

            $sql = "update professor set estatus ='D' where id_professor = $id";

            $this->db->query($sql);

 

 

 

            if ($this->db->affected_rows() > 0) {

 

 

                $dados = array('codigo' => 1, 'msg' => 'professor desativado com sucesso');

            } else {

 

                $dados = array('codigo' => 2, 'msg' => 'houve um problema na desativacao do professor');

            }

        }

        } else {

 

            $dados = array('codigo' => 5, 'msg' => 'o id do professor passado nao esta na base de dados');

       

 

    }

 

        return $dados;

    }

}

 