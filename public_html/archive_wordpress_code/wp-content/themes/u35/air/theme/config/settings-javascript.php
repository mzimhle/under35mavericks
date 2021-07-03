<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: Javascript
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'js-disable',
		'title'	=> 'Disable Scripts'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Disable scripts
/*-------------------------------------------------------*/

// Disable jquery.jplayer.js
$fields[] = array(
	'id'		=> 'js-disable',
	'label'		=> 'Disable',
	'section'	=> 'js-disable',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'js-disable-jplayer' => 'jquery.jplayer.min.js'
	),
);
