<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Winans Creative 2009
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
 
 
 /**
  * This is some sort of fake class which extends a Module but is not a module (to use parent methods).
  * 
  * @extends ModuleIsotopeBase
  */
 class IsotopeFrontend extends ModuleIsotopeBase
 {
 	/**
 	 * Import required classes because parent::__construct() is not called.
 	 * 
 	 * @access public
 	 * @return void
 	 */
 	public function __construct()
 	{
		$this->import('Input');
		$this->import('Database');
		$this->import('IsotopeCart', 'Cart');
 	}
 	
 	
 	/**
 	 * Does nothing but is required because it's abstract in parent class
 	 * 
 	 * @access protected
 	 * @return void
 	 */
 	protected function compile() {}
 	
 	
 	/**
	 * Replaces Isotope-specific InsertTags in Frontend.
	 * 
	 * @access public
	 * @param string $strTag
	 * @return mixed
	 */
	public function replaceIsotopeTags($strTag)
	{
		$arrTag = trimsplit('::', $strTag);
		
		if (count($arrTag) == 2 && $arrTag[0] == 'isotope')
		{
			switch( $arrTag[1] )
			{
				case 'cart_items';
					return $this->Cart->items;
					break;
					
				case 'cart_products';
					return $this->Cart->products;
					break;
					
				case 'cart_items_label';
					$intCount = $this->Cart->items;
					if (!$intCount)
						return '';
					
					return $intCount == 1 ? ('('.$GLOBALS['TL_LANG']['ISO']['productSingle'].')') : sprintf(('('.$GLOBALS['TL_LANG']['ISO']['productMultiple'].')'), $intCount);
					break;
					
				case 'cart_products_label';
					$intCount = $this->Cart->products;
					if (!$intCount)
						return '';
					
					return $intCount == 1 ? ('('.$GLOBALS['TL_LANG']['ISO']['productSingle'].')') : sprintf(('('.$GLOBALS['TL_LANG']['ISO']['productMultiple'].')'), $intCount);
					break;
			}
		}
		
		return false;
	}
 }
 
 