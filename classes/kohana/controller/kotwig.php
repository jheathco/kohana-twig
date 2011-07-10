<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Twig template controller
 *
 * @package    Kotwig
 * @author     John Heathco <jheathco@gmail.com>
 */
abstract class Kohana_Controller_Kotwig extends Controller {

	/**
	 * @var boolean  Auto-render template after controller method returns
	 */
	public $auto_render = TRUE;

	/**
	 * @var Kotwig_View  Kohana twig template
	 */
	public $template = NULL;
	
	public function before()
	{
		if ($this->auto_render)
		{
			// Auto-generate template filename ('index' method called on Controller_Admin_Users looks for 'admin/users/index')
			if ($this->template === NULL)
			{
				$this->template = $this->request->controller().'/'.$this->request->action();

				if ($this->request->directory())
				{
					// Preprend directory if needed
					$this->template = $this->request->directory().'/'.$this->template;
				}
			}
			
			$this->template = Kotwig_View::factory($this->template);
		}
	}
	
	public function after()
	{		
		if ($this->auto_render)
		{
			// Auto-render the template
			$this->response->body($this->template->render());
		}
	}

} // End Controller_Kotwig
