<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('material.list');
    }

    public function create(){

    }

    public function edit($id){

    }

    public function delete($id){

    }

    public function store(Request $request){

    }
}
