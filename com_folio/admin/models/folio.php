<?php
defined('_JEXEC') or die;
class FolioModelFolio extends JModelAdmin
{
	protected $text_prefix = 'COM_FOLIO';//which is just the name of the component.
	//$prefix = 'FolioTable' : ComponentnameTable
	public function getTable($type = 'Folio', $prefix = 'FolioTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	//The getFormfunction is used to get the form based on our XML file,where we defined all the fields
	public function getForm($data = array(), $loadData = true)
	{
		$app = JFactory::getApplication();

		$form = $this->loadForm('com_folio.folio', 'folio', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}
		return $form;
	}
	//loads the data into the form
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_folio.edit.folio.data', array());
		if (empty($data))
		{
			$data = $this->getItem();
		}
		return $data;
	}
	protected function prepareTable($table)
	{
		$table->title = htmlspecialchars_decode($table->title, ENT_QUOTES);
	}
}