<?php

namespace App\Http\Controllers;


use App\Models\Prova;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvaController extends Controller
{
    /**
     * Mostra uma lista com todos as Provas cadastradas
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $provas = Prova::all();
            return response()->json(['Mensagem' => 'Lista de Provas', 'data' => $provas], 200);
        } catch (\Exception $error) {
            return response()->json(['Mensagem' => "Ops! Ocorreu algum erro, entre em contato com o setor de desenvolvimento", "Erro:" . $error]);
        }
    }

    /**
     * Cadastra uma nova Prova
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $prova = new Prova($request->all());
            if (Prova::where('tipo', '=', $prova->tipo)->first()) {
                return response()->json("Prova já cadastrada", 409);
            } else {
                DB::table('provas')->insert([
                    'tipo' => $request->tipo,
                    'data' => $request->data,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                return response()->json('Prova cadastrada', 201);
            }
        } catch (\Exception $error) {
            return response()->json(['Mensagem' => "Ops! Ocorreu algum erro, entre em contato com o setor de desenvolvimento", "Erro:" . $error]);
        }
    }

    /**
     * Mostra uma prova com base no id
     *
     * @param \App\Models\Prova $prova
     * @return \Illuminate\Http\Response
     */
    public function show(Prova $prova)
    {
        try {
            $prova = Prova::find($prova->id);
            if (!$prova) {
                return response()->json(["Menssagem" => "Prova não encontrada"], 400);
            } else {
                return response()->json(["Menssagem" => "Prova encontrada", "data" => $prova]);
            }
        } catch (\Exception $error) {
            return response()->json(['Mensagem' => "Ops! Ocorreu algum erro, entre em contato com o setor de desenvolvimento", "Erro:" . $error]);
        }
    }

    /**
     * Atualiza os dados de um Prova
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prova $prova
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prova $prova)
    {
        try {
            $prova = Prova::find($prova->id);
            if (!$prova) {
                return response()->json(["Menssagem" => "Prova não encontrada", "data" => $prova], 400);
            } else {
                $prova->tipo = $request->tipo;
                $prova->data = $request->data;
                $prova->updated_at = Carbon::now();
                $prova->save();
                return response()->json(['Mensagem' => "Dados da Prova alterados com sucesso", "data" => $prova], 200);
            }

        } catch (\Exception $error) {
            return response()->json(['Mensagem' => "Ops! Ocorreu algum erro, entre em contato com o setor de desenvolvimento", "Erro:" . $error]);
        }
    }

    /**
     * Deleta um Prova com base no id
     *
     * @param \App\Models\Prova $prova
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prova $prova)
    {
        try {
            $prova = Prova::find($prova->id);
            if (!$prova) {
                return response()->json("Prova não encontrada", 400);
            } else {
                $prova->delete();
                return response()->json("Prova deletado com sucesso", 200);
            }
        } catch (\Exception $error) {
            return response()->json(['Mensagem' => "Ops! Ocorreu algum erro, entre em contato com o setor de desenvolvimento", "Erro:" . $error]);
        }
    }

}
