<?php

ini_set('error_reporting', 'on');
error_reporting(E_ALL);

/**
* Mail class.
**/
class Mail {

	protected $to;
	protected $from;

	protected $subject;
	protected $message;

	protected $headers = array();

	/**
	* Creates the Mail instance. A mail instance is sort of like "one email".
	*
	* @access 	public
	* @param 	string		$to 		The email to send the message to.
	* @param 	string 		$from 		The email to send the message from.
	* @param 	string 		$subject 	Subject of the email.
	* @param 	string 		$message 	Message, or content, of the email.
	* @return 	Mail
	**/
	public function __construct($to, $from, $subject, $message) {
		if($to == null || $from == null || $subject == null || $message == null) {
			throw new Exception("None of the fields can be null for an email!");
		}

		$this->to = $to;
		$this->from = $from;
		$this->subject = $subject;
		$this->message = $message;
	}

	/**
	* Sets the email as raw HTML.
	*
	* @access 	public
	* @param 	boolean 	$bool 	Whether or not the email is raw HTML.
	* @return 	void
	**/
	public function setHTML($bool) {
		if($bool) {
			// Set the headers and stuff as HTML.
			array_push($this->headers, "MIME-Version: 1.0");
			array_push($this->headers, "Content-type: text/html; charset=iso-8859-1");
		}
	}

	/**
	* Adds a header to the headers.
	*
	* @access 	public
	* @param 	string 	$header 	The header to add to the header list.
	* @return 	void
	**/
	public function addHeader($header) {
		array_push($this->headers, $header);
	}

	/**
	* Sends the email.
	*
	* @access 	public
	* @return 	void
	**/
	public function send() {
		// Compile the headers.
		$this->addHeader("From: " . $this->from);

		$header = "";
		foreach($this->headers as $head) {
			$header .= $head . "\r\n";
		}

		$resp = mail($this->to, $this->subject, $this->message, $header);
	}

}