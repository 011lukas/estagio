<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Curso extends CI_Controller

{



    private $json;

    private $resultado;



    private $idcurso;

    private $descricao;

    private $estatus;



    public function getIdCurso()

    {

        return $this->idcurso;
    }



    public function getDescricao()

    {

        return $this->descricao;
    }



    public function getEstatus()

    {

        return $this->estatus;
    }



    public function setIdCurso($idcursoFront)

    {

        $this->idcurso = $idcursoFront;
    }



    public function setDescricao($descricaoFront)

    {

        $this->descricao = $descricaoFront;
    }



    public function setEstatus($estatusFront)

    {

        $this->estatus = $estatusFront;
    }



    public function inserirCurso()

    {

        $json = file_get_contents('php://input');

        $resultado = json_decode($json);



        $lista = array(

            "descricao" => '0',

            "estatus" => '0'

        );



        if (verificarParam($resultado, $lista) == 1) {

            $this->setDescricao($resultado->descricao);

            $this->setEstatus($resultado->estatus);



            if (trim($this->getDescricao()) == "") {
            } elseif ($this->getEstatus() != "D" && $this->getEstatus() != "") {

                $retorno = array('codigo' => 4, 'msg' => 'status nao condiz com o permitido');
            } else {

                $this->load->model('M_curso');



                $retorno = $this->M_curso->inserirCurso($this->getDescricao(), $this->getEstatus());
            }
        } else {

            $retorno = array('codigo' => 99, 'msg' => 'os campos vindos do frontEnd nao representam o metodo de inserçao verifique');
        }



        echo json_encode($retorno);
    }

    public function consultarCurso()

    {

        $json = file_get_contents('php://input');

        $resultado = json_decode($json);



        $lista = array(

            "idcurso" => '0',

            "descricao" => '0',

            "estatus" => '0'

        );



        if (verificarParam($resultado, $lista) == 1) {



            $this->setIdCurso($resultado->idcurso);

            $this->setDescricao($resultado->descricao);

            $this->setEstatus($resultado->estatus);



            if ($this->getEstatus() != "D" && $this->getEstatus() != "") {

                $retorno = array('codigo' => 4, 'msg' => 'status nao condiz com o permitido.');
            } else {

                $this->load->model('M_curso');



                $retorno = $this->M_curso->consultarCurso($this->getIdCurso(), $this->getDescricao(), $this->getEstatus());
            }
        } else {

            $retorno = array('codigo' => 99, 'msg' => 'os campos vindos do frontEnd nao representam o metodo de consulta verifique');
        }

        echo json_encode($retorno);
    }



    public function alterarCurso()

 

    {

 

        $json = file_get_contents('php://input');

 

        $resultado = json_decode($json);

       

 

        $lista = array("idCurso" =>   '0',

                       "descricao" => '0'

                        );

 

 

 

        if (verificarParam($resultado, $lista) == 1) {

 

            $this->setIdCurso($resultado->idCurso);

 

            $this->setDescricao($resultado->descricao);

 

 

 

 

            if ($this->getIdCurso() == "" || $this->getIdCurso() == 0) {

 

                $retorno = array('codigo' => 3, 'msg' => 'ID do curso nao informado ou zerado');

            } elseif (strlen($this->getDescricao()) == 0) {

 

                $retorno = array('codigo' => 4, 'msg' => 'descricao do curso nao informada');

            } else {

 

                $this->load->model('M_curso');

 

 

 

                $retorno = $this->M_curso->alterarCurso($this->getIdCurso(), $this->getDescricao());

            }

        } else {

 

            $retorno = array('codigo' => 99, 'msg' => 'os campos vindos do frontEnd nao representam o metodo de consulta verifique');

        }

 

        echo json_encode($retorno);

    }

    public function apagarCurso()

    {

        $json = file_get_contents('php://input');

        $resultado = json_decode($json);



        $lista = array("idcurso" => '0');



        if (verificarParam($resultado, $lista) == 1) {



            $this->setIdCurso($resultado->idcurso);



            if ($this->getIdCurso() == "" || $this->getIdCurso() == 0) {

                $retorno = array('codigo' => 3, 'msg' =>  'id do curso nao informado ou zerado');
            } else {

                $this->load->model('M_curso');



                $retorno = $this->M_curso->apagarCurso($this->getIdCurso());
            }
        } else {

            $retorno = array('codigo' => 99, 'msg' => 'os campos vindo do frontEnd nao represntam o metodo de consulta, verifique');
        }

        echo json_encode($retorno);
    }
}
?>