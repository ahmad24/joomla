<?php
defined('_JEXEC') or die;
//ComponentnameViewViewname
class FolioViewFolio extends JViewLegacy
{
	protected $item;
	protected $form;
	public function display($tpl = null)
	{
		$this->item = $this->get('Item');
		$this->form = $this->get('Form');
		//we have some error checking here. An example of 
		//when an error may occur is if one of the fields is missing from our database table, 
		//which could happen if the software is upgraded to a newer version and the update 
		//script hasn't added all the new fields.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		$this->addToolbar();
		parent::display($tpl);
	}
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);
		JToolbarHelper::title(JText::_('COM_FOLIO_MANAGER_FOLIO'), '');
		JToolbarHelper::save('folio.save');
		if (empty($this->item->id))
		{
			JToolbarHelper::cancel('folio.cancel');
		}
		else
		{
			JToolbarHelper::cancel('folio.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}