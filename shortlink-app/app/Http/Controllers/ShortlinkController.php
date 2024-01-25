<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shortlink;
use Validator;

class ShortlinkController extends Controller
{
    // Método para exibir a página inicial
    public function index()
    {
        $shortlinks = Shortlink::all();
        return view('shortlinks.index', compact('shortlinks'));
    }

    // Método para incluir um novo shortlink
    public function store(Request $request)
    {
        // Validar a entrada
        $validator = Validator::make($request->all(), [
            'original_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        // Criar e salvar o shortlink
        $shortlink = Shortlink::create([
            'original_url' => $request->input('original_url'),
            'short_url' => $this->generateShortUrl(), // Substitua isso pela lógica real de geração de short URL
        ]);

        return response()->json($shortlink, 201);
    }

    // Método para gerar um shortlink único
    private function generateShortUrl()
    {
        
        return uniqid();
    }

    // Método para redirecionar para a URL original
    public function redirect($shortUrl)
    {
        $shortlink = Shortlink::where('short_url', $shortUrl)->first();

        if (!$shortlink) {
            return redirect()->route('shortlinks.index')->with('error', 'Shortlink não encontrado!');
        }

        // Incrementar a contagem de cliques (bônus opcional)
        $shortlink->increment('click_count');

        return redirect($shortlink->original_url);
    }

    // Método para excluir um shortlink
    public function destroy($id)
    {
        $shortlink = Shortlink::find($id);

        if (!$shortlink) {
            return redirect()->route('shortlinks.index')->with('error', 'Shortlink não encontrado!');
        }

        $shortlink->delete();

        return redirect()->route('shortlinks.index')->with('success', 'Shortlink excluído com sucesso!');
    }
}
