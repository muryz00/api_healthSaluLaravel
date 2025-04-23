<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function cadastrar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'email' => 'required|email|unique:usuarios',
            'senha' => 'required|string|min:6',
            'tipo' => 'required|in:paciente,medico'
        ]);

        if ($validator->fails()) {
            return response()->json(['erro' => $validator->errors()], 422);
        }

        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
            'tipo' => $request->tipo
        ]);

        return response()->json(['mensagem' => 'Usuário cadastrado com sucesso', 'usuario' => $usuario], 201);
    }

    public function atualizar(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['erro' => 'Usuário não encontrado'], 404);
        }

        $data = $request->all();
        if (isset($data['senha'])) {
            $data['senha'] = Hash::make($data['senha']);
        }

        $usuario->update($data);

        return response()->json(['mensagem' => 'Usuário atualizado com sucesso', 'usuario' => $usuario]);
    }

    public function consultar($id = null)
    {
        if ($id) {
            $usuario = Usuario::find($id);
            if (!$usuario) {
                return response()->json(['erro' => 'Usuário não encontrado'], 404);
            }
            return response()->json($usuario);
        }

        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }
}
