<?php
use App\Models\AnneeScolaire;
use App\Models\inscriptions;

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

if (!function_exists('genererMotDePasse')) {
    function genererMotDePasse($longueur = 10)
    {
        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        $motDePasse = '';
        for ($i = 0; $i < $longueur; $i++) {
            $motDePasse .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        return $motDePasse;
    }
}

/**
 * Retourne l'année scolaire active
 */
function anneeActive()
{
    return AnneeScolaire::where('active', true)->first();
}

/**
 * Retourne le libellé de l'année active
 */
function libelleAnneeActive()
{
    return optional(anneeActive())->libelle ?? 'Aucune année active';
}

function estInscrit($eleve_id)
{
    return inscriptions::where('eleve_id', $eleve_id)
        ->where('annee_scolaire_id', optional(anneeActive())->id)
        ->exists();
}

/**
 * Retourne les détails d'inscription d'un élève
 */
function obtenirInscription($eleve_id)
{
    return inscriptions::where('eleve_id', $eleve_id)
        ->where('annee_scolaire_id', optional(anneeActive())->id)
        ->with('eleve', 'classe', 'annee_scolaire')
        ->first();
}

/**
 * Vérifie si l'élève est inscrit et retourne son statut
 */
function verifierStatutInscription($eleve_id)
{
    $inscription = obtenirInscription($eleve_id);
    
    if (!$inscription) {
        return [
            'inscrit' => false,
            'statut' => 'non inscrit',
            'message' => 'L\'élève n\'est pas inscrit pour cette année scolaire'
        ];
    }
    
    return [
        'inscrit' => true,
        'statut' => $inscription->statut_inscription,
        'classe' => optional($inscription->classe)->nom,
        'annee_scolaire' => optional($inscription->annee_scolaire)->libelle,
        'date_inscription' => $inscription->date_inscription,
        'message' => $this->getMessageStatut($inscription->statut_inscription)
    ];
}

/**
 * Retourne un message lisible selon le statut
 */
function getMessageStatut($statut)
{
    $messages = [
        'en_attente' => 'Inscription en attente d\'approbation',
        'approuvee' => 'Inscription approuvée',
        'rejetee' => 'Inscription rejetée',
        'confirmee' => 'Inscription confirmée'
    ];
    
    return $messages[$statut] ?? 'Statut inconnu';
}
