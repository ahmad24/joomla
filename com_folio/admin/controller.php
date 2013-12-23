<?php
defined('_JEXEC') or die;
//So we need to create the controllers for this component. There is 
//a main controller file for the component, and each view will have its own controller
class FolioController extends JControllerLegacy
{
	protected $default_view = 'folios';
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/folio.php';
		$view = $this->input->get('view', 'folios');
		$layout = $this->input->get('layout', 'default');
		$id = $this->input->getInt('id');
		if ($view == 'folio' && $layout == 'edit' && !$this->checkEditId('com_folio.edit.folio', $id))
		{
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_folio&view=folios', false));
			return false;
		}
		parent::display();
		return $this;
	}
}