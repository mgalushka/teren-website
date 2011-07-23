<?php

/**
 *  Represents genre entity in database
 */
class Genre extends AppModel
{
	var $name = 'Genre';

    var $primaryKey = 'genre_id';

    var $recursive = 0;

	var $useTable = 'genre';

 	var $hasMany = array('Text' =>
                         array('className'     => 'Text',
                               'conditions'    => '',
                               'order'         => '',
                               'limit'         => '',
                               'foreignKey'    => 'genre_id',
                               'dependent'     => true,
                               'exclusive'     => false,
                               'finderQuery'   => ''
                         )
                  );

}
?>