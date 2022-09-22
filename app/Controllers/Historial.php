<?php

namespace App\Controllers;

class Historial extends BaseController
{
    public function index()
    {
		
		//GET - list of products
		$get_endpoint = 'orders/list_record';
		
		$response = perform_http_request('GET', self::getUrl() . $get_endpoint);
		
		$data['list_record'] = $response;
        $datos = array('cabecera' => view('estructura/header'),'list_record' => $data['list_record']);

        return view('estructura/historial',$datos);

    }
   
    public function filtrarFechas()
    {
        //GET - list of orders
        $get_endpoint = 'orders/list_record';

        $response = perform_http_request('GET', self::getUrl() . $get_endpoint);

        $data['list_record'] = $response;

        $array = [];

        $request = \Config\Services::request();
        $productos = json_decode($data['list_record']);
        foreach ($productos->response as $value) {
            // $create_date=$value->create_date;
            $last_update = $value->last_update;
            $inicio = $request->getPostGet('inicio');

            if (date("Y-m-d ", strtotime($inicio)) == date("Y-m-d ", strtotime($last_update))) {
                array_push($array, $value);
            }
        }
        $datos = array('cabecera' => view('estructura/header'), 'list_record' => $array);

        return view('estructura/historial', $datos);
    }
    
    public function bar_chart()
    {

        //GET - list of orders
        $get_endpoint = 'orders/list_record';

        $response = perform_http_request('GET', self::getUrl() . $get_endpoint);

        $datos['orders'] = $response;
        $records = json_decode($datos['orders']);
        // var_dump($records);
        $data = [];
        foreach ($records->response as $row) {
            // dd(count($row->products));
            $last_update = $row->last_update;
            $count = count($row->products);
            $data[] = ['date' => date('Y-m-t', strtotime($last_update)), 'count' => $count];
        }
        $data['chart_data'] = json_encode($data);
        $datos = array('cabecera' => view('estructura/header'), 'chart_data' => $data['chart_data']);

        return view('estructura/bar_chart', $datos);
    }
}
