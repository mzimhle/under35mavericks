<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: Blog
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'blog-general',
		'title'	=> 'General'
	),
	array(
		'id'	=> 'blog-headings',
		'title'	=> 'Headings',
	),
	array(
		'id'	=> 'blog-featured-slider',
		'title'	=> 'Home: Featured Slider'
	),
	array(
		'id'	=> 'blog-highlights',
		'title'	=> 'Home: Highlights'
	),
	array(
		'id'	=> 'blog-home-widgets',
		'title'	=> 'Home: Widget Columns'
	),
	array(
		'id'	=> 'blog-post-details',
		'title'	=> 'Post Details'
	),
	array(
		'id'	=> 'blog-share-links',
		'title'	=> 'Single: Social Share Links'
	),
	array(
		'id'	=> 'blog-author-block',
		'title'	=> 'Single: Author Block'
	),
	array(
		'id'	=> 'blog-single-postnav',
		'title'	=> 'Single: Post Navigation'
	),
	array(
		'id'	=> 'blog-newsflash',
		'title'	=> 'Newsflash'
	),
	array(
		'id'	=> 'blog-comments',
		'title'	=> 'Comments'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* General
/*-------------------------------------------------------*/

// Read More
$fields[] = array(
	'id'			=> 'read-more',
	'label'			=> 'Read More Text',
	'section'		=> 'blog-general',
	'type'			=> 'text',
	'default'		=> 'Read more'
);

// Excerpt Read More Link
$fields[] = array(
	'id'		=> 'excerpt-more-link-enable',
	'label'		=> 'Read More Link',
	'section'	=> 'blog-general',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'excerpt-more-link-enable' => 'Enable read more link on excerpts'
	),
	'default'	=> array(
		'excerpt-more-link-enable' => '1'
	)
);

// Excerpt More
$fields[] = array(
	'id'			=> 'excerpt-more',
	'label'			=> 'Excerpt Ending',
	'section'		=> 'blog-general',
	'type'			=> 'text',
	'class'			=> 'small-text',
	'default'		=> '[...]'
);

// Excerpt Length
$fields[] = array(
	'id'			=> 'excerpt-length',
	'label'			=> 'Excerpt Length <small>(words)</small>',
	'section'		=> 'blog-general',
	'type'			=> 'text',
	'class'			=> 'small-text',
	'default'		=> '30',
);

/* Headings
/*-------------------------------------------------------*/

// Heading
$fields[] = array(
	'id'			=> 'blog-heading',
	'label'			=> 'Heading',
	'section'		=> 'blog-headings',
	'type'			=> 'text',
	'placeholder'	=> ''
);

// Subheading
$fields[] = array(
	'id'			=> 'blog-subheading',
	'label'			=> 'Subheading',
	'section'		=> 'blog-headings',
	'type'			=> 'text',
	'placeholder'	=> ''
);

/* Home : Featured Slider
/*-------------------------------------------------------*/

// Heading
$fields[] = array(
	'id'			=> 'featured-heading',
	'label'			=> 'Heading',
	'section'		=> 'blog-featured-slider',
	'type'			=> 'text'
);

// Subheading
$fields[] = array(
	'id'			=> 'featured-subheading',
	'label'			=> 'Subheading',
	'section'		=> 'blog-featured-slider',
	'type'			=> 'text'
);

// Enable
$fields[] = array(
	'id'		=> 'featured-slider-enable',
	'label'		=> 'Enable',
	'section'	=> 'blog-featured-slider',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'featured-slider-enable' 	=> 'Enable featured posts',
		'featured-slider-include'	=> 'Include featured posts in content area',
	),
	'default'	=> array(
		'featured-slider-enable' => '1',
	)
);

// Category
$fields[] = array(
	'id'		=> 'featured-slider-category',
	'label'		=> 'Category <small>(ordered by date)</small>',
	'section'	=> 'blog-featured-slider',
	'type'		=> 'category-dropdown'
);

// Number
$fields[] = array(
	'id'		=> 'featured-slider-number',
	'label'		=> 'Number of Posts <small>(max)</small>',
	'section'	=> 'blog-featured-slider',
	'type'		=> 'select',
	'choices'	=> array_diff(range(0,10),range(0,0)),
	'default'	=> '4'
);

/* Home : Highlights
/*-------------------------------------------------------*/

// Enable
$fields[] = array(
	'id'		=> 'highlights-enable',
	'label'		=> 'Enable',
	'section'	=> 'blog-highlights',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'highlights-enable' 	=> 'Enable highlight posts',
		'highlights-include'	=> 'Include highlight posts in content area',
	),
	'default'	=> array(
		'highlights-enable' => '1',
	)
);

// Category
$fields[] = array(
	'id'		=> 'highlights-category',
	'label'		=> 'Category <small>(ordered by date)</small>',
	'section'	=> 'blog-highlights',
	'type'		=> 'category-dropdown'
);

/* Home : Widget Columns
/*-------------------------------------------------------*/

// Widget Columns
$fields[] = array(
	'id'		=> 'home-widget-columns',
	'label'		=> 'Enable',
	'section'	=> 'blog-home-widgets',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'home-widgets-top'		=> 'Show 2 additional widget columns <strong>above</strong> recent posts',
		'home-widgets-bottom'	=> 'Show 2 additional widget columns <strong>below</strong> recent posts'
	)
);

// Heading
$fields[] = array(
	'id'			=> 'home-widgets-top-title',
	'label'			=> 'Heading <small>(top)</small>',
	'section'		=> 'blog-home-widgets',
	'type'			=> 'text'
);
$fields[] = array(
	'id'			=> 'home-widgets-bottom-title',
	'label'			=> 'Heading <small>(bottom)</small>',
	'section'		=> 'blog-home-widgets',
	'type'			=> 'text'
);

/* Post Details
/*-------------------------------------------------------*/

// Hide Post Details (Home, Archive, Search)
$fields[] = array(
	'id'		=> 'post-hide-fields',
	'label'		=> 'Home, Archive, Search',
	'section'	=> 'blog-post-details',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'post-hide-date'		=> 'Hide post date',
		'post-hide-categories'	=> 'Hide post categories',
		'post-hide-comments'	=> 'Hide post comment count',
	)
);

// Hide Post Details (Single)
$fields[] = array(
	'id'		=> 'post-hide-fields-single',
	'label'		=> 'Single Post',
	'section'	=> 'blog-post-details',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'post-hide-author-single'		=> 'Hide post author',
		'post-hide-date-single'			=> 'Hide post date',
		'post-hide-categories-single'	=> 'Hide post categories',
		'post-hide-tags-single'			=> 'Hide post tags',
		'post-hide-comments-single'		=> 'Hide post comment count',
	)
);

// Hide Detailed Date
$fields[] = array(
	'id'		=> 'post-hide-detailed-date',
	'label'		=> 'Detailed Date',
	'section'	=> 'blog-post-details',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'post-hide-detailed-date'	=> 'Hide detailed date <small>(at XX:XX am/pm)</small>',
	),
	'default'	=> array(
		'post-hide-detailed-date'	=> '1',
	)
);

/* Single : Social Share Block
/*-------------------------------------------------------*/

// Twitter username
$fields[] = array(
	'id'			=> 'twitter-username',
	'label'			=> 'Twitter Username',
	'section'		=> 'blog-share-links',
	'type'			=> 'text'
);

// Disable Social Share
$fields[] = array(
	'id'		=> 'single-share',
	'label'		=> 'Disable',
	'section'	=> 'blog-share-links',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'single-share-disable' => 'Disable twitter, facebook & google plus share links in articles'
	)
);

/* Single : Author Block
/*-------------------------------------------------------*/

// Enable Author Block
$fields[] = array(
	'id'		=> 'post-enable-author-block',
	'label'		=> 'Enable',
	'section'	=> 'blog-author-block',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'post-enable-author-block' => 'Enable author block'
	)
);

/* Single : Postnav
/*-------------------------------------------------------*/

// Enable Author Block
$fields[] = array(
	'id'		=> 'single-postnav',
	'label'		=> 'Select Location',
	'section'	=> 'blog-single-postnav',
	'type'		=> 'radio',
	'choices'	=> array(
		'0'	=> 'Hide',
		'1'	=> 'Display below article',
		'2'	=> 'Display in sidebar'
	),
	'default'	=> '2'
);

/* Newsflash
/*-------------------------------------------------------*/

// Enable
$fields[] = array(
	'id'		=> 'newsflash-enable',
	'label'		=> 'Enable',
	'section'	=> 'blog-newsflash',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'newsflash-enable-home' 	=> 'For blog home',
		'newsflash-enable-single' 	=> 'For blog single',
		'newsflash-enable-archive' 	=> 'For blog archives'
	),
	'default'	=> array(
		'newsflash-enable-home' => '1'
	)
);

// Show
$fields[] = array(
	'id'		=> 'newsflash-display',
	'label'		=> 'Display the following',
	'section'	=> 'blog-newsflash',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'newsflash-most-discussed'	=> 'Most popular',
		'newsflash-most-recent'		=> 'Most recent posts',
		'newsflash-recent-comments'	=> 'Recent comments'
	),
	'default'	=> array(
		'newsflash-most-discussed'	=> '1',
		'newsflash-most-recent'		=> '1',
		'newsflash-recent-comments'	=> '1'
	)
);

// Most Popular
$fields[] = array(
	'id'		=> 'newsflash-most-popular',
	'label'		=> 'Most Popular',
	'section'	=> 'blog-newsflash',
	'type'		=> 'radio',
	'choices'	=> array(
		'0'		=> 'All time',
		'month'	=> 'This month',
		'week'	=> 'This week',
		'day'	=> 'Past 24 hours',
	),
	'default'	=> '0'
);


/* Comments
/*-------------------------------------------------------*/

// Comments Form Location
$fields[] = array(
	'id'		=> 'comments-form-location',
	'label'		=> 'Comments Form Location',
	'section'	=> 'blog-comments',
	'type'		=> 'radio',
	'choices'	=> array(
		'top'		=> 'Display above comments',
		'bottom'	=> 'Display below comments',
	),
	'default'	=> 'bottom'
);

// Disable Comments
$fields[] = array(
	'id'		=> 'disable-comments',
	'label'		=> 'Disable Comments',
	'section'	=> 'blog-comments',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'comments-pages-disable' => 'Disable comments on pages',
		'comments-posts-disable' => 'Disable comments on posts'
	),
	'default'	=> array(
		'comments-pages-disable' => '1'
	)
);
