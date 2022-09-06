<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\Estagio;
use App\Models\OrdensServicos;

trait OrdenServicoTrait {

    public function generateCode() {
        try {
            // $currentDate = Carbon::now("America/Sao_Paulo");
            $currentDate = new Carbon(Carbon::now("America/Sao_Paulo"), 'UTC');
            $lastOrden = OrdensServicos::whereDate('created_at', $currentDate->format('Y-m-d'))->count();
            $newPosition = str_pad(($lastOrden + 1), 4, "0", STR_PAD_LEFT);
            $newCode = "{$currentDate->format('Ymd')}-{$newPosition}";

            return $newCode;
        } catch(\Exception $error) {
            return null;
        }
    }

    public function getNextEstagio($currentEstagioId) {
        try {
            $currentEstagioId = intval($currentEstagioId);
            $newEstagioId = $currentEstagioId;
            $estagios = Estagio::orderBy('id')->get();
            $found = false;
            foreach ($estagios as $estagio) {
                if ($found) {
                    $newEstagioId = $estagio->id;
                    break;
                }
                if ($currentEstagioId === $estagio->id) {
                    $found = true;
                }
            }

            return $newEstagioId;
        } catch(\Exception $error) {
            return $currentEstagioId;
        }
    }

    public function getPrevEstagio($currentEstagioId) {
        try {
            $currentEstagioId = intval($currentEstagioId);
            $newEstagioId = $currentEstagioId;
            $estagios = Estagio::orderBy('id')->get();
            foreach ($estagios as $estagio) {
                if ($currentEstagioId === $estagio->id) {
                    break;
                }
                $newEstagioId = $estagio->id;
            }

            return $newEstagioId;
        } catch(\Exception $error) {
            return $currentEstagioId;
        }
    }

    public function saveStatusHistory($ordemServicoId, $estagioId, $responsavelId) {
        try {
            $ordemServico = OrdensServicos::findOrFail($ordemServicoId);
            $ordemServico->estagios_historico()->create([
                'estagio_id' => $estagioId,
                'responsavel_id' => $responsavelId
            ]);

            return true;
        } catch(\Exception $error) {
            return false;
        }
    }
}