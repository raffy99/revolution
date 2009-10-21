<?php
/*
 * Copyright 2006, 2007, 2008, 2009 by  Jason Coward <xpdo@opengeek.com>
 *
 * This file is part of xPDO.
 *
 * xPDO is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * xPDO is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * xPDO; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 */

/**
 * Contains a derivative of the xPDOObject class for MySQL.
 *
 * This file contains the base persistent object classes for MySQL, which your
 * user-defined classes will extend when implementing an xPDO object model
 * targeted at the MySQL platform.
 *
 * @package xpdo
 * @subpackage om.mysql
 */

if (!class_exists('xPDOObject')) {
    /** Include the parent {@link xPDOObject} class. */
    include_once (strtr(realpath(dirname(__FILE__)), '\\', '/') . '/../xpdoobject.class.php');
}

/**
 * Implements extensions to the base xPDOObject class for MySQL.
 *
 * {@inheritdoc}
 *
 * @package xpdo
 * @subpackage om.mysql
 */
class xPDOObject_mysql extends xPDOObject {
    protected $_currentTimestamps= array (
        'CURRENT_TIMESTAMP',
        'CURRENT_TIMESTAMP()',
        'NOW()',
        'LOCALTIME',
        'LOCALTIME()',
        'LOCALTIMESTAMP',
        'LOCALTIMESTAMP()',
        'SYSDATE()'
    );
    protected $_currentDates= array (
        'CURDATE()',
        'CURRENT_DATE',
        'CURRENT_DATE()'
    );

    /**
     * {@inheritdoc}
     * @returns xPDOObject_mysql
     */
    function __construct(& $xpdo) {
        parent :: __construct($xpdo);
    }

    /**
     * Initializes the field names with the qualified table name.
     *
     * Once this is called, you can lookup the qualified name by the field name
     * itself.
     *
     * @access protected
     */
    protected function _initFields() {
        reset($this->_fieldMeta);
        while (list ($k, $v)= each($this->_fieldMeta)) {
            $this->fieldNames[$k]= "`{$this->_table}`.`{$k}`";
        }
    }
}

/**
 * Extend this abstract class to define a class having an integer primary key.
 *
 * @package xpdo
 * @subpackage om.mysql
 */
class xPDOSimpleObject_mysql extends xPDOSimpleObject {
    function __construct(& $xpdo) {
        parent :: __construct($xpdo);
    }
}
