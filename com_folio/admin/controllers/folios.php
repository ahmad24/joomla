<?php
defined('_JEXEC') or die;
// ComponentnameControllerViewname,
class FolioControllerFolios extends JControllerAdmin
{
	public function getModel($name = 'Folio', $prefix = 
	'FolioModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}