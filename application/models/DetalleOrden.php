<?php
defined('BASEPATH') || exit('No direct script access allowed');

class DetalleOrden extends CI_Model
{
    private $nombreTabla;
    private $idTabla;

    public function __construct()
    {
        parent::__construct();
        $this->nombreTabla = 'detalle_orden';
        $this->idTabla = 'id';
    }
    /* CRUD */
    // CREATE
    public function add($data)
    {
        $this->db->insert($this->nombreTabla, $data);
        return $this->db->insert_id();
    }
    // READ
    public function list($params = []) // Entrega todos los resultados
    {
        $query = $this->db->get($this->nombreTabla);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get($params = array(), $order_by = array(), $limit = '') // Entrega resultados condicionados
    {
        if (!empty($params)) {
            foreach ($params as $field => $value) {
                $this->db->where($field, $value);
            }
        }

        if (!empty($order_by)) {
            foreach ($order_by as $field => $direction) {
                $this->db->order_by($field, $direction);
            }
        }

        if (!empty($limit)) {
            $this->db->limit($limit);
        }

        $query = $this->db->get($this->nombreTabla);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function find($id) // Entrega un unico registro por ID
    {
        $this->db->where($this->idTabla, $id);

        $query = $this->db->get($this->nombreTabla);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    // UPDATE
    public function update($id, $data) // Actualizacion
    {
        $this->db->where($this->idTabla, $id);
        return $this->db->update($this->nombreTabla, $data);
    }
    // DELETE
    public function delete($id) // Eliminar registro
    {
        $this->db->where($this->idTabla, $id);
        return $this->db->delete($this->nombreTabla);
    }

    // Funciones personalizadas
    public function obtenerPorOrden($id)
    {
        $this->db->select('detalle_orden.*, productos.detalle, productos.valor');
        $this->db->where('detalle_orden.orden_id', $id);
        $this->db->join('productos', 'detalle_orden.producto_id = productos.id');

        $query = $this->db->get($this->nombreTabla);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
