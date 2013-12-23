<?php
defined('_JEXEC') or die;
if (!JFactory::getUser()->authorise('core.manage', 'com_folio'))
{
return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}
// This name will be used as the prefix for all the classes; for example, FolioViewFoliosor FolioHelper.
$controller = JControllerLegacy::getInstance('Folio');

//Since the component has more than a single page, we have a taskinput that determines what the component is going to do next.
$controller->execute(JFactory::getApplication()->input->get('task'));// '' | folio.edit | folio.add
$controller->redirect();