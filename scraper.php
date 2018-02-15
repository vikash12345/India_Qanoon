<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';
	$browser	=	file_get_html('https://indiankanoon.org/browse');
	foreach($browser->find("//td/div[@class='browselist']/")as $element)
	{
	$page 		=	$element->find("a",0)->href;
	$pagetext	=	$element->find("a",0)->plaintext;
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
						$correctlink	=	'https://indiankanoon.org'.$monthname;
						echo $urlofpage	=	str_replace(" ","%20",$correctlink);
						$html		=		file_get_html($urlofpage);
		if($html)
		{
			//  Page loaded successfully
		$RecordLoop =   -1;
		$RecordFlag =   true;
		while ($RecordFlag == true) 
			{
					$RecordLoop+=  1;
					$paginationlink		=	$urlofpage.'&pagenum='.$RecordLoop;
					$mainpageofprofiles 		=	file_get_html($paginationlink);
					$checkerprofile	=	$mainpageofprofiles->find("/html/body/div/div[3]/form/input[3]",0);
					if (!$checkerprofile) 
								{
									$RecordFlag =   false;
									break;
								}			
					foreach($mainpageofprofiles->find("//div/div/div[@class='result']") as $element)
						{

							//Name of Case
							$vsname		=	$element->find("//a[@class='result_url']",0)->plaintext;

							//Link of Case
							$lvsname		=	$element->find("//a[@class='result_url']",0)->href;

							//This is for Name of judicary
							 $courtname	=	$element->find("div[@class='docsource']",0)->plaintext;

							//Text of Cite
							$cite	=	$element->find("a[@class='cite_tag']",0)->plaintext;

							//Link of Cite
							$lcite	=	$element->find("a[@class='cite_tag']",0)->href;


							//This is for Full Document	
							$fulldocument	=	$element->find("//a[plaintext^=Full Document]", 0)->href;
							 //  End if nor more records
							 $record = array( 'vsname' =>$vsname,
									 'link' =>$link,
									 'pagelink' => $pagelink,
									 'urlofpage' => $urlofpage,
									 'lvsname' =>$lvsname,
									 'courtname' =>$courtname,
									 'cite' =>$cite,
									 'lcite' =>$lcite,
									 'paginationlink' =>$paginationlink);
		  scraperwiki::save(array('vsname','link','pagelink','urlofpage','lvsname','courtname','cite','lcite','paginationlink'), $record);
						}





			}

		}



					}
				}
			}
		}
	}
	}
?>
