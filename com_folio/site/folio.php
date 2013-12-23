<?php
defined('_JEXEC') or die;

$document = JFactory::getDocument();
$cssFile = "./media/com_folio/css/site.stylesheet.css";
$document->addStyleSheet($cssFile);
// This name will be used as the prefix for all the classes; for example, FolioViewFoliosor FolioHelper.
$controller = JControllerLegacy::getInstance('Folio');

//Since the component has more than a single page, we have a taskinput that determines what the component is going to do next.
$controller->execute(JFactory::getApplication()->input->get('task'));// '' | folio.edit | folio.add
$controller->redirect();