<?php
defined('_JEXEC') or die;
class FolioViewPreview extends JViewLegacy
{
	protected $items;
	public function display($tpl = null)
	{
		$this->items = $this->get('Items');
		// the active item on the sidebar menu should be preview:
		FolioHelper::addSubmenu('preview');
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		$this->addToolbar();
		$j3css = <<<ENDCSS
		div#toolbar div#toolbar-back button.btn span.icon-back::before {
			content: "î€ˆ";
		}
		.folio_title{
			color: #555555;
			font-family: 'Titillium Maps',Arial;
			font-size: 14pt;
		}
		.myfolio{
			padding-bottom: 20px;
			float: left;
			padding-right: 20px;
		}
		.folio_element{
			width: 150px;
			padding-top: 2px;
		}
ENDCSS;
		JFactory::getDocument()->addStyleDeclaration($j3css);
		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}
	protected function addToolbar()
	{
		$state = $this->get('State');
		$canDo = FolioHelper::getActions();
		$bar = JToolBar::getInstance('toolbar');
		JToolbarHelper::title(JText::_('COM_FOLIO_MANAGER_FOLIOS'), '');
		JToolbarHelper::back('COM_FOLIO_BUTTON_BACK','index.php?option=com_folio');
	}
}