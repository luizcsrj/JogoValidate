<?php

namespace App\Http\Controllers;

use App\Models\Jogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jogos = Jogo::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->paginate(3);
        return view('jogos.index', compact('jogos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jogos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'titulo' => ['required', 'unique:jogos', 'max:255','min:4', 'string', 'filled'],
            'letra' => ['required', 'min:15'],
            'preco' => ['required','numeric', 'alpha_num','min:1'],
            'avaliacao' => ['required', 'alpha_num', 'between:0,50', 'digits_between:0,50'],
            'usabilidade' => ['required', 'alpha_num', 'between:0,50', 'digits_between:0,50']
        ]);

        $jogo = new Jogo($validateData);

        $jogo->user_id = Auth::id();

        $jogo->save();
        
        return redirect()->route('jogos.index')->with('success', 'Jogo criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jogo  $jogo
     * @return \Illuminate\Http\Response
     */
    public function show(Jogo $jogo)
    {
        return view('jogos.show', compact('jogo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jogo  $jogo
     * @return \Illuminate\Http\Response
     */
    public function edit(Jogo $jogo)
    {
        if($jogo->user_id === Auth::id()){
            return view('jogos.edit', compact('jogo'));
            }else{
                return redirect()->route('jogos.index')
                ->with('error', 'Não foi possível editar')
                ->withInput();
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jogo  $jogo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jogo $jogo)
    {
        if($jogo->user_id === Auth::id()){
            $jogo->update($request->all());
            return redirect()->route('jogos.index')->with('success', 'Jogo editado com sucesso');;
            }else{
                return redirect()->route('jogos.index')
                ->with('error', 'Não pode editar')
                ->withInput();
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jogo  $jogo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jogo $jogo)
    {
        if($jogo->user_id === Auth::id()){

            
            $jogo->delete();
    
            return redirect()->route('jogos.index')->with('success', 'Jogo deletado com sucesso');;
            }else{
                return redirect()->back()
                ->with('error', 'Não pode deletar')
                ->withInput();
            }
    
    }
}
