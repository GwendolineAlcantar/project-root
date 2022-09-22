<?php

namespace App\Controllers;

// use CodeIgniter\Controller;

class Ordenes extends BaseController
{

    public function formulario()
    {
        //GET - list of products
        $get_endpoint = 'products';

        $response = perform_http_request('GET', self::getUrl() . $get_endpoint);

        $data['productos'] = $response;
        $cabecera = array('cabecera' => view('estructura/header'), 'productos' => $data['productos']);
        return view('estructura/form_product_ordenes', $cabecera);
    }

    public function filtrarFechas()
    {
        //GET - list of orders
        $get_endpoint = 'orders';

        $response = perform_http_request('GET', self::getUrl() . $get_endpoint);

        $data['orders'] = $response;

        $array = [];

        $request = \Config\Services::request();
        $productos = json_decode($data['orders']);
        foreach ($productos->response as $value) {
            // $create_date=$value->create_date;
            $last_update = $value->last_update;
            $inicio = $request->getPostGet('inicio');

            if (date("Y-m-d ", strtotime($inicio)) == date("Y-m-d ", strtotime($last_update))) {
                array_push($array, $value);
            }
        }
        $datos = array('cabecera' => view('estructura/header'), 'orders' => $array);

        return view('estructura/ordenes', $datos);
    }

    public function detalle()
    {

        $request = \Config\Services::request();

        $post_endpoint = 'orders/detail';

        $request_data = json_encode(
            array(
                'order_id' => $request->getPostGet('order_id'),
            )
        );
        // dd($request_data);
        $response = perform_http_request('POST', self::getUrl() . $post_endpoint, $request_data);

        $data['detail'] = $response;
        $datos = array('cabecera' => view('estructura/header'), 'detail' => $data['detail']);

        return view('estructura/detalle_product_ordenes', $datos);
    }

    public function index()
    {
        //GET - list of orders
        $get_endpoint = 'orders';

        $response = perform_http_request('GET', self::getUrl() . $get_endpoint);

        $data['orders'] = $response;


        $datos = array('cabecera' => view('estructura/header'), 'orders' => $data['orders']);

        return view('estructura/ordenes', $datos);
    }

    public function guarda()
    {
        $request = \Config\Services::request();

        $post_endpoint = 'orders/create';

        $request_data = json_encode(
            array(
                'street_name' => $request->getPostGet('street_name'),
                'zip_code' => $request->getPostGet('zip_code'),
                'address' => $request->getPostGet('address'),
                'phone' => $request->getPostGet('phone'),
                'state' => $request->getPostGet('state'),
                'city' => $request->getPostGet('city'),
                'product_list' => $request->getPostGet('product_list'),
            )
        );
        // dd($request_data);
        $response = perform_http_request('POST', self::getUrl() . $post_endpoint, $request_data);

        $data['new_user'] = $response;

        self::index();
    }

    public function bar_chart()
    {

        //GET - list of orders
        $get_endpoint = 'orders';

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
