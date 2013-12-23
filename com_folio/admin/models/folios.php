<?php
defined('_JEXEC') or die;
// ComponentnameModelViewname
class FolioModelFolios extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'title', 'a.title',
				'state', 'a.state',
				'company', 'a.company',
				'publish_up', 'a.publish_up',
				'publish_down', 'a.publish_down',
				'ordering', 'a.ordering'//------------------
			);


		}
		parent::__construct($config);
	}
	


	protected function getListQuery()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select(
		/*
		The getStatefunction in the query checks to see if the state variable called list.
		selecthas been defined, and if it has not then it just selects the fields we have 
		defined here, in this case idand title. This adds some flexibility to the query, 
		as potentially a developer could override the fields selected by setting a custom 
		statement in the state variable, but that is an advanced topic which is out of scope
		for this book
		*/
			$this->getState(
				'list.select',
				'a.id, a.title,' .
				'a.state, a.company,' .
				'a.publish_up, a.publish_down,' .
				'a.ordering'
			)
		);
		$query->from($db->quoteName('#__folio').' AS a');
		$published = $this->getState('filter.state');
		if (is_numeric($published))
		{
			$query->where('a.state = '.(int) $published);
		} elseif ($published === '')
		{
			$query->where('(a.state IN (0, 1))');
		}
		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = '.(int) substr($search, 3));
			} else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('(a.title LIKE '.$search.' OR a.company LIKE '.$search.')');
			}
		}

		
		$orderCol = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');
		$query->order($db->escape($orderCol.' '.$orderDirn));
		return $query;
	}
	protected function populateState($ordering = null, $direction = null)
	{
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

	
		$published = $this->getUserStateFromRequest($this->context.'.filter.state', 'filter_state', '', 'string');
		$this->setState('filter.state', $published);
		
		parent::populateState('a.ordering', 'asc');

	}


	public function saveOrderAjax()
	{
		$input = JFactory::getApplication()->input;
		$pks = $input->post->get('cid', array(), 'array');
		$order = $input->post->get('order', array(), 'array');
		JArrayHelper::toInteger($pks);
		JArrayHelper::toInteger($order);
		$model = $this->getModel();
		$return = $model->saveorder($pks, $order);
		if ($return)
		{
			echo "1";
		}
		JFactory::getApplication()->close();
	}




	
}