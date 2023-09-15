
<?php

 



 

defined('BASEPATH') or exit('No direct script access allowed');

include_once("M_curso.php");

 

 

class M_aluno extends CI_Model

{

 

 

 

 

 

     

        public function inserirAluno($ra, $idCurso, $nome, $estatus)

        {

            $curso = new M_Curso();

            $retornoCurso = $curso->consultarSoCurso($idCurso);

            if ($retornoCurso['codigo'] == 1) {

                $retornoAluno = $this->consultarSoAluno($ra);

                if ($retornoAluno['codigo'] == 2) {

                    $sql = "insert into aluno(ra,id_curso,nome,estatus) values('$ra',$idCurso, '$nome','$estatus')";

                    $this->db->query($sql);

                    if ($this->db->affected_rows() > 0) {

                        $dados = array(

                            'codigo' => 1,

                            'msg'    => 'Aluno cadastrado corretamente.'

                        );

                    } else {

                        $dados = array(

                            'codigo' => 2,

                            'msg'    => 'Houve algum problema na inserção na tabela de aluno.'

                        );

                    }

                } else {

                    $dados = array(

                        'codigo' => 8,

                        'msg'    => 'Aluno se encontra desativado, ative-o.'

                    );

                }

            } else {

                $dados = array(

                    'codigo' => 7,

                    'msg'    => 'Curso informado não cadastrado na base de dados.'

                );

            }

            return $dados;

        }

    public function consultarAluno($ra, $idCurso, $nome, $estatus)

    {

        $sql = "select * from aluno

        where estatus = '$estatus'";

        if (($ra) != '') {

            $sql = $sql . "and ra = '$ra'";

        }

        if (trim($idCurso) != '' && trim($idCurso) != '0') {

            $sql = $sql . "and id_curso = '$idCurso'";

        }

        if (trim($nome) != '') {

            $sql = $sql . "and nome like '%$nome%' ";

        }

        $retorno = $this->db->query($sql);

        if ($retorno->num_rows() > 0) {

            $dados = array(

                'codigo' => 1,

                'msg'    => 'Consulta efetuada com sucesso.',

                'dados'  => $retorno->result()

            );

        } else {

            $dados = array(

                'codigo' => 2,

                'msg' => 'Dados não encontrados.'

            );

        }

        return $dados;

    }

 
    public function consultarSoAlunoo($ra)

 
    {
        $sql = "select * from aluno

        where ra = '$ra' and estatus = 'D' ";

        $retorno = $this->db->query($sql);

        if ($retorno->num_rows() > 0) {

            $dados = array(

                'codigo' => 1,

                'msg'    => 'Consulta efetuada com sucesso'

            );

        } else {

            $dados = array(

                'codigo' => 2,

                'msg'    => 'Dados não encontrados.'

            );

        }

        return $dados;

    }

 
    public function consultarSoAluno($ra)


    {

        $sql = "select * from aluno

        where ra = '$ra'

        and estatus = ''";

        $retorno = $this->db->query($sql);

        if ($retorno->num_rows() > 0) {

            $dados = array(

                'codigo' => 1,

                'msg'    => 'Consulta efetuada com sucesso'

            );

        } else {

            $dados = array(

                'codigo' => 2,

                'msg'    => 'Dados não encontrados.'

            );

        }

        return $dados;

    }


    public function consultarSoAlunoDesativado($ra)

    {

        $sql = "select * from aluno

        where ra = '$ra'

        and estatus = 'D'";

        $retorno = $this->db->query($sql);

        if ($retorno->num_rows() > 0) {

            $dados = array(

                'codigo' => 1,

                'msg'    => 'Consulta efetuada com sucesso'

            );

        } else {

            $dados = array(

                'codigo' => 2,

                'msg'    => 'Dados não encontrados.'

            );

        }

        return $dados;

    }

    public function alterarAluno($ra,$idCurso,$nome){

 


        $curso = new M_curso();

 

        if ($nome == ''){

            $retornoCurso = $curso->consultarSoCurso($idCurso);  

 

            if($retornoCurso['codigo'] == 1){

      

                $retornoAluno = $this->consultarSoAluno($ra);

            
                if($retornoAluno['codigo']== 1);

   
                $sql = "update aluno set id_curso = $idCurso where ra = $ra";

   

               

                $this->db->query($sql);     

   

                if($this->db->affected_rows()>0){

   

                    $dados = array('codigo' => 1, 'msg' => 'dados do aluno atualizados corrertamente');


                }else{

                    $dados = array('codigo' => 2, 'msg' => 'houve um problema na atualizacao do aluno');   

                }

   

            }else{

   

                $dados = array ('codigo' => 5, 'msg' => 'id do curso nao esta na base de dados');


            }

   
            return $dados;
        

        }

    
        if ($idCurso == ''){

 

                $retornoAluno = $this->consultarSoAluno($ra);

                  

                if($retornoAluno['codigo']== 1);

   

                $sql = "update aluno set nome = '$nome' where ra = $ra";


   

                $this->db->query($sql);

           

                if($this->db->affected_rows()>0){

   

                    $dados = array('codigo' => 1, 'msg' => 'dados do aluno atualizados corrertamente');

                   

                }else{

   

                    $dados = array('codigo' => 2, 'msg' => 'houve um problema na atualizacao do aluno');

 

                }

   
  

            return $dados;

 

        }


 

        $retornoCurso = $curso->consultarSoCurso($idCurso);  

 

        if($retornoCurso['codigo'] == 1){

 


            $retornoAluno = $this->consultarSoAluno($ra);


            if($retornoAluno['codigo']== 1);


            $sql = "update aluno set nome = '$nome', id_curso = $idCurso where ra = $ra";

 



            $this->db->query($sql);



            if($this->db->affected_rows()>0){

                $dados = array('codigo' => 1, 'msg' => 'dados do aluno atualizados corrertamente');

 

            }else{

 

                $dados = array('codigo' => 2, 'msg' => 'houve um problema na atualizacao do aluno');

 

            }

 

        }else{

 

            $dados = array ('codigo' => 5, 'msg' => 'id do curso nao esta na base de dados');

 

        }

 

 

 

        return $dados;

 

    }

 

 

    public function apagarAluno($ra)

    {

        $retornoAluno = $this->consultarSoAluno($ra);

        if ($retornoAluno['codigo'] == 1) {

            $sql = "update aluno set estatus = 'D'

            where ra = $ra";

            $this->db->query($sql);

 

            if ($this->db->affected_rows() > 0) {

                $dados = array(

                    'codigo' => 1,

                    'msg'    => 'Aluno desativado corretamente.'

                );

            } else {

                $dados = array(

                    'codigo' => 2,

                    'Houve algum problema na desativação do aluno.'

                );

            }

        } else {

            $dados = array(

                'codigo' => 4,

                'msg'    => ' O RA não está cadastradado na base de dados.'

            );

        }

        return $dados;

    }

 

 

    public function ativaAluno($ra)

    {

        $retornoAluno = $this->consultarSoAlunoDesativado($ra);

        if ($retornoAluno['codigo'] == 1) {

            $sql = "update aluno set estatus = ''

            where ra = $ra";

            $this->db->query($sql);

            if ($this->db->affected_rows() > 0) {

                $dados = array(

                    'codigo' => 1,

                    'msg'    => 'Aluno ativado corretamente.'

                );

            } else {

                $dados = array(

                    'codigo' => 2,

 

 

 

                    'Houve algum problema na ativação do aluno.'

                );

            }

        } else {

            $dados = array(

                'codigo' => 4,

 

 

 

                'msg'    => ' O RA não está desativado.'

            );

        }

 


        return $dados;

    }

}

 