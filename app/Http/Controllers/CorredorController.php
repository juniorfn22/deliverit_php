<?php

namespace App\Http\Controllers;


use App\Models\Corredor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class CorredorController extends Controller
{
    /**
     * Mostra uma lista com todos os corredores cadastrados
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $corredores = Corredor::all();
            return response()->json(['Mensagem' => 'Lista de corredores', 'data' => $corredores], 200);
        } catch (\Exception $error) {
            return response()->json(['Mensagem' => "Ops! Ocorreu algum erro, entre em contato com o setor de desenvolvimento", "Erro:" . $error]);
        }
    }

    /**
     * Cadastra um novo corredor
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $corredor = new Corredor($request->all());
            if (Corredor::where('nome', '=', $corredor->nome)->first()) {
                return response()->json("Corredor já cadastrado", 409);
            } else {
                DB::table('corredors')->insert([
                    'nome' => $request->nome,
                    'cpf' => $request->cpf,
                    'data_nasc' => $request->data_nasc,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                return response()->json('Corredor cadastrado cadastrado', 201);
            }
        } catch (\Exception $error) {
            return response()->json(['Mensagem' => "Ops! Ocorreu algum erro, entre em contato com o setor de desenvolvimento", "Erro:" . $error]);
        }
    }

    /**
     * Mostra um corredor com base no id
     *
     * @param \App\Models\Corredor $corredor
     * @return \Illuminate\Http\Response
     */
    public function show(Corredor $corredor)
    {
        try {
            $corredor = Corredor::find($corredor->id);
            if ($corredor) {
                return response()->json(["Menssagem" => "Corredor encontrado", "data" => $corredor]);
            } else {
                return response()->json("Corredor não encontrado", 400);
            }
        } catch (\Exception $error) {
            return response()->json(['Mensagem' => "Ops! Ocorreu algum erro, entre em contato com o setor de desenvolvimento", "Erro:" . $error]);
        }
    }

    /**
     * Atualiza os dados de um corredor
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Corredor $corredor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Corredor $corredor)
    {
        try {
            $corredor = Corredor::find($corredor->id);
            if (!$corredor) {
                return response()->json("Corredor não encontrado", 400);
            } else {
                $corredor->nome = $request->nome;
                $corredor->cpf = $request->cpf;
                $corredor->data_nasc = $request->data_nasc;
                $corredor->updated_at = Carbon::now();
                $corredor->save();
                return response()->json(['Mensagem' => "Dados do corredor alterados com sucesso", "data" => $corredor], 200);
            }

        } catch (\Exception $error) {
            return response()->json(['Mensagem' => "Ops! Ocorreu algum erro, entre em contato com o setor de desenvolvimento", "Erro:" . $error]);
        }
    }

    /**
     * Deleta um corredor com base no id
     *
     * @param \App\Models\Corredor $corredor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corredor $corredor)
    {
        try {
            $corredor = Corredor::find($corredor->id);
            if (!$corredor) {
                return response()->json("Corredor não encontrado", 400);
            } else {
                $corredor->delete();
                return response()->json("Corredor deletado com sucesso", 200);
            }
        } catch (\Exception $error) {
            return response()->json(['Mensagem' => "Ops! Ocorreu algum erro, entre em contato com o setor de desenvolvimento", "Erro:" . $error]);
        }
    }

    public function incluirCorredor(Request $request)
    {
        try {
            $corredor = Corredor::find($request->id);
            $result = DB::table(competicaos)->insert([
                'id_corredor' => $request->id_corredor,
                'id_prova' => $request->id_prova
            ]);

            if (!$result) {
                return response()->json("Corredor não incluido na corrida", 400);
            } else {
                return response()->json("Corredor incluido na corrida", 201);
            }
        } catch (\Exception $error) {
            return response()->json(['Mensagem' => "Ops! Ocorreu algum erro, entre em contato com o setor de desenvolvimento", "Erro:" . $error]);
        }
    }
}
