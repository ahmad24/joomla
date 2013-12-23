Creating another view

Create the folio.phpfile under /components/com_folio/controllers/and add the following code:
<?php
defined('_JEXEC') or die;
class FolioControllerFolio extends JControllerForm
{
}


---------------
Now, create themodel file at /components/com_folio/models/folio.php, and 
add the following code. This code is pretty much the same as the folios model; 
however, we are using idinstead of catidto select the item. The differences are 
highlighted as follows:
<?php
defined('_JEXEC') or die;
class FolioModelFolio extends JModelList
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
				'image', 'a.image',
				'url', 'a.url',
				'phone', 'a.phone',
				'description', 'a.description',
				'ordering', 'a.ordering', 'a.catid'
			);
		}
		
		parent::__construct($config);
	}
	protected function populateState($ordering = null, $direction = null)
	{
		$id = JRequest::getInt('id');
		$this->setState('id', $id);
	}
	protected function getListQuery()
	{
		$db= $this->getDbo();
		$query = $db->getQuery(true);
		$query->select(
			$this->getState(
				'list.select',
				'a.id, a.title,' .
				'a.state, a.company,' .
				'a.image, a.url, a.ordering,' .
				'a.phone, a.description, a.catid'
			)
		);
		$query->from($db->quoteName('#__folio').' AS a');
		$query->where('(a.state IN (0, 1))');
		if ($id = $this->getState('id'))
		{
			$query->where('a.id = '.(int) $id);
		}
		return $query;
	}
}


------------------------------------
Next, we need to create the actual view, so create a file named view.html.php under 
/components/com_folio/views/folio/, which is the same as the folios view but 
with a different class name:

<?php
defined('_JEXEC') or die;
class FolioViewFolio extends JViewLegacy
{
	protected $items;
	public function display($tpl = null)
	{
		$this->items = $this->get('Items');
		$app = JFactory::getApplication();
		$params = $app->getParams();
		$this->assignRef( 'params', $params );
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		parent::display($tpl);
	}
}

-----------------------------------------

Create theviewfile named default.phpunder /components/com_folio/views/
folio/tmpl/with the following code:

<?php defined('_JEXEC') or die; ?>
<div class="mypreview">
	<?php foreach ($this->items as $item) : ?>
	<div class="myfolio">
		<div class="folio_title">
			<?php echo $item->title; ?>
		</div>
		<div class="folio_element_full">
			<a href="<?php echo $item->url; ?>" target="_blank" rel="nofollow">
			<img src="<?php echo $item->image; ?>">
			</a>
		</div>
		<div class="folio_element_full">
			<strong><?php echo JText::_('COM_FOLIO_COMPANY');?></strong><?php echo $item->company; ?>
		</div>
		<div class="folio_element_full">
			<strong><?php echo JText::_('COM_FOLIO_PHONE');?></strong><?php echo $item->phone; ?>
		</div>
		<div class="folio_element_full">
			<?php echo $item->description; ?>
		</div>
	</div>
	<?php endforeach; ?>
</div>




/components/com_folio/views/folios/tmpl/default.php and make the highlighted changes:

<a href="<?php echo JRoute::_('index.php?option=com_folio&view=folio&id='.(int)$item->id); ?>">
	<?php echo $item->title; ?>
</a>