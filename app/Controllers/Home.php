<?php

namespace App\Controllers;

// use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Home extends BaseController
{
    // use ResponseTrait;

    public function index()
    {

        helper(['curl']);
        $rest_api_base_url = 'https://sandbox.ixaya.net/api/';
		
		//GET - list of products
		$get_endpoint = 'products';
		
		$response = perform_http_request('GET', $rest_api_base_url . $get_endpoint);
		
		$data['productos'] = $response;
        $cabecera = array('cabecera' => view('estructura/header'),'productos' => $data['productos']);
        return view('estructura/body', $cabecera);
        // return view('estructura/header').view('estructura/body');
    }


    // public function createUser()
    // {
    //     $model = new UserModel();
    //     $user  = $model->save($this->request->getPost());

    //     // Respond with 201 status code
    //     return $this->respondCreated();
    // }
}
