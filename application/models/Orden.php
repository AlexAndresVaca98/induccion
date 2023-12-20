<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Orden extends CI_Model
{
    private $nombreTabla;
    private $idTabla;

    public function __construct()
    {
        parent::__construct();
        $this->nombreTabla = 'ordenes';
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
    public function listOrdenCliente()
    {
        $this->db->select('ordenes.id, ordenes.fecha, clientes.nombre, clientes.apellido');
        $this->db->join('clientes', 'clientes.id = ordenes.cliente_id');
        $query = $this->db->get($this->nombreTabla);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function datosMensuales($anio, $mes)
    {
        $this->db->select('SUM(total) as total');
        $this->db->where('MONTH(ordenes.fecha)', $mes);
        $this->db->where('YEAR(ordenes.fecha)', $anio);
        $query = $this->db->get($this->nombreTabla);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function totalDeClientes()
    {
        $this->db->select('COUNT(ordenes.id) as numero_compras, SUM(ordenes.total) as total_compras, clientes.nombre, clientes.apellido');
        $this->db->join('clientes', 'clientes.id = ordenes.cliente_id');
        $this->db->group_by('clientes.id');
        $query = $this->db->get($this->nombreTabla);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function productosMasVendidos()
    {
        $this->db->select('SUM(detalle_orden.cantidad) as numero_ventas, productos.detalle');
        $this->db->join('detalle_orden', 'ordenes.id = detalle_orden.orden_id');
        $this->db->join('productos', 'productos.id = detalle_orden.producto_id');
        $this->db->group_by('productos.id');
        $this->db->order_by('numero_ventas', 'DESC');

        $query = $this->db->get($this->nombreTabla);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
