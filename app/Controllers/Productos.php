<?php

namespace App\Controllers;

class Productos extends BaseController
{

    public function filtrarFechas()
    {
        //GET - list of products
        $get_endpoint = 'products';

        $response = perform_http_request('GET', self::getUrl() . $get_endpoint);

        $data['productos'] = $response;

        $array = [];

        $request = \Config\Services::request();
        $productos = json_decode($data['productos']);
        foreach ($productos->response as $value) {
            $create_date=$value->create_date;
            $last_update=$value->last_update;
            $inicio=$request->getPostGet('inicio');
            $fin=$request->getPostGet('fin');

            if (date("Y-m-d ", strtotime($inicio)) >= date("Y-m-d ", strtotime( $create_date)) || date("Y-m-d ", strtotime($fin)) <= date("Y-m-d ", strtotime( $last_update))) {
                array_push($array, $value);
            }
        }
        $datos = array('cabecera' => view('estructura/header'), 'productos' => $array);

        return view('estructura/productos', $datos);
    }

    public function index()
    {
        //GET - list of products
        $get_endpoint = 'products';

        $response = perform_http_request('GET', self::getUrl() . $get_endpoint);

        $data['productos'] = $response;
        $datos = array('cabecera' => view('estructura/header'), 'productos' => $data['productos']);

        return view('estructura/productos', $datos);
    }
}
