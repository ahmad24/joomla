<?php
defined('_JEXEC') or die;
class FolioControllerPreview extends JControllerAdmin
{
	public function getModel($name = 'Preview', $prefix = 'FolioModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}