<?php

/**
* RSSController, the controller for the RSS feed/s.
**/
class RSSController extends Controller {

	public function getPosts() {
		echo "
<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>
<rss version=\"2.0\">

<channel>
  <title>". BLOG_NAME ."</title>
  <link>". BLOG_URL ."</link>
  <description>". BLOG_DESC ."</description>
  <item>
    <title>RSS Tutorial</title>
    <link>http://www.w3schools.com/rss</link>
    <description>New RSS tutorial on W3Schools</description>
  </item>
  <item>
    <title>XML Tutorial</title>
    <link>http://www.w3schools.com/xml</link>
    <description>New XML tutorial on W3Schools</description>
  </item>
</channel>

</rss>";
	}


}