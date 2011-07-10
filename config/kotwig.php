<?php

return array
(
	'environment' => array
	(
		'debug'               => FALSE,
		'trim_blocks'         => FALSE,
		'charset'             => 'utf-8',
		'base_template_class' => 'Twig_Template',
		'cache'               => APPPATH.'cache/twig',
		'auto_reload'         => TRUE,
		'strict_variables'    => FALSE,
		'autoescape'          => TRUE,
		'optimizations'       => -1,
	),
	'extensions' => array
	(
		// List extension class names
	),
	'templates'      => APPPATH.'views',
	'suffix'         => 'twig',
);