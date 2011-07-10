<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Twig loader.
 *
 * @package  Kotwig
 * @author   John Heathco <jheathco@gmail.com>
 */
class Kohana_Kotwig {

	/**
	 * @var  object  Kotwig instance
	 */
	public static $instance;
	
	/**
	 * @var  Twig_Environment
	 */
	public $twig;

	/**
	 * @var  object  Kotwig configuration (Kohana_Config object)
	 */
	public $config;

	public static function instance()
	{
		if ( ! Kotwig::$instance)
		{
			Kotwig::$instance = new Kotwig;
			
			// Load Twig configuration
			Kotwig::$instance->config = Kohana::config('kotwig');

			// Create the the loader
			$loader = new Twig_Loader_Filesystem(Kotwig::$instance->config->templates);

			// Set up Twig
			Kotwig::$instance->twig = new Twig_Environment($loader, Kotwig::$instance->config->environment);

			foreach (Kotwig::$instance->config->extensions as $extension)
			{
				// Load extensions
				Kotwig::$instance->twig->addExtension(new $extension);
			}
		}

		return Kotwig::$instance;
	}

	final private function __construct()
	{
		// This is a singleton class
	}

} // End Kotwig
