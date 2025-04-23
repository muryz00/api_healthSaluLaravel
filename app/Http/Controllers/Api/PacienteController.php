<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PacienteController extends Controller
{
    public function cadastrar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'email' => 'required|email|unique:pacientes',
            'senha' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['erro' => $validator->errors()], 422);
        }

        $paciente = new Paciente();
        $paciente->nome = $request->nome;
        $paciente->email = $request->email;
        $paciente->senha = Hash::make($request->senha);
        $paciente->save();

        return response()->json(['mensagem' => 'Paciente cadastrado com sucesso', 'paciente' => $paciente]);
    }

    public function login(Request $request)
    {
        $paciente = Paciente::where('email', $request->email)->first();

        if ($paciente && Hash::check($request->senha, $paciente->senha)) {
            return response()->json(['mensagem' => 'Login realizado com sucesso', 'paciente' => $paciente]);
        }

        return response()->json(['erro' => 'Credenciais inválidas'], 401);
    }

    public function atualizar(Request $request, $id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json(['erro' => 'Paciente não encontrado'], 404);
        }

        $paciente->update($request->all());

        return response()->json(['mensagem' => 'Paciente atualizado com sucesso', 'paciente' => $paciente]);
    }

    public function deletar($id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json(['erro' => 'Paciente não encontrado'], 404);
        }

        $paciente->delete();

        return response()->json(['mensagem' => 'Paciente deletado com sucesso']);
    }
}
