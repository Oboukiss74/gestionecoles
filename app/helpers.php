<?php

if (!function_exists('anneeScolaireActuelle')) {
    function anneeScolaireActuelle()
    {
        $annee = date('Y');
        $mois = date('m');

        if ($mois >= 9) {
            return $annee . '-' . ($annee + 1);
        } else {
            return ($annee - 1) . '-' . $annee;
        }
    }
}
