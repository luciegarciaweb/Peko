<?php

return [
    'title' => 'Aux paniers de Péko',
    'description' => 'Ventes de légumes et fruits frais dans la région de Lodève.',
    'email' => 'test@test.com',
    
    /**
     * Informations à propos de l'adresse
     */
    'address' => [
        'name' => 'A la source de Péko',
        'phone' => '0605040302',
        'address' => '9859F Chemin de Montpellier',
        'city' => 'Lodève',
        'zipcode' => '34700',
    ],

    'pagination' => 10,
    
    /**
     * A partir de quel heure on peut venir chercher son panier
     * Format 24H
     */
    'open_hours' => 10,

    /**
     * Jusqu'à quel heure on peut venir chercher son panier
     * Format 24H
     */    
    'close_hours' => 20,

    /**
     * La durée du panier sur le site
     * Format Minutes
     */
    'carts_duration' => 120,

    /**
     * La durée par rapport à l'heure ou l'utilisateur peut venir chercher le panier
     * Format heure
     */
    'hour_increment' => 1,

    /**
     * Mettre la TVA que vous souhaitez
     * Format Pourcentage
     */
    'tva' => 20,
];