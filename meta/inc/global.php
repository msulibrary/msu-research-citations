<?php
//sitewide functions and utilities, holds global functions that can be included on all kinds of pages

//function validates the user's search term(s) to make sure that they contain only valid characters. A list of valid characters is given in the validChar string below.
function validation($q, $keyword, $date, $creator, $title, $journal, $subject, $workshop)
{
  $localQ = strtolower($q);
  $localKeyword = strtolower($keyword);
  $localDate = strtolower($date);
  $localCreator = strtolower($creator);
  $localTitle = strtolower($title);
  $localJournal = strtolower($journal);
  $localSubject = strtolower($subject);
  $localWorkshop = strtolower($workshop);


  $validChar = "abcdefghijklmnopqrstuvwxyz\"',.?&:;-()/\ 1234567890&amp;";

  $length = strlen($localQ);
  for($i = 0; $i < $length; $i++)
  {
	 if(!strstr($validChar, $localQ[$i]))
	 {
		echo "<h2><strong>Your search contains invalid characters</strong></h2>\n";
		echo "<hr />\n";
		echo "<h3>The search string \"$localQ\" contains an invalid character(s)!!<br /><br /> 
			  Please use your browser's <strong>BACK</strong> button and fix the error. Then resubmit your request.</h3>\n";

		return false;
	 } 
  }

  $length = strlen($localKeyword);
  for($i = 0; $i < $length; $i++)
  {
	 if(!strstr($validChar, $localKeyword[$i]))
	 {
		echo "<h2><strong>Your search contains invalid characters</strong></h2>\n";        
		echo "<hr />\n";
		echo "<h3>The Keyword search string \"$localKeyword\" contains an invalid character(s)!!<br /><br />
			  Please use your browser's <strong>BACK</strong> button and fix the error. Then resubmit your request.</h3>\n";

		return false;
	 }    

  }
  
  $length = strlen($localDate);
  for($i = 0; $i < $length; $i++)
  {
	 if(!strstr($validChar, $localDate[$i]))
	 {
		echo "<h2><strong>Your search contains invalid characters</strong></h2>\n";        
		echo "<hr />\n";
		echo "<h3>The Date search string \"$localDate\" contains an invalid character(s)!!<br /><br />
			  Please use your browser's <strong>BACK</strong> button and fix the error. Then resubmit your request.</h3>\n";

		return false;
	 }    

  }
 
  $length = strlen($localCreator);
  for($i = 0; $i < $length; $i++)
  {
	 if(!strstr($validChar, $localCreator[$i]))
	 {
		echo "<h2><strong>Your search contains invalid characters</strong></h2>\n";        
		echo "<hr />\n";
		echo "<h3>The Author(s) search string \"$localDate\" contains an invalid character(s)!!<br /><br />
			  Please use your browser's <strong>BACK</strong> button and fix the error. Then resubmit your request.</h3>\n";

		return false;
	 }    

  }

   $length = strlen($localTitle);
  for($i = 0; $i < $length; $i++)
  {
	 if(!strstr($validChar, $localTitle[$i]))
	 {
		echo "<h2><strong>Your search contains invalid characters</strong></h2>\n";        
		echo "<hr />\n";
		echo "<h3>The Title search string \"$localJournal\" contains an invalid character(s)!!<br /><br />
			  Please use your browser's <strong>BACK</strong> button and fix the error. Then resubmit your request.</h3>\n";

		return false;
	 }    

  }

   $length = strlen($localJournal);
  for($i = 0; $i < $length; $i++)
  {
	 if(!strstr($validChar, $localJournal[$i]))
	 {
		echo "<h2><strong>Your search contains invalid characters</strong></h2>\n";        
		echo "<hr />\n";
		echo "<h3>The Journal search string \"$localJournal\" contains an invalid character(s)!!<br /><br />
			  Please use your browser's <strong>BACK</strong> button and fix the error. Then resubmit your request.</h3>\n";

		return false;
	 }    

  }


   $length = strlen($localWorkshop);
  for($i = 0; $i < $length; $i++)
  {
	 if(!strstr($validChar, $localWorkshop[$i]))
	 {
		echo "<h2><strong>Your search contains invalid characters</strong></h2>\n";        
		echo "<hr />\n";
		echo "<h3>The Workshop search string \"$localWorkshop\" contains an invalid character(s)!!<br /><br />
			  Please use your browser's <strong>BACK</strong> button and fix the error. Then resubmit your request.</h3>\n";

		return false;
	 }    

  }


   $length = strlen($localSubject);
  for($i = 0; $i < $length; $i++)
  {
	 if(!strstr($validChar, $localSubject[$i]))
	 {
		echo "<h2><strong>Your search contains invalid characters</strong></h2>\n";        
		echo "<hr />\n";
		echo "<h3>The Subject search string \"$localSubject\" contains an invalid character(s)!!<br /><br />
			  Please use your browser's <strong>BACK</strong> button and fix the error. Then resubmit your request.</h3>\n";

		return false;
	 }    

  }

  return true;
}//end validation()

//function displays a message box to the user if their search resulted in no matching item/records. When the user clicks the OK button they are taken back to the main search page.
function noMatches()
{
  echo "<h2><strong>There are no resulting matches</strong></h2>\n";
  echo "<hr />\n"; 
  echo "<h3>There are no items in the database that match your search value(s).<br /><br /> 
		Please try again!!!</h3>\n";
}//end noMatches()

//function converts rfc 822 date into unix timestamp
function dateConvert($rssDate)
{
$rawdate=strtotime($rssDate);
if ($rawdate == -1) {
		$convertedDate = 'conversion failed';
    } else {
		$convertedDate = date('Y-m-d h:i:s',$rawdate);
		return $convertedDate;
    }
}
//end dateConvert

//function converts timestamp into rfc 822 date
function dateConvertTimestamp($timestamp)
{
$rawdate=strtotime($timestamp);
if ($rawdate == -1) {
		$convertedDate = 'conversion failed';
    } else {
		$convertedDate = date('D, d M Y h:i:s T',$rawdate);
		return $convertedDate;
    }
}
//end dateConvertTimestamp

//this function matches and highlights words used in the search query
//function highlightWords($string, $words) {
//	foreach ($words as $word) {
//		$string = str_ireplace($word, '<span class="highlight">'.$word.'</span>', $string);
//	}
	//return the highlighted string
//	return $string;
//}//end highlightWords()

?>
