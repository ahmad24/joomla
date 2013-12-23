<?php
defined('_JEXEC') or die;
//ComponentnameHelper
class FolioHelper
{
	public static function getActions($categoryId = 0)
	{
		$user = JFactory::getUser();
		$result = new JObject;
		if (empty($categoryId))
		{
			$assetName = 'com_folio';
			$level = 'component';
		}
		else
		{
			$assetName = 'com_folio.category.'.(int) $categoryId;
			$level = 'category';
		}
		$actions = JAccess::getActions('com_folio', $level);
		foreach ($actions as $action)
		{
			$result->set($action->name, $user->authorise($action->name, $assetName));
		}
		return $result;
	}
	public static function addSubmenu($vName = 'folios')
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_FOLIO_SUBMENU_FOLIOS'),
			'index.php?option=com_folio&view=folios',
			$vName == 'folios'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_FOLIO_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&extension=com_folio',
			$vName == 'categories'
		);
		if ($vName == 'categories')
		{
			JToolbarHelper::title(
				JText::sprintf(
					'COM_CATEGORIES_CATEGORIES_TITLE',
					JText::_('com_folio')
				),'folios-categories'
			);
		}
		JHtmlSidebar::addEntry(
			JText::_('COM_FOLIO_SUBMENU_PREVIEW'),
			'index.php?option=com_folio&view=preview',
			$vName == 'preview'
		);
	}
}