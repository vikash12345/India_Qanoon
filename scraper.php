<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';
$browser	=	file_get_html('https://indiankanoon.org/browse');
foreach($browser->find("//td/div[@class='browselist']/")as $element)
{
$page 		=	$element->find("a",0)->href;

if($page)
{
	$link	=	'https://indiankanoon.org/'.$page;
	$pageofyears	=	file_get_html($link);
	foreach($pageofyears->find("/html/body/div[2]/table/tbody/tr/td/div[@class='browselist']")as $year)
	{
		$yearlink	=	$year->find("a",0)->href;
		if($yearlink)
		{
			$pagelink		=	 'https://indiankanoon.org'.$yearlink;
			$openyearpage	=	  file_get_html($pagelink);
			if($openyearpage)
			{
				foreach($openyearpage->find("//td/div[@class='browselist']")as $month)
				{
					 $monthname	=	$month->find("a",0)->href;
					$urlofpage	=	'https://indiankanoon.org'.$monthname.'<br>';
          
          $record = array( 'urlofpage' =>$urlofpage);
          craperwiki::save(array('urlofpage'), $record);
				}
			}
		}
	}
}
}
?>
