<?php
class TextListHelper extends Helper
{
    var $helpers = array('Html');

    function renderTitles($data, $listAttributes = array(), $itemAttributes = array(), $rootKey, $bodyKey)
    {
        $out="<ul" . $this->Html->_parseAttributes($listAttributes) . ">\n";
        //$this->log('Rendering titles: ' . sizeof($data), LOG_DEBUG);
		foreach ($data as $item) {
			$out .= "<li" . $this->Html->_parseAttributes($itemAttributes) . ">\n";
			$out .= "<a href='{$this->webroot}view/{$item[$rootKey]['text_token']}' target='_blank' onclick='popup(\"{$this->webroot}view/{$item[$rootKey]['text_token']}\", {$item['Text']['genre_id']}); return false;'>{$item[$rootKey][$bodyKey]}</a>\n";
			$out .= "</li>\n";
		}
		$out .= "</ul>\n";
		return $this->output($out, false);
    }

    function renderYears($data, $listAttributes = array(), $itemAttributes = array(), $rootKey, $bodyKey, $activeYear)
    {
        $out="<ul" . $this->Html->_parseAttributes($listAttributes) . ">\n";
        //$this->log('Rendering years: ' . sizeof($data), LOG_DEBUG);
		foreach ($data as $item) {
            //$this->log("item: " . $item, LOG_DEBUG);
			if($item == $activeYear)
			{
            	$out .= "<li><span" . $this->Html->_parseAttributes($itemAttributes) . ">{$item}</span>\n";
        		$out .= "</li>\n";
			}
			else
			{
				$out .= "<li><a href='{$item}'>{$item}</a></li>\n";
			}
		}
		$out .= "</ul>\n";
		return $this->output($out, false);
    }

    function renderAllRecords($data)
    {
    	$out = "";
    	foreach ($data as $item) {
    		$publishString = "Publish";
    		if($item['Text']['published'] == 1)
    		{
    			$publishString = "Unpublish";
    		}
            $out .= "<tr>\n";
			$out .= "<td>{$item['Text']['text_id']}&nbsp;</td>\n";
			$out .= "<td>{$item['Text']['text_title']}&nbsp;</td>\n";
			$out .= "<td>{$item['Genre']['genre_name']}&nbsp;</td>\n";
			$out .= "<td>{$item['Text']['text_year']}&nbsp;</td>\n";
			$out .= "<td nowrap='nowrap'>\n";
			$out .= "<a href='{$this->webroot}admin/edit/{$item['Text']['text_token']}'>Edit</a>&nbsp;&nbsp;\n";
			$out .= "<a href='{$this->webroot}admin/republish/{$item['Text']['text_token']}'>".$publishString."</a>&nbsp;&nbsp;\n";
			$out .= "<a href='{$this->webroot}admin/delete/{$item['Text']['text_token']}' onclick='return confirmDelete();'>Delete</a>&nbsp;&nbsp;\n";
			$out .= "<a href='{$this->webroot}view/{$item['Text']['text_token']}' target='_blank' onclick='popup(\"{$this->webroot}view/{$item['Text']['text_token']}\", {$item['Text']['genre_id']}); return false;'>View</a>&nbsp;&nbsp;\n";
	      	$out .= "</td>\n";
			$out .= "</tr>\n";
		}
		return $this->output($out, false);
    }
}
?>