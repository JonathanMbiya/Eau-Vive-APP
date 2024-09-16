<?php
require_once("model/users.php");
class UserController extends User
{
	public function save($post)
	{
		$userName = $post['userName'];
		$userMail = $post['email'];
		$statusMsg = '';
		$status = '';

		if ($this->userKeyValExist('userName', $userName)) {
			$statusMsg = 'Ce User existe deja';
			$status = 'danger';
		} else if ($this->userKeyValExist('email', $userMail)) {
			$statusMsg = 'Cet email existe deja';
			$status = 'danger';
		} else {
			$userName = !empty($post['userName']) ? trim($post['userName']) : '';
			$userEmail = !empty($post['email']) ? trim($post['email']) : '';
			$userRole = !empty($post['role']) ? $post['role'] : '0';
			$userPassword = !empty($post['motDePasse']) ? trim($post['motDePasse']) : '';


			$valErr = '';

			// Validate form fields
			if (empty($userName)) {
				$valErr .= 'Vous devez saisir le user name.<br/>';
			}
			if (empty($userEmail) || !filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
				$valErr .= 'Saisissez un email valide.<br/>';
			}
			if (empty($userPassword)) {
				$valErr .= 'Saisissez un mot de passe.<br/>';
			}

			$haspassWord = password_hash($userPassword, PASSWORD_DEFAULT);


			if (empty($valErr)) {
				$userData = array(
					'userName' => $userName,
					'email' => $userEmail,
					'role' => $userRole,
					'motDePasse' => $haspassWord,
					'status' => "active"
				);
				$insert = $this->InsertUser($userData);
				if ($insert) {
					$status = 'success';
					$statusMsg = 'User ajouté avec succès!';
					$post = [];
				} else {
					$statusMsg = 'Un probleme est survenu, veuillez réessayer plutard.';
					$status = 'danger';
				}
			} else {
				$status = 'danger';
				$statusMsg = '<p>Veuillez remplir tous les champs obligatoires:</p>' . trim($valErr, '<br/>');
			}
		}
		return [
			'status' => $status,
			'message' => $statusMsg
		];
	}

	public function updateP($post) {}

	public function deleteU($id)
	{
		$userId = $id;
		$statusMsg = '';
		$status = '';

		if (!$this->userKeyValExist('id', $userId)) {
			$statusMsg = "Ce User n'existe pas";
			$status = 'danger';
		} else {
			$insert = $this->DeleteUser($userId);
			if ($insert) {
				$status = 'success';
				$statusMsg = 'User supprime avec succès!';
			} else {
				$statusMsg = 'Un probleme est survenu, veuillez réessayer plutard.';
				$status = 'danger';
			}
		}
		return [
			'status' => $status,
			'message' => $statusMsg
		];
	}

	function loginUser($post)
	{
		$statusMsg = '';
		$status_ = '';
		$userInfo = [];

		if (isset($post['userName']) && isset($post['password']) && !empty($post['userName']) && !empty($post['password'])) {
			$statusMsg = '';
			$email = $post['userName'];
			$password = $post['password'];
			$user = $this->GetUserLogin($email);
			if ($user != null) {
				if ($user['status'] == 'active') {
					if (password_verify($password, $user['password'])) {
						$userInfo = [
							'id' => $user['id'],
							'userName' => $user['userName'],
							'role' => $user['role'],
							'email' => $user['email']
						];
						$status_ = 'success';
						$statusMsg = 'Connexion reussie';
					} else {
						$status_ = 'danger';
						$statusMsg = `Identifiant incorrect`;
					}
				} else {
					$status_ = 'warning';
					$statusMsg = "Ce compte n'est plus actif, veuillez contacter l'administrateur pour plus d'informations valide";
				}
			} else {
				$status_ = 'danger';
				$statusMsg = 'Identifiant incorrect';
			}
		} else {
			$status_ = 'danger';
			$statusMsg = "Veuillez saisir vos identifiants";
		}
		return [
			'status' => $status_,
			'message' => $statusMsg,
			'userInfo' => $userInfo
		];
	}
}
