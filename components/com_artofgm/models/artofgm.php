<?php
/**
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @copyright   Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.model');

/**
 * ArtofGM model.
 *
 * Based on JModelList.
 *
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @since       1.0
 */
class ArtofGMModelArtofGM extends JModel
{
	/**
	 * Internal memory based cache array of data.
	 *
	 * @var    array
	 * @since  1.0
	 */
	protected $cache = array();

	/**
	 * Context string for the model type.  This is used to handle uniqueness
	 * when dealing with the getStoreId() method and caching data structures.
	 *
	 * @var    string
	 * @since  1.0
	 */
	protected $context = null;

	/**
	 * An internal cache for the last query used.
	 *
	 * @var    JDatabaseQuery
	 * @since  1.0
	 */
	protected $query = array();

	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		// Guess the context as Option.ModelName.
		if (empty($this->context))
		{
			$this->context = strtolower($this->option . '.' . $this->getName());
		}
	}

	/**
	 * Method to get an array of data items.
	 *
	 * @return  mixed  An array of data items on success, false on failure.
	 *
	 * @since   1.0
	 */
	public function getItems()
	{
		// Get a storage key.
		$store = $this->getStoreId();

		// Try to load the data from internal storage.
		if (!empty($this->cache[$store]))
		{
			return $this->cache[$store];
		}

		require_once JPATH_SITE . '/components/com_artofgm/helpers/http.php';

		$config = JComponentHelper::getParams('com_artofgm');
		$server = $config->get('server');
		$listStart = (int) $this->getState('list.start');
		$listLimit = (int) $this->getState('list.limit');

		if (empty($server))
		{
			throw new Exception(JText::_('COM_ARTOFGM_SERVER_NOT_SET'));
		}

		// Optional variables.
		$q = urlencode($this->getState('list.q'));
		$as_q = urlencode($this->getState('list.as_q'));
		$as_epq = urlencode($this->getState('list.as_epq'));
		$as_oq = urlencode($this->getState('list.as_oq'));
		$as_eq = urlencode($this->getState('list.as_eq'));
		$as_ft = urlencode($this->getState('list.as_ft'));
		$as_filetype = urlencode($this->getState('list.as_filetype'));
		$as_occt = urlencode($this->getState('list.as_occt'));
		$as_dt = urlencode($this->getState('list.as_dt'));
		$as_sitesearch = urlencode($this->getState('list.as_sitesearch'));

		$sort = urlencode($this->getState('list.sort'));
		$filter = urlencode($this->getState('list.filter'));
		$lr = urlencode($this->getState('list.lr'));

		// Check if this is an advanced search.
		$adv = ($as_q
			|| $as_epq
			|| $as_oq
			|| $as_eq
			|| ($as_ft == 'e')
			|| $as_filetype
			|| $as_occt
//			|| ($as_dt == 'e')
			|| $as_sitesearch);

		$url = $server . '/search?' .
			($adv
				? (
					($as_q ? '&as_q=' . $as_q : '') .
					($as_epq ? '&as_epq=' . $as_epq : '') .
					($as_oq ? '&as_oq=' . $as_oq : '') .
					($as_eq ? '&as_eq=' . $as_eq : '') .
					($as_ft == 'e' || ($as_ft == 'i' && $as_filetype) ? '&as_ft=' . $as_ft . '&as_filetype=' . $as_filetype : '') .
					($as_occt ? '&as_occt=' . $as_occt : '') .
					($as_sitesearch ? '&as_dt=' . $as_dt . '&as_sitesearch=' . $as_sitesearch : '')
				)
				: '&q=' . $q) .
			'&output=' . $this->getState('list.output', 'xml') .
			'&site=' . $this->getState('list.site', 'default_collection') .
			'&client=' . $this->getState('list.client', 'default_frontend') .
			'&start=' . $listStart .
			'&num=' . $this->getState('list.limit') .
			'&oe=UTF8' .
			($sort ? '&sort=' . $sort : '') .
			($filter !== null ? '&filter=' . $filter : '') .
			($lr ? '&lr=' . $lr : '');

		// Get the content from the server.
		$content = ArtofGMHelperHttp::getUrl($url);

		if ($this->getState('debug'))
		{
			$this->setState('server.url', $url);
			$this->setState('server.response', $content);
		}

		// Parse the XML.
		try
		{
			$xml = new SimpleXMLElement($content);
		}
		catch (Exception $e)
		{
			JError::raiseError(
				500,
				$e->getMessage() .
				'<br />' . $url .
				'<br /><textarea cols="100" rows="10">' . htmlspecialchars($content) . '</textarea>'
			);
		}

		// Get the 'q', could come from advanced search.
		$this->setState('list.q', $xml->Q);

		// Count the <FI/> to check if results are filtered.
		$filtered = $xml->xpath('//FI');
		$this->setState('list.filtered', (boolean) count($filtered));

		// Get the NU next link
		$hasNext = $xml->xpath('//NB/NU');
		$this->setState('list.hasnext', (boolean) count($hasNext));

		// The estimated total number of results for the search.
		$magnitude = (int) $xml->RES->M;
		$this->setState('list.magnitude', $magnitude);

		// The index (1-based) of the first search result returned in this result set.
		$startNum = (int) $xml->RES['SN'];
		$this->setState('list.startnum', $startNum);

		// The index (1-based) of the last search result returned in this result set.
		$endNum = (int) $xml->RES['EN'];
		$this->setState('list.endnum', $endNum);

		if (!$hasNext)
		{
			$this->setTotal($endNum);
		}
		else
		{
			// The appliance returns no more than 1,000 results total for a single query.
			$this->setTotal(min(1000, $magnitude));
		}

		if ($xml->Spelling)
		{
			$this->setState('list.spelling', (string) $xml->Spelling->Suggestion['q']);
		}
		else
		{
			$this->setState('list.spelling', null);
		}

		$items = array();

		// Search and KeyMatch records
		$results = $xml->xpath('//GM');

		foreach ($results as $result)
		{
			$item = new stdClass;

			// Flag that this item is a KeyMatch result.
			$item->gm = true;

			// The URL of the KeyMatch result.
			$item->gl = (string) $result->GL;

			// The description of the KeyMatch result.
			$item->gd = (string) $result->GD;

			$items[] = $item;
		}

		// Search the results records
		$results = $xml->xpath('//R');

		foreach ($results as $result)
		{
			$item = new stdClass;

			// Flag that this item is not a KeyMatch result.
			$item->gm = false;

			// The index of the search result.
			$item->n = (int) $result['N'];

			// The recommended indentation level of the results.
			$item->indent = (int) $result['L'];

			// The index of the search result.
			$item->mime = (string) $result['MIME'];

			// The URL of the search result.
			$item->url = (string) $result->U;

			//The URL encoded version of the URL that is in the U parameter
			$item->urle = (string) $result->UE;

			// The title of the search result.
			$item->title = (string) $result->T;

			// Provides a general rating of the relevance of the search result.
			$item->relevance = (string) $result->RK;

			// The snippet for the search result.
			$item->snippet = (string) $result->S;

			// The snippet for the search result.
			$item->date = (string) $result->CRAWLDATE;

			// The snippet for the search result.
			$item->size = (string) $result->HAS->C['SZ'];

			$items[] = $item;
		}

		// Add the items to the internal cache.
		$this->cache[$store] = $items;

		return $this->cache[$store];
	}

	/**
	 * Method to get a JPagination object for the data set.
	 *
	 * @return  JPagination  A JPagination object for the data set.
	 *
	 * @since   1.0
	 */
	public function getPagination()
	{
		// Get a storage key.
		$store = $this->getStoreId('getPagination');

		// Try to load the data from internal storage.
		if (!empty($this->cache[$store]))
		{
			return $this->cache[$store];
		}

		// Create the pagination object.
		jimport('joomla.html.pagination');
		$limit = (int) $this->getState('list.limit') - (int) $this->getState('list.links');
		$page = new JPagination($this->getTotal(), (int) $this->getState('list.start'), $limit);

		// Add the object to the internal cache.
		$this->cache[$store] = $page;

		return $this->cache[$store];
	}

	/**
	 * Method to get the params for this model.
	 *
	 * @return  JRegistry
	 *
	 * @since   1.0
	 */
	public function getParams()
	{
		// Initialise variables.
		$params = JFactory::getApplication()->getParams();

		return $params;
	}

	/**
	 * Method to get a store id based on the model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  An identifier string to generate the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   1.0
	 */
	protected function getStoreId($id = '')
	{
		// Add the list state to the store id.
		$id .= ':' . $this->getState('list.start');
		$id .= ':' . $this->getState('list.limit');
		$id .= ':' . $this->getState('list.ordering');
		$id .= ':' . $this->getState('list.direction');

		return md5($this->context . ':' . $id);
	}

	/**
	 * Method to get the total number of items for the data set.
	 *
	 * @return  integer  The total number of items available in the data set.
	 *
	 * @since   1.0
	 */
	public function getTotal()
	{
		// Get a storage key.
		$store = $this->getStoreId('getTotal');

		// Try to load the data from internal storage.
		if (!empty($this->cache[$store]))
		{
			return $this->cache[$store];
		}

		return 0;
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// If the context is set, assume that stateful lists are used.
		if ($this->context)
		{
			$app = JFactory::getApplication();
			$config = JComponentHelper::getParams('com_artofgm');

			$this->setState('list.q', JRequest::getVar('q'));
			$this->setState('list.as_q', JRequest::getVar('as_q'));
			$this->setState('list.as_epq', JRequest::getVar('as_epq'));
			$this->setState('list.as_oq', JRequest::getVar('as_oq'));
			$this->setState('list.as_eq', JRequest::getVar('as_eq'));
			$this->setState('list.as_ft', JRequest::getWord('as_ft'));
			$this->setState('list.as_filetype', JRequest::getVar('as_filetype'));
			$this->setState('list.as_occt', JRequest::getWord('as_occt'));
			$this->setState('list.as_lq', JRequest::getVar('as_lq'));
			$this->setState('list.as_dt', JRequest::getWord('as_dt'));
			$this->setState('list.as_sitesearch', JRequest::getCmd('as_sitesearch'));
			$this->setState('list.sort', JRequest::getWord('sort'));
			$this->setState('list.filter', JRequest::getVar('filter', 1));

			$this->setState('list.site', JRequest::getVar('site', $config->get('site')));
			$this->setState('list.client', JRequest::getVar('client', $config->get('client')));

			// Pagination values.

			$value = JRequest::getInt('limit', $app->getCfg('list_limit'));
			$limit = $value;
			$this->setState('list.limit', $limit);

			$value = JRequest::getInt('limitstart', 0);
			$limitstart = ($limit != 0 ? (floor($value / $limit) * $limit) : 0);
			$this->setState('list.start', $limitstart);

//			$value = $app->getUserStateFromRequest($this->context.'.ordercol', 'filter_order');
//			$this->setState('list.ordering', $value);
//
//			$value = $app->getUserStateFromRequest($this->context.'.orderdirn', 'filter_order_Dir');
//			$this->setState('list.direction', $value);
		}
		else
		{
			$this->setState('list.start', 0);
			$this->state->set('list.limit', 0);
		}
	}

	/**
	 * Method to set the total number of items for the data set.
	 *
	 * @param   integer  $total  The total number of search records.
	 *
	 * @return  integer  The total number of items available in the data set.
	 *
	 * @since  1.0
	 */
	public function setTotal($total)
	{
		// Get a storage key.
		$store = $this->getStoreId('getTotal');

		$this->cache[$store] = $total;
	}
}
