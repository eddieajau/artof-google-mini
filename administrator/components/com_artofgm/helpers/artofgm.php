<?php
/**
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 * @copyright	Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

/**
 * ArtofGM display helper.
 *
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 * @since		1.0
 */
class ArtofGMHelper
{
	/**
	 * Get a list of file type options
	 *
	 * @return	array	An array of elements suitable to use in the JHtml select list API.
	 * @since	1.0
	 */
	public static function getFiletypeOptions()
	{
		$ftOptions = array(
			JHtml::_('select.option', 'pdf',	JText::_('COM_ARTOFGM_OPTION_FORMAT_PDF')),
			JHtml::_('select.option', 'ps',		JText::_('COM_ARTOFGM_OPTION_FORMAT_PS')),
			JHtml::_('select.option', 'doc',	JText::_('COM_ARTOFGM_OPTION_FORMAT_DOC')),
			JHtml::_('select.option', 'xls',	JText::_('COM_ARTOFGM_OPTION_FORMAT_XLS')),
			JHtml::_('select.option', 'ppt',	JText::_('COM_ARTOFGM_OPTION_FORMAT_PPT')),
			JHtml::_('select.option', 'rtf',	JText::_('COM_ARTOFGM_OPTION_FORMAT_RTF')),
		);

		return $ftOptions;
	}

	/**
	 * Get a list of include/exclude options
	 *
	 * @return	array	An array of elements suitable to use in the JHtml select list API.
	 * @since	1.0
	 */
	public static function getInclExclOptions()
	{
		$ieOptions = array(
			JHtml::_('select.option', 'i', JText::_('COM_ARTOFGM_OPTION_ONLY')),
			JHtml::_('select.option', 'e', JText::_('COM_ARTOFGM_OPTION_DONT')),
		);

		return $ieOptions;
	}

	/**
	 * Get the list of language options.
	 *
	 * @return	array	An array of elements suitable to use in the JHtml select list API.
	 * @since	1.0
	 */
	public static function getLanguageOptions()
	{
		$lrOptions = array(
			JHtml::_('select.option', 'lang_ar', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_AR')),
			JHtml::_('select.option', 'lang_zh-CN', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_ZH_CN')),
			JHtml::_('select.option', 'lang_zh-TW', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_ZH_TW')),
			JHtml::_('select.option', 'lang_cs', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_CS')),
			JHtml::_('select.option', 'lang_da', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_DA')),
			JHtml::_('select.option', 'lang_nl', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_NL')),
			JHtml::_('select.option', 'lang_en', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_EN')),
			JHtml::_('select.option', 'lang_et', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_ET')),
			JHtml::_('select.option', 'lang_fi', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_FI')),
			JHtml::_('select.option', 'lang_fr', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_FR')),
			JHtml::_('select.option', 'lang_de', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_DE')),
			JHtml::_('select.option', 'lang_el', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_EL')),
			JHtml::_('select.option', 'lang_iw', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_IW')),
			JHtml::_('select.option', 'lang_hu', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_HU')),
			JHtml::_('select.option', 'lang_is', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_IS')),
			JHtml::_('select.option', 'lang_it', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_IT')),
			JHtml::_('select.option', 'lang_ja', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_JA')),
			JHtml::_('select.option', 'lang_ko', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_KO')),
			JHtml::_('select.option', 'lang_lv', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_LV')),
			JHtml::_('select.option', 'lang_lt', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_LT')),
			JHtml::_('select.option', 'lang_no', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_NO')),
			JHtml::_('select.option', 'lang_pl', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_PL')),
			JHtml::_('select.option', 'lang_pt', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_PT')),
			JHtml::_('select.option', 'lang_ro', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_RO')),
			JHtml::_('select.option', 'lang_ru', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_RU')),
			JHtml::_('select.option', 'lang_es', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_ES')),
			JHtml::_('select.option', 'lang_sv', JText::_('COM_ARTOFGM_OPTION_LANGUAGE_LANG_SV')),
		);

		return $lrOptions;
	}

	/**
	 * Get a list of occurence options
	 *
	 * @return	array	An array of elements suitable to use in the JHtml select list API.
	 * @since	1.0
	 */
	public static function getOccurenceOptions()
	{
		$occtOptions = array(
			JHtml::_('select.option', 'title',	JText::_('COM_ARTOFGM_OPTION_OCCURENCE_TITLE')),
			JHtml::_('select.option', 'url',	JText::_('COM_ARTOFGM_OPTION_OCCURENCE_URL')),
		);

		return $occtOptions;
	}

	/**
	 * Get a list of occurence options
	 *
	 * @return	array	An array of elements suitable to use in the JHtml select list API.
	 * @since	1.0
	 */
	public static function getSortOptions()
	{
		$sortOptions = array(
			JHtml::_('select.option', 'date:D:S:d1', JText::_('COM_ARTOFGM_OPTION_SORT_DATE')),
		);

		return $sortOptions;
	}

	/**
	 * Get a list of occurence options
	 *
	 * @return	array	An array of elements suitable to use in the JHtml select list API.
	 * @since	1.0
	 */
	public static function getFilterOptions()
	{
		$filtOptions = array(
			JHtml::_('select.option', '1', JText::_('COM_ARTOFGM_OPTION_FILTER_1')),
			JHtml::_('select.option', '0', JText::_('COM_ARTOFGM_OPTION_FILTER_0')),
			JHtml::_('select.option', 's', JText::_('COM_ARTOFGM_OPTION_FILTER_S')),
			JHtml::_('select.option', 'p', JText::_('COM_ARTOFGM_OPTION_FILTER_P')),
		);

		return $filtOptions;
	}
}
