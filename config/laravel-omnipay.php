<?php

return [

	// The default gateway to use
	'default' => 'paypal',

	// Add in each gateway here
	'gateways' => [
		'paypal' => [
			'driver'  => 'PayPal_Express',
			'options' => [
            'username'  => 'sb-lbajy18227647@business.example.com',
            'password'  => 'ELxVbJ91PhUaXGFSQeRj3YMeKlZDRhx5QFfK9u2Y6NUEsxM0_O4XFpPiTJzoH04kW3Cqn0cVjgznWEna4',
            'signature' => 'ATaE-_pglx_VW3IUmVYaLkw_aR1ukiue77UMEIMkna7TgLr4JYzS_hyjGTLwgCwBdYdZJtUjdo-bgv_u',
            'solutionType' => '',
            'landingPage'    => 'Billing', 'Login',
            'headerImageUrl' => '',
            'brandName' =>  'LeeYond',
            'testMode' => true
			]
		]
	]

];