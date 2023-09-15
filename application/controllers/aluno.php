
<?php

 

 

 

defined('BASEPATH') or exit('No direct script access allowed');

 

 

 

 

 

 

 

class aluno extends CI_Controller

{

 

 

 

    private $json;

 

 

 

    private $resultado;

 

 

 

    private $ra;

 

 

 

    private $idCurso;

 

 

 

    private $nome;

 

 

 

    private $estatus;

 

 

 

 

 

 

 

    public function getRA()

    {

 

 

 

        return $this->ra;

    }

 

 

 

 

 

 

 

    public function getIdCurso()

    {

 

 

 

        return $this->idCurso;

    }

 

 

 

 

 

 

 

    public function getNome()

    {

 

 

 

        return $this->nome;

    }

 

 

 

 

 

 

 

    public function getEstatus()

    {

 

 

 

        return $this->estatus;

    }

 

 

 

 

 

 

 

    public function setRA($raFront)

    {

 

 

 

        $this->ra = $raFront;

    }

 

 

 

 

 

 

 

    public function setIdCurso($idCursoFront)

    {

 

 

 

        $this->idCurso = $idCursoFront;

    }

 

 

 

 

 

 

 

    public function setNome($nomeFront)

    {

 

 

 

        $this->nome = $nomeFront;

    }

 

 

 

 

 

 

 

    public function setEstatus($estatusFront)

    {

 

 

 

        $this->estatus = $estatusFront;

    }

 

 

 

 

 

 

 

    public function inserirAluno()

    {

 

 

 

        $json = file_get_contents('php://input');

 

 

 

        $resultado = json_decode($json);

 

 

 

 

 

 

 

        $lista = array(

            "ra"      => '0',

 

 

 

            "nome"    => '0',

 

 

 

            "idCurso" => '0',

 

 

 

            "estatus" => '0'

        );

 

 

 

 

 

 

 

        if (verificarParam($resultado, $lista) == 1) {

 

 

 

 

 

 

 

            $this->setRA($resultado->ra);

 

 

 

            $this->setIdCurso($resultado->idCurso);

 

 

 

            $this->setNome($resultado->nome);

 

 

 

            $this->setEstatus($resultado->estatus);

        }

 

 

 

 

 

 

 

 

 

 

 

        if (trim($this->getRA()) == "" || $this->getRA() == 0) {

 

 

 

            $retorno = array(

                'codigo' => 3,

 

 

 

                'msg'   => 'RA do Aluno não informado ou zerado'

            );

        } elseif (trim($this->getIdCurso()) == "" || $this->getIdCurso() == 0) {

 

 

 

            $retorno = array(

                'codigo' => 4,

 

 

 

                'msg'    => 'ID do curso não informado ou zerado.'

            );

        } elseif ($this->getEstatus() != "D" && $this->getEstatus() != "") {

 

 

 

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

 

 

 

            $this->load->model('M_aluno');

 

 

 

            $retorno = $this->M_aluno->inserirAluno($this->getRA(), $this->getIdCurso(), $this->getNome(), $this->getEstatus());

        }

 

 

 

        echo json_encode($retorno);

    }

 

 

 

 

 

 

 

 

 

 

 

    public function consultarAluno()

    {

 

 

 

        $json = file_get_contents('php://input');

 

 

 

        $resultado = json_decode($json);

 

 

 

        $lista = array(

            "ra"      => '0',

 

 

 

            "idCurso" => '0',

 

 

 

            "nome"    => '0',

 

 

 

            "estatus" => '0'

        );

 

 

 

 

 

 

 

        if (verificarParam($resultado, $lista) == 1) {

 

 

 

            $this->setRA($resultado->ra);

 

 

 

            $this->setIdCurso($resultado->idCurso);

 

 

 

            $this->setNome($resultado->nome);

 

 

 

            $this->setEstatus($resultado->estatus);

 

 

 

 

 

 

 

 

 

 

 

            if ($this->getEstatus() != "D" && $this->getEstatus() != "") {

 

 

 

                $retorno = array(

                    'codigo' => 4,

 

 

 

                    'msg'    => 'Status não condiz com o permitido.'

                );

            } else {

 

 

 

                $this->load->model('M_aluno');

 

 

 

                $retorno = $this->M_aluno->consultarAluno($this->getRA(), $this->getIdCurso(), $this->getNome(), $this->getEstatus());

            }

        } else {

 

 

 

            $retorno = array(

                'codigo' => 99,

 

 

 

                'msg'    => 'Os Campos vindos do FrontEnd não representam o método de consulta, verifique.'

            );

        }

 

 

 

        echo json_encode($retorno);

    }

 

 

 

 

 

 

 

    public function alterarAluno()

    {

 

 

 

        $json = file_get_contents('php://input');

 

 

 

        $resultado = json_decode($json);

 

 

 

        $lista = array(

            "ra"      => '0',

 

 

 

            "idCurso" => '0',

 

 

 

            "nome"    => '0'

        );

 

 

 

 

 

 

 

        if (verificarParam($resultado, $lista) == 1) {

 

 

 

            $this->setRA($resultado->ra);

 

 

 

            $this->setIdCurso($resultado->idCurso);

 

 

 

            $this->setNome($resultado->nome);

 

 

 

 

 

 

 

 

 

 

 

           

 

 

 

                $this->load->model('M_aluno');

 

 

 

                $retorno = $this->M_aluno->alterarAluno($this->getRA(), $this->getIdCurso(), $this->getNome());

            } else {

 

            $retorno = array(

                'codigo' => 99,

 

 

 

                'msg'   => 'Os campos vindos do FrontEnd não representam o método de consulta, verifique.'

            );

        }

 

 

 

        echo json_encode($retorno);

    }

 

 

 

 

 

 

 

 

 

 

 

    public function apagarAluno()

    {

 

 

 

        $json = file_get_contents('php://input');

 

 

 

        $resultado = json_decode($json);

 

 

 

        $lista = array("ra" => '0');

 

 

 

 

 

 

 

        if (verificarParam($resultado, $lista) == 1) {

 

 

 

 

 

 

 

            $this->setRA($resultado->ra);

 

 

 

 

 

 

 

            if (strlen($this->getRA()) == 0) {

 

 

 

                $retorno = array(

                    'codigo' => 3,

 

 

 

                    'msg' => 'RA do aluno não informado'

                );

            } else {

 

 

 

                $this->load->model('M_aluno');

 

 

 

                $retorno = $this->M_aluno->apagarAluno($this->getRA());

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

 

 

 

        $lista = array("ra" => '0');

 

 

 

 

 

 

 

        if (verificarParam($resultado, $lista) == 1) {

 

 

 

 

 

 

 

            $this->setRA($resultado->ra);

 

 

 

 

 

 

 

            if (strlen($this->getRA()) == 0) {

 

 

 

                $retorno = array(

                    'codigo' => 3,

 

 

 

                    'msg' => 'RA do aluno não informado'

                );

            } else {

 

 

 

                $this->load->model('M_aluno');

 

 

 

                $retorno = $this->M_aluno->ativaAluno($this->getRA());

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

 