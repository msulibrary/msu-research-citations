<?php
// Set Title, Description, and Keywords
$pageTitle = 'Latest Montana State University Research Citations';
$pageDescription = 'Get the latest Montana State University Research Citations from RSS feed sources';
$pageKeywords = 'online database, msu, research, montana, msu library publishing copyright';

// Select page layout - choices include: no columns = fullWidth, and right column = rightCol
$pageLayout = 'rightCol';

// Get database parameters and connect to database
include_once 'ADD-LINK-TO-YOUR-DB-CONNECT-PARAMETERS-HERE';

// Include page header
include './meta/inc/header.php';
?>

<div id="main">
	<a name="mainContent"></a>
	<div class="gutter">
		<h2 class="mainHeading"><?php echo $pageTitle; ?></h2>

<?php
		// Get feeds
		$feedsQuery = "
			SELECT * from feeds
			ORDER BY relatedItem_originInfo_feed_identifier
		";

		$getFeeds = @mysql_query($feedsQuery);

		if (!$getFeeds) {
			die("<p>Error retrieving resources from database!<br/>" .
				"Error: " . mysql_error() . "</p></div></div>");
		}

		$feeds = Array();

		// Display selected resource entry fields in a list
		while ($row = mysql_fetch_object($getFeeds)) {
			$feed_publisher = $row->relatedItem_originInfo_feed_publisher;
//			$feed_URL = stripslashes(html_entity_decode($row->relatedItem_originInfo_feed_url));
			$feed_URL = $row->relatedItem_originInfo_feed_url;

			$feeds[$row->relatedItem_originInfo_feed_identifier] = array($row->relatedItem_originInfo_feed_publisher, $row->relatedItem_originInfo_feed_url);
		}

		if (isset($_GET['show']) && $_GET['show'] == "all") {
			foreach ($feeds as $key => $value) {

				// Prepare request
				$base = 'http://ajax.googleapis.com/ajax/services/feed/load';
				$query_string = '';

				// Set parameters for our request to google ajax feed api
				$params = array (
					'q' => $value[1],
					'v' => '1.0', // API version
					'num' => -1, // maximum entries (limited)
//					'output' => 'json_xml', // mixed content: JSON for feed, XML for full entries (json|xml|json_xml)
					'scoring' => 'h', // include historical entries
				);

				foreach ($params as $paramKey => $paramValue) {
					$query_string .= "$paramKey=" . urlencode($paramValue) . "&";
				}

				$request = file_get_contents("$base?$query_string");

				// Create json object(s) out of response from google ajax feed api
				$json = json_decode($request);

				// Define where to start grabbing data - in this case we start inside the first json element returned "responseData"
				$data = $json->responseData;

				foreach ($data->feed->entries as $entry) {
					echo "<p>\n";
					echo ($entry->author ? $entry->author : "[ author ]") . " (" . ($entry->publishedDate ? date('d M Y', strtotime($entry->publishedDate)) : "[publishedDate]") . "). " . $entry->title . ".\n";
					echo "</p>\n";
				}
			}
		}
		else {
			if (!isset($_GET['feed'])) {
				// Set default value for feed, page will show first feed on initial load
				$firstFeed = reset($feeds);
				$feedIdentifier = key($feeds);
			}
			else {
				$feedIdentifier = $_GET['feed'];
			}

			// Prepare request
			$base = 'http://ajax.googleapis.com/ajax/services/feed/load';
			$query_string = '';

			// Set parameters for our request to google ajax feed api
			$params = array(
				'q' => $feeds[$feedIdentifier][1],
				'v' => '1.0', // API version
//				'num' => 10, // maximum entries (limited)
				'num' => -1, // maximum entries (limited)
//				'output' => 'json_xml', // mixed content: JSON for feed, XML for full entries (json|xml|json_xml)
				'scoring' => 'h', // include historical entries
			);

			foreach ($params as $key => $value) {
				$query_string .= "$key=" . urlencode($value) . "&";
			}

			// Build request, encode entities (using http_build_query), and send to google ajax feed api (http://code.google.com/apis/ajaxfeeds/documentation/#fonje)
			// $request = file_get_contents('http://ajax.googleapis.com/ajax/services/feed/load?'.http_build_query($params));
			$request = file_get_contents("$base?$query_string");

			// Create json object(s) out of response from google ajax feed api
			$json = json_decode($request);

			// Define where to start grabbing data - in this case we start inside the first json element returned "responseData"
			$data = $json->responseData;

			// Parse json elements and display as html
			echo '<h3 class="mainHeading"><a href="' . $data->feed->link . '">' . $data->feed->title . '</a><br/><br/></h3>' . "\n";
			echo '<dl>';
			foreach ($data->feed->entries as $entry) {
//				echo '<dt><span class=entryField>Title: </span><a href="http://proxybz.lib.montana.edu/login?url=' . $entry->link . '">' . $entry->title . '</a></dt>' . "\n";
				echo '<dt><span class=entryField>Title: </span><a href="' . $entry->link . '">' . $entry->title . '</a></dt>' . "\n";
				echo '<dd><span class=entryField>Author: </span>'.$entry->author.'</dd>'."\n";
				echo '<dd><span class=entryField>Published Date: </span>'.$entry->publishedDate.'</dd>'."\n";
				echo '<dd><span class=entryField>Content Snippet: </span>'.$entry->contentSnippet.'</dd>'."\n";
				echo '<dd><span class=entryField>Content: </span>'.$entry->content.'</dd>'."\n";
				echo '<dd>'."\n";

				echo '<span class=entryField>Categories: </span></dd>'."\n";
				foreach ($entry->categories as $category) {
					echo $category . ', ' . "\n";
				}

				echo "<br/\n";
			}

			echo "</dl>\n";

			if (isset($_REQUEST['debug'])) {
				echo "<br/><br/>**************************************************************************************************************************************************<br/>\n";
				echo "&nbsp;&nbsp;&nbsp;&nbsp;D E B U G<br/>\n";
				echo "**************************************************************************************************************************************************<br/><br/><br/><br/>\n";

				// DEBUG
				echo "$base?$query_string<span class=entryField><<< the query</span><br/><br/><br/><br/>\n";

				// DEBUG
				//var_dump($request);
				echo prettyPrint($request) . "<span class=entryField><<< json response</span>\n";
			}
		}
?>

	</div><!-- end gutter div -->
</div><!-- end main div -->

<div id="wrapper" class="shadow">
	<div id="sideBar">
		<div class="gutter">
			<!-- include notes, links and rss feeds for pages -->
			<dl id="note">
				<dt>Select a Feed</dt>

<?php
				foreach ($feeds as $key => $value) {
					echo "<dd><a href=?feed=$key>$value[0]</a></dd>\n";
				}
?>
				<dd><br/></dd>
				<dd><a href=<?php echo "?show=all"?>>Show All Citations</a></dd>
				<dd><br/></dd>
				<dd><a href="./manage/autoPop.php">Auto-populate Database</a></dd>
				<dd><br/></dd>
				<dd><a href="./manage/listFeeds.php">Manage Feeds</a></dd>
				<!-- end your notes, links and rss feeds for pages here -->
			</dl>
		</div>
	</div>
</div>

<?php
include './meta/inc/footer.php';

function prettyPrint($json) {
	$result = '';
	$level = 0;
	$in_quotes = false;
	$in_escape = false;
	$ends_line_level = NULL;
	$json_length = strlen($json);

	for ($i = 0; $i < $json_length; $i++) {
		$char = $json[$i];
		$new_line_level = NULL;
		$post = "";
		if ($ends_line_level !== NULL) {
			$new_line_level = $ends_line_level;
			$ends_line_level = NULL;
		}
		if ($in_escape) {
			$in_escape = false;
		} else if ($char === '"') {
			$in_quotes = !$in_quotes;
		} else if (! $in_quotes) {
			switch ($char) {
				case '}': case ']':
					$level--;
					$ends_line_level = NULL;
					$new_line_level = $level;
					break;

				case '{': case '[':
					$level++;
				case ',':
					$ends_line_level = $level;
					break;

				case ':':
					$post = " ";
					break;

				case " ": case "\t": case "\n": case "\r":
					$char = "";
					$ends_line_level = $new_line_level;
					$new_line_level = NULL;
					break;
			}
		} else if ($char === '\\') {
			$in_escape = true;
		}
		if ($new_line_level !== NULL) {
			$result .= "<br/>" . str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $new_line_level);
		}
		$result .= $char . $post;
	}

	return $result;
}
?>
