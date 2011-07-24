<?php
/**
 * Text controller is used for managing and displaying texts on web site
 */
class TextsController extends AppController
{

	var $helpers = array('Html', 'TextList', 'Form');

	var $uses = array ('Text', 'Genre');

	var $windowWidths = array('1' => 600, '2' => 800, '3' => 800);

	function listAll($genre, $year = null)
	{
    	$this->set('message', '');

		$years = $this->Text->getYearsList($genre);
		if(empty($years))
		{
			$this->set('message', 'Раздел пока не заполнен');
		}

    	$this->set("years", $years);

		if(empty($year))
    	{
    		$year = $years[count($years)-1];
    	}
    	$this->set("activeYear", $year);

    	$texts = $this->Text->findAll(array('Text.text_year' => $year, 'Text.genre_id' => $genre, 'Text.published' => 1));
    	$this->set("texts", $texts);

	}

	function viewText($year = null, $token)
	{
    	$texts = $this->Text->findByTextToken($token);

    	$this->set('text_title', $texts['Text']['text_title']);
    	$this->set('text', $texts['Text']['text']);
    	$this->set('sign', $texts['Text']['text_date_label']);
		$this->set('token', $token);

  		$this->set('table_width', $this->windowWidths[$texts['Text']['genre_id']]);

    	$this->render('viewText', 'view', 'views/texts/view_text.thtml');
	}

	function displayEditList()
	{
		// check authentication
		$this->checkSession();

    	$texts = $this->Text->findAll(null, null, 'order by text_id asc');
    	$this->set("texts", $texts);
        $this->render('displayEditList', 'view', 'views/texts/display_edit_list.thtml');
	}

	function editText($token = null)
	{
		// check authentication
		$this->checkSession();

		//$this->log('Passed token: ' . $token, LOG_DEBUG);
		// get list of genges
		$this->set('genres', $this->Genre->generateList(null, 'genre_id ASC', null,
											'{n}.Genre.genre_id', '{n}.Genre.genre_name'));
		//print_r($this->Genre->generateList(null, 'genre_id ASC', null, '{n}.Genre.genre_id', '{n}.Genre.genre_name'));
		// If a user has submitted form data - save data in the database
        if (!empty($this->data))
        {
        	// Check to see if form data has been submitted
	        if (!empty($this->data['Text']))
	        {
                //$this->data['Text']['genre_id'] = $this->data['Genre']['genre_id'];
                //$txt = print_r($this->data, true);
                //$this->log($txt, LOG_DEBUG);
                //$this->log('!!! GENRE: '.$this->data['Text']['genre_id'], LOG_DEBUG);
                //Try to save as normal, shouldn't work if the field was invalidated.
	            if($this->Text->save($this->data))
	            {
	            	//$this->Text->saveField('genre_id', $this->data['Text']['genre_id']);
	            	//print_r('<h1>'.$this->data['Text']['genre_id'].'</h1>');
	            	$this->Text->query('update rt_texts set genre_id='.$this->data['Text']['genre_id'].' where text_id='.$this->data['Text']['text_id']);
	            	//$this->log('AFTER SAVE GENRE: '.$this->data['Text']['genre_id'], LOG_DEBUG);
                	$this->redirect('/admin/');
         			return;
	            }
	            else
	            {
                	$this->render();
                	return;
	            }
	        }
	    }

		$this->set('headerTitle', 'Новое произведение');

	    // edit existing text
	    if($token != null)
	    {
        	$text = $this->Text->findByTextToken($token);
        	//print_r($text);
         	$this->data = $text;

         	// set page title
         	$this->set('headerTitle', $text['Text']['text_title']);
	    }

        $this->render('editText', 'view', 'views/texts/edit_text.thtml');
	}

	function deleteText($token)
	{
		// check authentication
		$this->checkSession();

    	$text = $this->Text->findByTextToken($token);
    	if(!empty($text))
    	{
			$this->Text->del($text['Text']['text_id']);
    	}
    	$this->redirect('/admin/');
	}

	function republishText($token)
	{
		// check authentication
		$this->checkSession();

    	$text = $this->Text->findByTextToken($token);
    	if(!empty($text))
    	{
    		if($text['Text']['published'] == 1)
    		{
	    		$text['Text']['published'] = 0;
	   		}
			else
			{
				$text['Text']['published'] = 1;
			}
			$this->Text->save($text);
    	}
    	$this->redirect('/admin/');
	}

    function subscribe()
    {

    }


}
?>