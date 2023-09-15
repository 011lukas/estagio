<?php

 

 

 

defined('BASEPATH') or exit('No direct script access allowed');

 

 

 

 

 

 

 

class Professor extends CI_Controller

{

 

 

 

    private $json;

 

 

 

    private $resultado;

 

 

 

    private $id;

 

 

 

    private $nome;

 

 

 

    private $estatus;

 

 

 

 

 

 

 

    public function getID()

    {

 

 

 

        return $this->id;

    }

 

 

 

 

 

 

    public function getNome()

    {

 

 

 

        return $this->nome;

    }

 

 

 

 

 

 

    public function getEstatus()

    {

 

 

 

        return $this->estatus;

    }

 

 

 

 

 

 

 

    public function setID($idFront)

    {

 

 

 

        $this->id = $idFront;

    }

 

 

 

 

 

 

    public function setNome($nomeFront)

    {

 

 

 

        $this->nome = $nomeFront;

    }

 

 

 

 

 

 

 

    public function setEstatus($estatusFront)

    {

 

 

 

        $this->estatus = $estatusFront;

    }

 

 

 

 

 

 

 

    public function inserirProfessor()

    {

 

 

 

        $json = file_get_contents('php://input');

 

 

 

        $resultado = json_decode($json);

 

 

 

 

 

 

 

        $lista = array(

            "id"      => '0',

 

 

 

            "nome"    => '0',

 

 

 

            "estatus" => '0'

        );

 

 

 

 

 

 

 

        if (verificarParam($resultado, $lista) == 1) {

 

 

 

 

 

 

 

            $this->setID($resultado->id);

 

 

 

            $this->setNome($resultado->nome);

 

 

 

            $this->setEstatus($resultado->estatus);

        }

 

 

 

 

 

 

 

 

 

 

 

        if (trim($this->getID()) == "" || $this->getID() == 0) {

 

 

 

            $retorno = array(

                'codigo' => 3,

 

 

 

                'msg'   => 'RA do Professor não informado ou zerado'

            );

        }  elseif ($this->getEstatus() != "D" && $this->getEstatus() != "") {

 

 

 

            $retorno = array(

                'codigo' => 4,

 

 

 

                'msg'    => 'Status não condiz com o permitido.'

            );

        } elseif (strlen($this->getNome()) == 0) {

 

 

 

            $retorno = array(

                'codigo' => 5,

 

 

 

                'msg'   => 'Nome do aluno não informado.'

            );

        } else {

 

 

 

            $this->load->model('M_Professor');

 

 

 

            $retorno = $this->M_Professor->inserirProfessor($this->getID(),  $this->getNome(), $this->getEstatus());

        }

 

 

 

        echo json_encode($retorno);

    }

 

 

 

 

 

 

 

 

 

 

 

    public function consultarProfessor()

    {

 

 

 

        $json = file_get_contents('php://input');

 

 

 

        $resultado = json_decode($json);

 

 

 

        $lista = array(

            "id"      => '0',

 

 

            "nome"    => '0',

 

 

 

            "estatus" => '0'

        );

 

 

 

 

 

 

 

        if (verificarParam($resultado, $lista) == 1) {

 

 

 

            $this->setID($resultado->id);

 

 

 

 

 

 

            $this->setNome($resultado->nome);

 

 

 

            $this->setEstatus($resultado->estatus);

 

 

 

 

 

 

 

 

 

 

 

            if ($this->getEstatus() != "D" && $this->getEstatus() != "") {

 

 

 

                $retorno = array(

                    'codigo' => 4,

 

 

 

                    'msg'    => 'Status não condiz com o permitido.'

                );

            } else {

 

 

 

                $this->load->model('M_Professor');

 

 

 

                $retorno = $this->M_Professor->consultarProfessor($this->getID(), $this->getNome(), $this->getEstatus());

            }

        } else {

 

 

 

            $retorno = array(

                'codigo' => 99,

 

 

 

                'msg'    => 'Os Campos vindos do FrontEnd não representam o método de consulta, verifique.'

            );

        }

 

 

 

        echo json_encode($retorno);

    }

 

 

 

 

 

 

 

    public function alterarProfessor()

    {

 

 

 

        $json = file_get_contents('php://input');

 

 

 

        $resultado = json_decode($json);

 

 

 

        $lista = array(

            "id"      => '0',

 

 

 

 

 

 

 

            "nome"    => '0'

        );

 

 

 

 

 

 

 

        if (verificarParam($resultado, $lista) == 1) {

 

 

 

            $this->setID($resultado->id);

 

 

 

 

 

 

 

            $this->setNome($resultado->nome);

 

 

 

 

 

 

 

 

 

 

 

           

 

 

 

                $this->load->model('M_Professor');

 

 

 

                $retorno = $this->M_Professor->alterarProfessor($this->getID(),  $this->getNome());

            } else {

 

            $retorno = array(

                'codigo' => 99,

 

 

 

                'msg'   => 'Os campos vindos do FrontEnd não representam o método de consulta, verifique.'

            );

        }

 

 

 

        echo json_encode($retorno);

    }

 

 

 

 

 

 

 

 

 

 

 

    public function apagarProfessor()

    {

 

 

 

        $json = file_get_contents('php://input');

 

 

 

        $resultado = json_decode($json);

 

 

 

        $lista = array("id" => '0');

 

 

 

 

 

 

 

        if (verificarParam($resultado, $lista) == 1) {

 

 

 

 

 

 

 

            $this->setID($resultado->id);

 

 

 

 

 

 

 

            if (strlen($this->getID()) == 0) {

 

 

 

                $retorno = array(

                    'codigo' => 3,

 

 

 

                    'msg' => 'ID do Professor não informado'

                );

            } else {

 

 

 

                $this->load->model('M_Professor');

 

 

 

                $retorno = $this->M_Professor->apagarProfessor($this->getID());

            }

        } else {

 

 

 

            $retorno = array(

                'codigo' => 99,

 

 

 

                'msg' => 'Os campos vindos do FrontEnd não representa, o método de consulta, verifique.'

            );

        }

 

 

 

        echo json_encode($retorno);

    }

 

 

 

 

 

 

 

    public function ativaAluno()

    {

 

 

 

        $json = file_get_contents('php://input');

 

 

 

        $resultado = json_decode($json);

 

 

 

        $lista = array("id" => '0');

 

 

 

 

 

 

 

        if (verificarParam($resultado, $lista) == 1) {

 

 

 

 

 

 

 

            $this->setID($resultado->id);

 

 

 

 

 

 

 

            if (strlen($this->getID()) == 0) {

 

 

 

                $retorno = array(

                    'codigo' => 3,

 

 

 

                    'msg' => 'ID do professor não informado'

                );

            } else {

 

 

 

                $this->load->model('M_Professor');

 

 

 

                $retorno = $this->M_Professor->ativaProfessor($this->getID());

            }

        } else {

 

 

 

            $retorno = array(

                'codigo' => 99,

 

 

 

                'msg' => 'Os campos vindos do FrontEnd não representa, o método de consulta, verifique.'

            );

        }

 

 

 

        echo json_encode($retorno);

    }

}