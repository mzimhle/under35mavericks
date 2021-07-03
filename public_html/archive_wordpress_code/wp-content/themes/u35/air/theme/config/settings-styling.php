<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: 
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'styling-advanced',
		'title'	=> 'Advanced Styling'
	),
	array(
		'id'	=> 'styling-color',
		'title'	=> 'Theme Color',
	),
	array(
		'id'	=> 'styling-body',
		'title'	=> 'Body'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Advanced Styling
/*-------------------------------------------------------*/

// Enable advanced styling
$fields[] = array(
	'id'		=> 'generated-css',
	'label'		=> 'Enable to use',
	'section'	=> 'styling-advanced',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'generated-css' => '<strong>Enable styling options</strong> <small>(style-generated.css)</small>'
	)
);

/* Theme Color
/*-------------------------------------------------------*/

// Color 1
$fields[] = array(
	'id'			=> 'styling-color-1',
	'label'			=> 'Main Color',
	'section'		=> 'styling-color',
	'type'			=> 'colorpicker',
	'placeholder'	=> '0088b2'
);

// Color 2
$fields[] = array(
	'id'			=> 'styling-color-2',
	'label'			=> 'Secondary Color',
	'section'		=> 'styling-color',
	'type'			=> 'colorpicker',
	'placeholder'	=> '83ad02'
);

/* Body
/*-------------------------------------------------------*/

// Body BG Color
$fields[] = array(
	'id'			=> 'styling-body-bg-color',
	'label'			=> 'Background Color',
	'section'		=> 'styling-body',
	'type'			=> 'colorpicker',
	'placeholder'	=> ''
);

// Body BG Image
$fields[] = array(
	'id'		=> 'styling-body-bg-image',
	'label'		=> 'Background Image',
	'section'	=> 'styling-body',
	'type'		=> 'image'
);

// Body BG Image Repeat
$fields[] = array(
	'id'		=> 'styling-body-bg-image-repeat',
	'label'		=> 'Background Image Repeat',
	'section'	=> 'styling-body',
	'type'		=> 'select',
	'choices'	=> array(
		'repeat'	=> 'repeat',
		'no-repeat' => 'no-repeat',
		'repeat-x'	=> 'repeat-x',
		'repeat-y'	=> 'repeat-y'
	)
);
