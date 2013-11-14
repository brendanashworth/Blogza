<?php

/**
* Controller class for the /install/ route.
**/
class InstallerController extends Controller {

	/**
	* Starts the Blogza Installer. This method simply forwards to /install/step/1.
	*
	* @access 	public
	* @return 	void
	**/
	public function start() {
		Util::redirect(BLOG_URL . "/install/step/1");
	}

	/**
	* Runs a step more in the Installer.
	*
	* @access 	public
	* @return 	void
	**/
	public function step() {
		$step = $this->matched[1];
		
		/* Go for each possible step. */
		switch($step) {

			case 1:
				$this->step1();
				break;
			case 2:
				$this->step2();
				break;
			case 3:
				$this->step3();
				break;

		}
	}

	/**
	* Completes the step 1 for the Installer.
	*
	* This step handles the MySQL database setup.
	*
	* @access 	protected
	* @return 	void
	**/
	protected function step1() {
		if(isset($_POST['blogname']) && isset($_POST['blogdesc']) && isset($_POST['blogurl'])  &&
		   isset($_POST['host'])     && isset($_POST['user'])     && isset($_POST['password']) && isset($_POST['dbname']) ) {
		   	require BLOGZA_DIR . "/system/models/Model.php";
		   	require BLOGZA_DIR . "/system/models/Installer.php";
			// All the fields were filled out. Wow, thats a lot of fields.
			$installer = new Installer();

			// Get all the settings into an array.
			$settings = array(
				"BLOG_NAME"      => $_POST['blogname'],
				"BLOG_DESC"      => $_POST['blogdesc'],
				"BLOG_URL"       => $_POST['blogurl'],
				"MYSQL_HOST"     => $_POST['host'],
				"MYSQL_USER"     => $_POST['user'],
				"MYSQL_PASSWORD" => $_POST['password'],
				"MYSQL_DATABASE" => $_POST['dbname'],
				);

			$installer->overwriteConfiguration($settings);

			Util::redirect(BLOG_URL . "/install/step/2");
		}

		$step = 1;
		$error = false;
		if(isset($_SESSION['error'])) {
			$error = $_SESSION['error'];
		}

		$view = BLOGZA_DIR . "/system/views/install-step1.view.php";
		require $view;
	}

	/**
	* Completes the step 2 for the Installer.
	*
	* This step checks for database setup.
	*
	* @access 	protected
	* @return 	void
	**/
	protected function step2() {
		$step = 2;

		if(!Database::checkConnection()) {
			$_SESSION['error'] = "The database fields were not correct.";
			Util::redirect(BLOG_URL . "/install/step/1");
		}

		if(Database::isInitialized()) {
			Util::redirect(BLOG_URL . "/install/step/3");
		} else {
			// Should we initialize the database now and redirect to step 3?
			if(isset($_POST['init']) && $_POST['init']) {
				Database::initialize();
				Util::redirect(BLOG_URL . "/install/step/3");
			}

			$view = BLOGZA_DIR . "/system/views/install-step2.view.php";
			$step = 2;

			require $view;
		}
	}

	/**
	* Completes the step 3 for the Installer.
	*
	* This step creates the first admin user.
	*
	* @access 	protected
	* @return 	void
	**/
	protected function step3() {
		echo "Step 3.";
	}

}