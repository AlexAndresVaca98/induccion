<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Clientes extends CI_Controller
{
    /* Inicializar el constructor */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cliente');
    }
    /* API REST FULL
        - index
        - add (Vista) || (get)
        - create (Proceso) || (post)
        - edit($id) (Vista) || (get)
        - update($id) (Proceso) || (post)
        - delete($id) (Proceso) || (post)
    */
    public function index() // get
    {
        $clientes = $this->cliente->list();
        $data = [
            'clientes' => $clientes,
        ];

        // Header
        $this->load->view('template/header');
        // Main
        $this->load->view('clientes/index', $data);
        // Footer
        $this->load->view('template/footer');
        return;
    }
    public function add() // get
    {
        $data = [];
        $this->load->view('template/header');
        $this->load->view('clientes/add', $data);
        $this->load->view('template/footer');
        return;
    }
    public function create() // post
    {
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $identificacion = $this->input->post('identificacion');
        $direccion = $this->input->post('direccion');
        $telefono = $this->input->post('telefono');
        $email = $this->input->post('email');

        $data = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'identificacion' => $identificacion,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'email' => $email,
        ];

        $this->cliente->add($data);

        redirect('clientes/index');
        return;
    }
    public function edit($id) // get
    {
        // Recuperar el registro
        $cliente = $this->cliente->find($id);
        $data = [
            'cliente' => $cliente
        ];

        $this->load->view('template/header');
        $this->load->view('clientes/edit', $data);
        $this->load->view('template/footer');
        return;
    }
    public function update($id) // post
    {
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $identificacion = $this->input->post('identificacion');
        $direccion = $this->input->post('direccion');
        $telefono = $this->input->post('telefono');
        $email = $this->input->post('email');

        $data = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'identificacion' => $identificacion,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'email' => $email,
        ];

        $this->cliente->update($id, $data);
        redirect('clientes/index');

        return;
    }
    public function delete($id) // post
    {
        $this->cliente->delete($id);
        redirect('clientes/index');
        return;
    }
}
