<?php

/**
* Admin controller
**/
class AdminController extends Controller {

	/**
	* Displays the 'hub board' for the Admin Controller.
	*
	* @access 	public
	* @return 	void
	**/
	public function index() {
		$posts = array_reverse(Database::getPosts());
		$users = Database::getUsers();

		$comments = Database::getCommentsNotApproved();

		$commentsAmount = count($comments) < 1 ? "" : count($comments);

		$admin = Database::getUser(Auth::getUsername());

		$view = BLOGZA_DIR . "/system/views/Admin.view.php";

		require $view;
	}

	/**
	* Creates the post. This is an Ajax / POST only feature.
	*
	* @access 	public
	* @return 	void
	**/
	public function createPost() {
		if(!empty($_POST['content']) && !empty($_POST['title'])) {
			// NEEDS SANITIZATION!
			$title = $_POST['title'];
			$content = $_POST['content'];

			$content = str_replace("\n", "[BR]", $content); // Replace line breaks with Markup breaks.

			Database::createPost(Auth::getUsername(), $title, $content);
			Database::addPost(Auth::getUsername());
			echo "Post created.";
		} else {
			echo "You are missing one or two fields.";
		}
	}

	/**
	* Gets the post. This is an Ajax / POST only feature.
	*
	* @access 	public
	* @return 	void
	**/
	public function getPost() {
		if(!empty($_POST['id'])) {
			$id = $_POST['id'];

			if(!is_numeric($id)) {
				echo "Post ID must be numeric.";
			} else {
				// Now we get the Post.
				$post = Database::getPost($id);
				$markup = new Markup();

				$content = $markup->processBackwards($post->content);
				$content = str_replace("[BR]", "\n", $content);

				$return = array(
					'code' => '200',
					'post' => array(
						'id' => $post->id,
						'title' => $post->title,
						'author' => $post->author,
						'content' => $post->content,
						'date' => $post->date,
						'status' => $post->status,
						),
					);

				echo json_encode($return);
			}
		} else {
			$return = array(
				'code' => '500',
				'error' => 'You did not specify the POST variable "id".',
				);

			echo json_encode($return);
		}
	}

	/**
	* Gets a User's data. This is an Ajax / POST only feature and echoes back JSON-encoded data.
	*
	* @access 	public
	* @return 	void
	**/
	public function getUser() {
		if(!empty($_POST['user'])) {
			$username = Util::sanitizeAlphaNumerically($_POST['user']);

			$user = Database::getUser($username);

			$return = array(
				'code' => '200',
				'user' => array(
					'username' => $user->getUsername(),
					'posts' => $user->getPosts(),
					'email' => $user->getEmail(),
					'rank' => $user->getRank(),
					'avatar' => $user->getAvatar(),
					'ips' => $user->getIPs(),
					),
				);

			$json = json_encode($return);
			echo $json;
		} else {
			$return = array(
				'code' => '500',
				'error' => 'You did not specify the POST variable "user".',
				);

			echo json_encode($return);
		}
	}

	/**
	* Saves a user into the database. This is an Ajax / POST only feature and echoes back JSON-encoded data.
	*
	* @access 	public
	* @return 	void
	**/
	public function saveUser() {
		if(!empty($_REQUEST['user'])) {
			$input = array();

			foreach(json_decode($_REQUEST['user']) as $obj => $value) {
				$input[$obj] = $value;
			}

			// User stuff.
			$username = $input['username'];
			$email = $input['email'];
			$rank = $input['rank'];

			// Get the real user.
			$user = Database::getUser($username);

			$msg = array();
			if($user->username !== $username) {
				Database::updateUserName($user->username, $username);
				$msg[] = "Username updated.";
			}
			if($user->email !== $email) {
				Database::updateUserEmail($user->username, $email);
				$msg[] = "Email updated.";
			}
			if($user->rank !== $rank) {
				Database::updateUserRank($user->username, $rank);
				$msg[] = "Rank updated.";
			}
			
			$return = array(
				'code' => '200',
				'message' => implode('\r\n', $msg),
				);

			echo json_encode($return);
		} else {
			$return = array(
				'code' => '500',
				'error' => 'You did not specify the POST variable "user".',
				);

			echo json_encode($return);
		}
	}

	/**
	* Updates a comment's moderated status. This is an Ajax / POST only feature.
	*
	* @access 	public
	* @return 	void
	**/
	public function updateComment() {

		if(!empty($_POST['value']) && !empty($_POST['comment_id'])) {
			$value = $_POST['value'];
			$value = Util::sanitizeAlphaNumerically($value);

			$id = $_POST['comment_id'];
			if(!is_numeric($id)) {
				echo "Your comment ID is not numeric.";
			} else {
				Database::updateCommentApproved($id, $value);
				echo "Approved to $value correctly.";
			}

		} else {
			echo "JS Error: Missing one or two fields.";
		}

	}

	/**
	* Updates a post's status, content, and title. This is an Ajax / POST only feature.
	*
	* @access 	public
	* @return 	void
	**/
	public function updatePost() {
		if(!empty($_POST['content']) && !empty($_POST['id'])) {
			$id = $_POST['id'];
			$content = $_POST['content'];

			$content = str_replace("\r\n", "[BR]", $content); // Replace line breaks with Markup breaks.
			$content = html_entity_decode($content); // Keep our HTML entities safe.

			Database::updatePost($id, $content);
			echo "Post updated.";
		} else {
			echo "You are missing one or two fields.";
		}
	}

	/**
	* Allows the admin to login as another user.
	*
	* @access 	public
	* @return 	void
	**/
	public function loginAsUser() {
		$username = $this->matched[1];

		Auth::logout();
		Auth::login($username);

		Util::redirect(BLOG_URL);
	}

	/**
	* Performs the authentication check on the user.
	*
	* @access 	public
	* @return 	void
	**/
	public function auth() {
		$rank = Auth::getRank();
		if($rank !== "Admin") {
			Util::redirect(BLOG_URL . "/login/");
		}
	}

}