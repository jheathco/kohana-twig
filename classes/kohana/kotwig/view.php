<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Twig view.
 *
 * @package  Kotwig
 * @author   John Heathco <jheathco@gmail.com>
 */
class Kohana_Kotwig_View extends View {

	public static function factory($file = NULL, array $data = NULL)
	{
		return new Kotwig_View($file, $data);
	}
	
	protected static function capture($kohana_view_filename, array $kohana_view_data)
	{
		return Kotwig::instance()
			->twig
			->loadTemplate($kohana_view_filename)
			->render(array_merge($kohana_view_data, View::$_global_data));
	}	

	public function set_filename($file)
	{
		$ext = Kotwig::instance()->config['suffix'];
		
		if ($ext === NULL)
		{
			$this->_file = $file;
		}
		else
		{
			$this->_file = $file.'.'.$ext;
		}

		return $this;
	}
	
	public function render($file = NULL)
	{
		if ($file !== NULL)
		{
			$this->set_filename($file);
		}

		if (empty($this->_file))
		{
			throw new Kohana_View_Exception('You must set the file to use within your view before rendering');
		}

		// Combine local and global data and capture the output
		return Kotwig_View::capture($this->_file, $this->_data);
	}
}