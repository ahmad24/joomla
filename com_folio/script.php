<?php
defined('_JEXEC') or die;
class com_folioInstallerScript
{
	function install($parent) 
	{
		$parent->getParent()->setRedirectURL('index.php?option=com_folio');
	}
	function uninstall($parent) 
	{
		echo '<p>' . JText::_('COM_FOLIO_UNINSTALL_TEXT') . '</p>';
	}
	function update($parent) 
	{
		echo '<p>' . JText::_('COM_FOLIO_UPDATE_TEXT') . '</p>';
	}
	function preflight($type, $parent) 
	{
		echo '<p>' . JText::_('COM_FOLIO_PREFLIGHT_' . $type . '_TEXT') . '</p>';
	}
	function postflight($type, $parent) 
	{
		echo '<p>' . JText::_('COM_FOLIO_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
	}
}