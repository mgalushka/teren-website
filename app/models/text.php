<?php

/**
 *  Represents text entity in database
 */
class Text extends AppModel
{
	var $name = 'Text';

    var $primaryKey = 'text_id';

    var $recursive = 0;

	var $useTable = 'texts';

    var $validate = array();

   	var $belongsTo = array('Genre' =>
                        array('className'    => 'Genre',
                              'conditions'   => '',
                              'order'        => '',
                              'foreignKey'   => 'genre_id'
                        )
                  );

    function getYearsList($genre = '1') {
		$ret = $this->query("select distinct text_year from rt_texts where genre_id=". $genre ." order by text_year");
		//$this->log('!!!: ' . print_r($ret), LOG_DEBUG);
		$yearsList = array();
		foreach ($ret as $item) {
		   	array_push($yearsList, $item['rt_texts']['text_year']);
		   	//$this->log('!!!: ' . print_r($item), LOG_DEBUG);
		}
		//print_r($yearsList);
		return $yearsList;
	}
}
?>