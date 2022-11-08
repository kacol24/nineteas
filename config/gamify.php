<?php

use App\Models\Customer;

return [
    // Model which will be having points, generally it will be User
    'payee_model'                  => Customer::class,

    // Reputation model
    'reputation_model'             => '\QCod\Gamify\Reputation',

    // Allow duplicate reputation points
    'allow_reputation_duplicate'   => true,

    // Broadcast on private channel
    'broadcast_on_private_channel' => true,

    // Channel name prefix, user id will be suffixed
    'channel_name'                 => 'user.reputation.',

    // Badge model
    'badge_model'                  => '\QCod\Gamify\Badge',

    // Where all badges icon stored
    'badge_icon_folder'            => 'images/badges/',

    // Extention of badge icons
    'badge_icon_extension'         => '.svg',

    // All the levels for badge
    'badge_levels'                 => [
        'bronze'   => 1,
        'silver'   => 2,
        'gold'     => 3,
        'platinum' => 4,
    ],

    // Default level
    'badge_default_level'          => 1,
];
