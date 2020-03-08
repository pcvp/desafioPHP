<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PlanoCartesiano extends CI_Controller
{




    public function index()
    {
        $data["Message"] = "Posição inicial";
        $data["TextButton"] = "Iniciar";
        $this->load->view('post_session', $data);
    }



    public function changePosition()
    {
        if ($this->input->post()) {

            $x = strtoupper($this->input->post("X"));
            $y = $this->input->post("Y");


            $acceptedValues = new StdClass();

            $acceptedValues->N =  function ($value): int {
                $_SESSION["Y"] = $_SESSION["Y"] + $value;
                return $_SESSION["Y"];
            };

            $acceptedValues->S =  function ($value): int {
                $_SESSION["Y"] = $_SESSION["Y"] - $value;
                return $_SESSION["Y"];
            };

            $acceptedValues->L =  function ($value): int {
                $_SESSION["X"] = $_SESSION["X"] + $value;
                return $_SESSION["X"];
            };

            $acceptedValues->O =  function ($value): int {
                $_SESSION["X"] = $_SESSION["X"] - $value;
                return $_SESSION["X"];
            };


            if (!isset($acceptedValues->$x)) {
                $_SESSION["X"] = $x;
                $_SESSION["Y"] = $y;
            } else {
                $run = $acceptedValues->$x;
                $run($y);
            }


            $data["x"] =  (int)$_SESSION["X"];
            $data["y"] =  (int)$_SESSION["Y"];

            if (!$this->input->is_ajax_request()) {
                $data["TextButton"] = "Alterar posição";
                $this->load->view('post_session', $data);
            }else{
                header('Content-type: application/json');
                echo json_encode($data);
            }
        }
    }

    public function ajax()
    {
        $this->load->view("ajax");
    }
}
