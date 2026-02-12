<?php

return [
    'user' => [
        'created' => 'User created successfully',
    ],

    'role' => [
        'created' => 'Role created successfully',
    ],

    'role_user' => [
        'assigned' => 'Role assigned to user successfully',
    ],

    'state' => [
        'created' => 'State created successfully',
        'failed'  => 'Unable to create state. Please try again.',
    ],

    'city' => [
        'created' => 'City created successfully',
        'failed'  => 'Failed to create city',
    ],

    'community' => [
        'created' => 'Community created successfully',
        'failed'  => 'Failed to create community',
    ],

    // 'prospect_personal' => [
    //     'created' => 'Prospect personal details created successfully',
    //     'failed'  => 'Failed to create prospect personal details',
    // ],
      'prospect_personal' => [
        'created' => 'Prospect personal details created successfully',
        'failed'  => 'Failed to create prospect personal details',
        'validation' => [
            'name' => 'Name must start with a letter and contain only letters and spaces.',
            'mobile' => 'Mobile number must start with 6,7,8, or 9 and be 10 digits.',
            'customer_id' => 'Customer is required.',
            'flat_no' => 'Flat No is required.',
            'floor' => 'Floor is required.',
            'block_street' => 'Block/Street is required.',
            'remarks' => 'Remarks is required.',
            'community_id' => 'Community is required.',
        ],
    ],

    'prospect_household' => [
        'created' => 'Prospect household details created successfully',
        'failed'  => 'Failed to create prospect household details',
    ],

    'prospect_preferences' => [
        'created' => 'Prospect preference details created successfully',
        'failed'  => 'Failed to create prospect preference details',
    ],

    'prospect_preferences_cuisine' => [
        'created' => 'Cuisines added to prospect preferences successfully',
        'failed'  => 'Failed to add cuisines to prospect preferences',
    ],

    'prospect_purchase' => [
        'created' => 'Prospect purchase details created successfully',
        'failed'  => 'Failed to create prospect purchase details',
    ],

    'error' => [
        'general' => 'Something went wrong. Please try again.',
    ],
];
