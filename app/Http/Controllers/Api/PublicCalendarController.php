<?php
// app/Http/Controllers/Api/PublicCalendarController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PeriodeAstreinte;
use App\Models\Planning;
use Carbon\Carbon;

class PublicCalendarController extends Controller
{
    /**
     * Get all active périodes for public calendar view
     * No authentication required - this is for public access
     */
    public function getPeriodes()
    {
        $periodes = PeriodeAstreinte::with(['service'])
            ->where('is_active', true)
            ->orderBy('date_debut', 'asc')
            ->get();

        return response()->json(['data' => $periodes]);
    }

    /**
     * Get current week's astreintes with agent details
     * This populates the "Agents de garde cette semaine" dashboard
     * No authentication required
     */
    public function getCurrentWeekAstreintes()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $plannings = Planning::with(['periodeAstreinte.service', 'agent'])
            ->whereHas('periodeAstreinte', function($query) use ($startOfWeek, $endOfWeek) {
                $query->where('date_debut', '<=', $endOfWeek)
                      ->where('date_fin', '>=', $startOfWeek)
                      ->where('is_active', true);
            })
            ->where('statut', '!=', 'annule')
            ->get();

        $astreintes = $plannings->map(function($planning) {
            return [
                'service' => $planning->periodeAstreinte->service->nom,
                'agent_nom' => $planning->agent->nom,
                'agent_prenom' => $planning->agent->prenom,
                'matricule' => $planning->agent->matricule,
                'type_periode' => $planning->periodeAstreinte->type_periode,
                'date_debut' => $planning->periodeAstreinte->date_debut,
                'date_fin' => $planning->periodeAstreinte->date_fin,
                'heure_debut' => $planning->periodeAstreinte->heure_debut,
                'heure_fin' => $planning->periodeAstreinte->heure_fin,
            ];
        });

        return response()->json(['data' => $astreintes]);
    }
}