<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_curso extends CI_Model
{
    public function inserirCurso($descricao, $estatus)
    {
        $sql = "INSERT INTO curso (descricao, estatus) VALUES ('$descricao', '$estatus')";
        $this->db->query($sql);

        if ($this->db->affected_rows() > 0) {
            $dados = array('codigo' => 1, 'msg' => 'Curso cadastrado corretamente');
        } else {
            $dados = array('codigo' => 2, 'msg' => 'Houve algum problema na inserção na tabela curso');
        }

        return $dados;
    }

    public function consultarCurso($idCurso, $descricao, $estatus)
    {
        $sql = "SELECT * FROM curso WHERE estatus = '$estatus'";

        if ($idCurso != "" && $idCurso != 0) {
            $sql .= " AND id_curso = '$idCurso'";
        }

        if (trim($descricao) != '') {
            $sql .= " AND descricao LIKE '%$descricao%'";
        }

        $retorno = $this->db->query($sql);

        if ($estatus == 'D') {
            $dados = array('codigo' => 8, 'msg' => 'Esse curso está desativado.', 'dados' => $retorno->result());
        } elseif ($retorno->num_rows() > 0) {
            $dados = array('codigo' => 1, 'msg' => 'Consulta efetuada com sucesso.', 'dados' => $retorno->result());
        } else {
            $dados = array('codigo' => 2, 'msg' => 'Dados não encontrados');
        }

        return $dados;
    }

    public function consultarSoCurso($idCurso)
    {
        $sql = "SELECT * FROM curso WHERE id_curso = '$idCurso'";
        $retorno = $this->db->query($sql);

        if ($retorno->num_rows() > 0) {
            $dados = array('codigo' => 1, 'msg' => 'Consulta efetuada com sucesso.');
        } else {
            $dados = array('codigo' => 2, 'msg' => 'Dados não encontrados');
        }

        return $dados;
    }

    public function alterarCurso($idCurso, $descricao)

    {
    
        $retornoCurso = $this->consultarSoCurso($idCurso);
    
     
    
        if ($retornoCurso['codigo'] == 1) {
    
            $sql = "update curso set descricao = '$descricao' where id_curso = '$idCurso'" ;
    
           
    
            $this->db->query($sql);
    
     
    
            if ($this->db->affected_rows() > 0) {
    
                $dados = array('codigo' => 1, 'msg' => 'Descrição do curso atualizada com sucesso.');
    
            } else {
    
                $dados = array('codigo' => 2, 'msg' => 'Houve algum problema na atualização da descrição do curso.');
    
            }
    
        } else {
    
            $dados = array('codigo' => 5, 'msg' => 'O ID do curso não está na base de dados.');
    
        }
    
     
    
        return $dados;
    
    }
        

    public function apagarCurso($idCurso)
    {
        $retornoCurso = $this->consultarSoCurso($idCurso);

        if ($retornoCurso['codigo'] == 1) {
            $sql = "SELECT * FROM curso WHERE id_curso = '$idCurso' AND estatus = 'D'";
            $this->db->query($sql);

            if ($this->db->affected_rows() > 0) {
                $dados = array('codigo' => 0, 'msg' => 'Curso já foi apagado');
            } else {
                $sql = "UPDATE curso SET estatus ='D' WHERE id_curso = $idCurso";
                $this->db->query($sql);

                if ($this->db->affected_rows() > 0) {
                    $dados = array('codigo' => 1, 'msg' => 'Curso desativado com sucesso');
                } else {
                    $dados = array('codigo' => 2, 'msg' => 'Houve um problema na desativação do curso');
                }
            }
        } else {
            $dados = array('codigo' => 5, 'msg' => 'O ID do curso passado não está na base de dados');
        }

        return $dados;
    }
}
?>
