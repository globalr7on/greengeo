<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\Estagio;

trait OrdenServicoTrait {

    public function generateCode($model) {
        try {
            $currentDate = Carbon::now("America/Sao_Paulo");
            $lastOrden = $model::whereDate('created_at', $currentDate->format('Y-m-d'))->count();
            $newPosition = str_pad(($lastOrden + 1), 4, "0", STR_PAD_LEFT);
            $newCode = "{$currentDate->format('Ymd')}-{$newPosition}";

            return $newCode;
        } catch(\Exception $error) {
            return null;
        }
    }

    public function getNextEstagio($currentEstagioId) {
        try {
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
}