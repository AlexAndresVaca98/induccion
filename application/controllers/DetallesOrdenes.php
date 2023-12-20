<?php
defined('BASEPATH') || exit('No direct script access allowed');

class DetallesOrdenes extends CI_Controller
{
    /* Inicializar el constructor */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cliente');
        $this->load->model('orden');
        $this->load->model('producto');
        $this->load->model('detalleOrden');
    }
    /* API REST 
        - index (spa)
        - create (Proceso) || (post)
        - list() (Vista) || (get)
        - view(?$id) (Vista) || (get)
        - update($id) (Proceso) || (post)
        - delete($id) (Proceso) || (post)
    */
    public function create()
    {
        // Recuperar la informacion
        $ordenId = $this->input->post('ordenId');
        $productoId = $this->input->post('productoId');
        $cantidad = $this->input->post('cantidad');

        // Recuperar el valor del producto
        $producto = $this->producto->find($productoId);
        $valor = $producto->valor;

        $total = (int)$cantidad * (float)$valor;

        // Crear el objeto
        $data = [
            'orden_id' => $ordenId,
            'producto_id' => $productoId,
            'cantidad' => $cantidad,
            'total' => $total,
        ];
        // Guardar el registro
        $id = $this->detalleOrden->add($data);

        $this->calcularTotalOrden($ordenId);
        // Responder
        echo $id;
    }

    public function list($id)
    {
        $detalles = $this->detalleOrden->obtenerPorOrden($id);

        echo json_encode($detalles);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $ordenId = $this->input->post('ordenId');

        $this->detalleOrden->delete($id);

        $this->calcularTotalOrden($ordenId);

        echo true;
    }

    private function calcularTotalOrden($idOrden)
    {
        $detalles = $this->detalleOrden->obtenerPorOrden($idOrden);
        $total = 0;

        if ($detalles) {
            foreach ($detalles as $key => $detalle) {
                $total = $total + (float)$detalle->total;
            }
        }

        $this->orden->update($idOrden, [
            'total' => $total,
        ]);

        return $total;
    }
}
