<?php
/**
 * @package    DB_to_Fixtures\test
 * @author     Yukio Mizuta
 * @copyright  Copyright (c) 2012-2013 Yukio Mizuta
 * @license    MIT License http://www.opensource.org/licenses/mit-license
 * @link       y-mzt.info
 *
 * No Assurance, No responsibility
 */

return
    "CREATE TABLE students
    (
      id serial NOT NULL,
      given_name character varying(255) DEFAULT NULL,
      family_name character varying(255) DEFAULT NULL,
      grade_point_average real,
      created_at timestamp NOT NULL,
      updated_at timestamp NOT NULL,
      CONSTRAINT students_pkey PRIMARY KEY (id)
    );";
