<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medico;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MedicoController extends Controller
{
    public function cadastrar(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nome' => 'required|string',
                'email' => 'required|email|unique:medicos',
                'senha' => 'required|string|min:6',
                'cpf' => 'required|string|unique:medicos',
                'crm' => 'required|string|unique:medicos',
                'telefone' => 'nullable|string',
                'especialidade' => 'nullable|string'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'erro' => $validator->errors(),
                    'dados_recebidos' => $request->all() // Add this to see what was received
                ], 422);
            }
    
            $medico = Medico::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'senha' => Hash::make($request->senha),
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'crm' => $request->crm,
                'especialidade' => $request->especialidade
            ]);
    
            return response()->json([
                'mensagem' => 'Médico cadastrado com sucesso', 
                'medico' => $medico
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Erro interno no servidor',
                'detalhes' => $e->getMessage(),
                'trace' => $e->getTraceAsString() // Only in development!
            ], 500);
        }
    }

    public function atualizar(Request $request, $id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json(['erro' => 'Médico não encontrado'], 404);
        }

        $data = $request->all();
        if (isset($data['senha'])) {
            $data['senha'] = Hash::make($data['senha']);
        }

        $medico->update($data);

        return response()->json(['mensagem' => 'Médico atualizado com sucesso', 'medico' => $medico]);
    }

    public function consultar($id)
    {
        if ($id) {
            
            return response()->json(['message' => "Fetching record with ID: $id"]);
        } else {
            
            return response()->json(['message' => 'Fetching all records']);
        }

        $medicos = Medico::all();
        return response()->json($medicos);
    }
}
