<?php

/**
* CAPTCHAHandler, provides a simple way to prevent robot spam.
**/
class CAPTCHAHandler {

	private static $question = null;

	/**
	* Generates the CAPTCHA answer and question.
	*
	* @access 	public
	* @return 	string 	The CAPTCHA question.
	**/
	public static function generate() {
		if(self::$question != null) {
			return self::$question;
		}

		$numbers = array(1, 2, 4, 5, 7, 7, 9, 13, 15);
		$words = array(
			1 => "one",
			2 => "two",
			4 => "four",
			5 => "five",
			7 => "seven",
			9 => "nine",
			13 => "thirteen",
			15 => "fifteen",
			);

		$selected1 = $numbers[array_rand($numbers)];
		$selected2 = $numbers[array_rand($numbers)];

		$english = "";
		foreach($words as $num => $word) {
			if($num == $selected2) $english = $word;
		}

		// We add another one just for more anti-bot protection.
		$question = "What is " . $selected1 . " plus " . $english . " plus 1?";
		$answer = $selected1 + $selected2 + 1;

		self::$question = $question;
		$_SESSION['CAPTCHA_ANSWER'] = $answer;

		return $question;
	}

	/**
	* Checks the CAPTCHA token based on the previous set key.
	*
	* @access 	public
	* @return 	bool 	Whether or not the user is validated.
	**/
	public static function check() {
		if(empty($_POST['captcha_token']) || empty($_SESSION['CAPTCHA_ANSWER'])) {
			return false;
		}

		echo $_POST['captcha_token'] . "  " . $_SESSION['CAPTCHA_ANSWER'];
		if($_POST['captcha_token'] != $_SESSION['CAPTCHA_ANSWER']) {
			return false;
		}

		return true;
	}

}