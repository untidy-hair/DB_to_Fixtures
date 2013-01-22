<?php
/**
 * @package    DB_to_Fixtures\template
 * @author     Yukio Mizuta
 * @copyright  Copyright (c) 2012-2013 Yukio Mizuta
 * @license    MIT License http://www.opensource.org/licenses/mit-license
 * @link       y-mzt.info
 *
 * No Assurance, No responsibility
 */

namespace DB_to_Fixtures\template;

interface templateInterface{
  public function fileOut(array $column_names, array $values, $table);
}
