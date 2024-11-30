<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Retorna o total de horas por operação em um determinado mês.
     */
    public function totalHorasPorOperacao(Request $request)
    {
        $mes = $request->query('mes', now()->month); // Filtra pelo mês atual por padrão

        $logs = DB::table('operacoes')
            ->leftJoin('operacoes_logs', function ($join) use ($mes) {
                $join->on('operacoes.id', '=', 'operacoes_logs.operacao_id')
                    ->whereMonth('operacoes_logs.data', $mes);
            })
            ->select('operacoes.operacao', DB::raw('COALESCE(SUM(operacoes_logs.horas), 0) as total_horas'))
            ->groupBy('operacoes.id', 'operacoes.operacao')
            ->get();

        return response()->json($logs);
    }

}
