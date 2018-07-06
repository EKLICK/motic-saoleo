<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 26/06/2018
 * Time: 08:32
 */

namespace App\Http\Controllers\Admin\Auditoria;

use App\Auditoria;
use App\Http\Controllers\Auditoria\AuditoriaController;
use App\User;
use Illuminate\Http\Request;

class AdminAuditoriaRelatorioController
{

    private $auditoriaController;

    public function __construct(AuditoriaController $auditoriaController)
    {
        $this->auditoriaController = $auditoriaController;
    }

    public function index(){
        $usuarios = User::orderBy('name', 'asc')->paginate(10);
        $auditorias = Auditoria::latest()->paginate(10);
        return view('admin.auditoria.relatorios', compact('usuarios', 'auditorias'));
    }

    public function todosRegistros()
    {
        $registros = Auditoria::latest()->get();
        return \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
            ->loadView('pdf.auditoria.todos-registros', compact('registros'))
            ->stream('todos-registros-motic'.date('Y').'.pdf');
    }

    public function filtrar(Request $request){
        try {
            $dataForm = $request->all();
            $auditorias = $this->auditoriaController->filtro($dataForm);
            $modal1 = true;
            return view('admin.auditoria.relatorios', compact('auditorias', 'modal1'));
        }catch(\Exception $e){
            return "Erro ". $e->getMessage();
        }
    }

    public function filtrarUsuarios(Request $request){
        $dataForm = $request->all();
        $modal2 = true;
        try{
            if($dataForm['tipo'] == 'id'){
                $usuarios = User::where('id', '=', $dataForm['search'])->paginate(10);
            }else if($dataForm['tipo'] == 'nome'){
                $filtro = '%'.$dataForm['search'].'%';
                $usuarios = User::where('name', 'like', $filtro)->paginate(10);
            }else if($dataForm['tipo'] == 'username'){
                $filtro = '%'.$dataForm['search'].'%';
                $usuarios = User::where('username', '=', $filtro)->paginate(10);
            }
            return view('admin.auditoria.relatorios', compact('usuarios', 'modal2'));
        }catch (\Exception $e) {
            return "ERRO: " . $e->getMessage();
        }
    }

    /*
    public function todosRegistrosCompleto()
    {
        $escolas = Escola::orderBy('name','asc')->get();
        return  \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
            ->loadView('pdf.escola-alunos', compact('escolas'))
            ->stream('todos-alunos-por-escola-motic'.date('Y').'.pdf');
    }

    public function registrosPorUsuarios()
    {
        $dataForm = $request->all();
        $aluno = Aluno::find($dataForm['id']);
        return  \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
            ->loadView('pdf.aluno-individual', compact('aluno'))
            ->stream('aluno-'.$aluno->name.'-'.date('Y').'.pdf');
    }

    public function registrosPorUsuario($id)
    {
        $alunos = Aluno::all();
        return  \PDF::setOptions(['dpi' => 325, 'defaultFont' => 'sans-serif'])
            ->loadView('pdf.todos-alunos-completo', compact('alunos'))
            ->stream('alunos-completo-'.date('Y').'.pdf');
    }
*/


}