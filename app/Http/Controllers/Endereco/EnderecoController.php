<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 15/05/2018
 * Time: 10:38
 */

namespace App\Http\Controllers\Endereco;

use App\Http\Controllers\Auditoria\AuditoriaController;
use App\Endereco;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class EnderecoController extends Controller
{

    private $auditoriaController;

    public function __construct(AuditoriaController $auditoriaController)
    {
        $this->auditoriaController = $auditoriaController;
    }

    public function buscar()
    {
        $enderecos = Endereco::all();
        try{
            return $enderecos;
        }catch (\Exception $e) {
            return "ERRO: " . $e->getMessage();
        }
    }

    public function editar($id){

        $endereco = Endereco::find($id);
        try{
            return $endereco;
        }catch (\Exception $e) {
            return "ERRO: " . $e->getMessage();
        }
    }

    public function store($request)
    {
        $endereco = Endereco::create($request);
        $this->auditoriaController->storeCreate(
            $descricao = "Criado o endereco do: ".$endereco->users->name.
                ", rua: ".$endereco->rua.
                ", numero: ".$endereco->numero.", complemento: ".$endereco->complemento.
                ", bairro: ".$endereco->bairro. ", cep: ".$endereco->cep.
                ", cidade: ".$endereco->cidade. ", estado: ".$endereco->estado.
                ", pais: ".$endereco->pais."user_id: ".$endereco->user_id.
                ", Criação: ".$endereco->created_at.', pelo usuário: '.Auth::user()->name,
            $endereco->id);

        try{
            return $endereco;
        }catch (\Exception $e) {
            return "ERRO: " . $e->getMessage();
        }
    }

    public function delete($id){

        $endereco = Endereco::find($id);
        $endereco->delete();

        $this->auditoriaController->storeDelete(
            $descricao = "Deletado o endereco do: ".$endereco->user->nome.
                ", rua: ".$endereco->rua.
                ", numero: ".$endereco->numero.", complemento: ".$endereco->complemento.
                ", bairro: ".$endereco->bairro. ", cep: ".$endereco->cep.
                ", cidade: ".$endereco->cidade. ", estado: ".$endereco->estado.
                ", pais: ".$endereco->pais."user_id: ".$endereco->user_id.
                ", Criação: ".$endereco->created_at.', pelo usuário: '.Auth::user()->name,
            $endereco->id);
        try{
            return $endereco;
        }catch (\Exception $e) {
            return "ERRO: " . $e->getMessage();
        }
    }

    public function update($req, $id)
    {
        $user = User::find($id);
        $user->endereco->update($req->all());
        $this->auditoriaController->storeUpdate(
            $descricao = "Editado o endereco do: ".$user->name.
                ", rua: ".$user->endereco->rua.
                ", numero: ".$user->endereco->numero.", complemento: ".$user->endereco->complemento.
                ", bairro: ".$user->endereco->bairro. ", cep: ".$user->endereco->cep.
                ", cidade: ".$user->endereco->cidade. ", estado: ".$user->endereco->estado.
                ", pais: ".$user->endereco->pais."user_id: ".$user->endereco->user_id.
                ", Criação: ".$user->endereco->created_at.', pelo usuário: '.Auth::user()->name,
            $user->endereco->id);

        try{
            return $user->endereco;
        }catch (\Exception $e) {
            return "ERRO: " . $e->getMessage();
        }
    }

}