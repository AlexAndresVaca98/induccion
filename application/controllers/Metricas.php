<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Metricas extends CI_Controller
{
	/* Inicializar el constructor */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('orden');
	}

	public function ordenes()
	{
		// Gráfico de barras
		// Eje X
		$labelsBarras =  ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
		// Eje Y
		$valuesData =  [];
		for ($i = 1; $i <= 12; $i++) {
			$consulta = $this->orden->datosMensuales('2023', $i);
			array_push($valuesData, $consulta->total);
		}

		// Gráfico de pastel
		// Eje X
		$labelsPastel =  [];
		// Eje Y
		$valuesPastel = [];

		$registros = $this->orden->totalDeClientes();

		if ($registros) {
			foreach ($registros as $key => $registro) {
				array_push($labelsPastel, $registro->nombre . ' ' . $registro->apellido);
				array_push($valuesPastel, $registro->numero_compras);
			}
		}


		$productosMasVendidos = $this->orden->productosMasVendidos();

		$data = [
			'labelsBarras' => $labelsBarras,
			'valuesData' => $valuesData,
			'labelsPastel' => $labelsPastel,
			'valuesPastel' => $valuesPastel,
			'productosMasVendidos' => $productosMasVendidos,
		];
		$this->load->view('template/header');
		$this->load->view('metricas/ordenes', $data);
		$this->load->view('template/footer');
	}
}
