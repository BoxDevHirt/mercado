<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solicitacao_Item;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
  public function cancelar(Request $request)
  {
    $item = Solicitacao_Item::find($request->id);

    if (!$item) {
      return response()->json(['message' => 'Item não encontrado'], 404);
    }

    $item->status = 1; // muda para 1
    $item->save();

    return response()->json(['message' => 'Item cancelado com sucesso']);
  }
}
