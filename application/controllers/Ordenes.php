<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Ordenes extends CI_Controller
{
    /* Inicializar el constructor */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cliente');
        $this->load->model('orden');
        $this->load->model('producto');
    }
    /* API REST 
        - index (spa)
        - create (Proceso) || (post)
        - list() (Vista) || (get)
        - view(?$id) (Vista) || (get)
        - update($id) (Proceso) || (post)
        - delete($id) (Proceso) || (post)
    */
    public function index() // get
    {
        $data = [
            'clientes' => $this->cliente->list(),
        ];

        $this->load->view('template/header');
        $this->load->view('ordenes/index', $data);
        $this->load->view('template/footer');
        return;
    }

    public function create() // post
    {
        $fecha = $this->input->post('fecha');
        $cliente_id = $this->input->post('cliente_id');

        $data = [
            'fecha' => $fecha,
            'cliente_id' => $cliente_id,
        ];

        echo $this->orden->add($data);
    }

    public function list() // get
    {
        echo json_encode($this->orden->listOrdenCliente());
    }

    public function delete($id) // post
    {
        $this->orden->delete($id);
        echo true;
    }

    public function update($id)
    {
        // Recupero informacion
        $clienteId = $this->input->post('clienteId');
        $fecha = $this->input->post('fecha');
        // Armo el array o data
        $data = [
            'cliente_id' => $clienteId,
            'fecha' => $fecha,
        ];
        // Almaceno
        $this->orden->update($id, $data);
        // Envio respuesta
        echo true;
    }

    // Funciones Personalizadas del controlador
    public function gestionar($id)
    {
        $orden = $this->orden->find($id);
        $clientes = $this->cliente->list();
        $productos = $this->producto->list();

        $data = [
            'orden' => $orden,
            'productos' => $productos,
            'clientes' => $clientes,
        ];
        $this->load->view('template/header');
        $this->load->view('ordenes/gestionar', $data);
        $this->load->view('template/footer');
    }

    public function obtenerTotal($id)
    {
        $orden = $this->orden->find($id);

        echo $orden->total;
    }
}
