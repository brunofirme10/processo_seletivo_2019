<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function listarUsuario()
    {
        $user=\App\Usuario::all();
        return view('home',compact('users'));
    }

    public function criarUsuario()
    {
        return view('create');
    }

    public function salvarUsuario(Request $request)
    {
        $user= new \App\Passport;
        $user->name=$request->get('nome');
        $user->email=$request->get('email');
        $user->data_nascimento=$request->get('date');
        $user->save();
        
        return redirect('users')->with('success', 'Usuário Salvo');
    }

    public function editarUsuario(Usuario $id)
    {
        $user = \App\Passport::find($id);
        return view('edit',compact('users','id'));
    }

    public function deletarUsuario(Usuario $id)
    {
        $passport = \App\Passport::find($id);
        $passport->delete();
        return redirect('users')->with('success','Usuário Deletado');
    }
}
