<?php
class site_controller
{
	public static function logout()
	{
		unset($_SESSION[constant("cAppKey")]);
		basic_redir($GLOBALS["home_url"]);
	}

	public static function check_login()
	{
		if (!isset($_SESSION[constant("cAppKey")]["credential"])) {
			return false;
		} else {
			if (isset($_COOKIE["token_auth_factors"]) && $_COOKIE["token_auth_factors"] == $_SESSION[constant("cAppKey")]["credential"]["token_auth_factors"]) {
				return true;
			} else {
				return false;
			}
		}
	}

	public static function error($info)
	{
		$title = $info["title"];
		$msg = $info["msg"];
		$done = isset($info["done"]) ? $info["done"] :  $GLOBALS["home_url"];
		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");
		include(constant("cRootServer") . "ui/page/error.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function display($info)
	{
		if (site_controller::check_login()) {
			$page = 'dashboard';

			include(constant("cRootServer") . "ui/common/header.inc.php");
			include(constant("cRootServer") . "ui/common/head.inc.php");
			include(constant("cRootServer") . "ui/components/dashboard/dashboard.php");
			include(constant("cRootServer") . "ui/common/footer.inc.php");
			include(constant("cRootServer") . "ui/common/foot.inc.php");
		} else {
			// $page = 'dashboard';

			include(constant("cRootServer") . "ui/common/header.inc.php");
			include(constant("cRootServer") . "ui/common/head.inc.php");

			if (isset($_SESSION["auth_factor"]) && $_SESSION["auth_factor"] == true && isset($_SESSION[constant("cAppKey")])) {
				$code = "";
				$code = mt_rand(1000, 9999);

				$users = new users_model();
				$users->set_filter(array(" idx = '" . $_SESSION[constant("cAppKey")]["credential"]["idx"] . "'"));
				$users->populate(array("token_auth_factors" => $code));
				$users->save();

				$mail = $_SESSION[constant("cAppKey")]["credential"]["mail"];
				$mail = explode("@", $mail);
				$mail = substr($mail[0], 0, 1) . "******@" . $mail[1];

				// $page = strtr(file_get_contents(constant("cRootServer") . "furniture/mail/codigo-acesso.html"), array(
				// 	"#HOST#" => constant("cFurniture") . "mail/", "#SITE#" => constant("cTitle"), "#NOME#" => $_SESSION[constant("cAppKey")]["credential"]["first_name"], "#LOGIN#" => $_SESSION[constant("cAppKey")]["credential"]["mail"], "#LINK#" => $code
				// ));

				// $messages_model = new messages_model();
				// $messages_model->populate(array(
				// 	"name" => "Código de acesso", "scheduled_at" => date("Y-m-d H:i:s"), "mailboxes" => serialize(array(
				// 		// "Address" => array("name" => $_SESSION[constant("cAppKey")]["credential"]["first_name"], "mail" => $_SESSION[constant("cAppKey")]["credential"]["mail"]), "from" => array("name" => constant("mail_from_name"), "mail" => constant("mail_from_mail")), "replyTo" => array("name" => constant("mail_from_name"), "mail" => constant("mail_from_mail"))
				// 	)), "htmlmsg" => $page, "textmsg" => strip_tags($page), "type" => "mail"
				// ));
				// $messages_model->save();

				$_SESSION["auth_factor"] = false;

				include(constant("cRootServer") . "ui/components/auth/auth_factor.php");
			} else {
				include(constant("cRootServer") . "ui/components/login/login.php");
			}

			include(constant("cRootServer") . "ui/common/foot.inc.php");

			if (isset($_SESSION["messages_app"])) {
				print('<div class="alert" id="alertaReturn"></div><script>');
				foreach ($_SESSION["messages_app"] as $k => $v) {
					print('sendAlert("alert-' . $k . '" , "' . implode("<br>", $v) . '");');
				}
				print('</script>');
				unset($_SESSION["messages_app"]);
			}

			print('<script>');
			print('$(function(){ var cont = 60;');
			print('var intervalo = setInterval(function () {;');
			print('	console.log(cont);');
			print('	cont -= 1;');
			print('	$("#sendCont").html("("+cont+")");');
			print(' if(cont == 0){ $("#sendCont").remove(); $("#buttonResend").removeAttr("disabled"); clearInterval(intervalo); }');
			print('}, 1000)');
			print('});');

			print('$("#buttonResend").on("click", function(){');
			print('	$.redirect("/logar", {');
			print('	   resendmail: true,');
			print('	});');
			print('});');

			print('</script>');
		}
	}

	public function forgotPassword($info)
	{
		include(constant("cRootServer") . "ui/common/header.inc.php");
		include(constant("cRootServer") . "ui/common/head.inc.php");

		//$page = 'dashboard';

		include(constant("cRootServer") . "ui/components/login/forgot_password/forgot_password.php");
		include(constant("cRootServer") . "ui/common/footer.inc.php");
		include(constant("cRootServer") . "ui/common/foot.inc.php");
	}

	public function reset_password($info)
	{
		$user = new users_model();
		$user->set_filter(array(" ( mail = '" . $user->con->real_escape_string($info["post"]["text"]) . "' or cpf = '" . $user->con->real_escape_string($info["post"]["text"]) . "' ) "));
		$user->load_data();
		if (isset($user->data[0])) {
			$user->attach(array("tokens"));
			if (isset($user->data[0]["tokens_attach"][0])) {
				$tokens_name = $user->data[0]["tokens_attach"][0]["name"];
			} else {
				$tokens_name = md5(date("YmdHis") . $user->data[0]["idx"]);
				$tokens = new tokens_model();
				$tokens->populate(array("name" => $tokens_name));
				$tokens->save();
				$info["idx"] = $tokens->con->insert_id;
				$info["post"]["users_id"] = $user->data[0]["idx"];
				$tokens->save_attach($info, array("users"), true);
			}

			$page = strtr(file_get_contents(constant("cRootServer") . "furniture/mail/nova-senha.html"), array(
				"#HOST#" => constant("cFurniture") . "mail/", "#SITE#" => constant("cTitle"), "#NOME#" => $user->data[0]["first_name"], "#LOGIN#" => $user->data[0]["mail"], "#LINK#" => sprintf($GLOBALS["tkpwd_url"], $tokens_name)
			));

			$messages_model = new messages_model();
			$messages_model->populate(array(
				"name" => "Renovação da Senha", "scheduled_at" => date("Y-m-d H:i:s"), "mailboxes" => serialize(array(
					"Address" => array("name" => $user->data[0]["first_name"], "mail" => $user->data[0]["mail"]), "from" => array("name" => constant("mail_from_name"), "mail" => constant("mail_from_mail")), "replyTo" => array("name" => constant("mail_from_name"), "mail" => constant("mail_from_mail"))
				)), "htmlmsg" => $page, "textmsg" => strip_tags($page), "type" => "mail"
			));
			$messages_model->save();
			$_SESSION["messages_app"]["info"] = array("Processo de reenvio de senha enviado para o seu e-mail");
		} else {
			$_SESSION["messages_app"]["warning"] = array("Não foi localizado em nossa base de dados dados com o e-mail cadastrado");
		}
		basic_redir($GLOBALS["home_url"]);
		exit();
	}


	public function login($info)
	{
		if (isset($info["post"]["resendmail"])) {

			$_SESSION["auth_factor"] = true;
			$_SESSION["messages_app"]["warning"] = array("Código reenviado");
			basic_redir($GLOBALS["home_url"]);
			exit();
		}

		if (isset($info["post"]["auth_code_send"])) {

			$email = $_SESSION[constant("cAppKey")]["credential"]["mail"];

			if (isset($info["post"]["code_auth"])) {
				$users = new users_model();
				$users->set_filter(array("mail = '" . $email . "'", "token_auth_factors = '" . preg_replace('/\D?/im', '', $info["post"]["code_auth"]) . "'"));
				$users->load_data();
				if (isset($users->data[0]["idx"])) {
					$users->attach(array("profiles"), false, null, array("idx", "name", "adm", "slug"));
					$_SESSION[constant("cAppKey")] = array(
						"credential" => current($users->data)
					);

					$_SESSION["generate_code"] = false;
					$_SESSION["auth_factor"] = false;

					ob_start();
					setcookie("token_auth_factors", preg_replace('/\D?/im', '', $info["post"]["code_auth"]), 2147483647, "/");
					ob_end_flush();
					basic_redir($GLOBALS["home_url"]);
				} else {
					$_SESSION["messages_app"]["warning"] = array("Código de acesso inexistente!");
				}
			} else {
				$_SESSION["messages_app"]["warning"] = array("Você precisa fornecedor o código de acesso!");
				$_SESSION["auth_factor"] = true;
			}

			basic_redir($GLOBALS["home_url"]);
		} else {
			if (isset($info["post"]["login"]) && isset($info["post"]["password"])) {
				$users = new users_model();
				$users->set_filter(array(" login = '" . $users->con->real_escape_string($info["post"]["login"]) . "' ", " password = '" . $users->con->real_escape_string(md5($info["post"]["password"])) . "' ", " idx in ( select users_profiles.users_id from users_profiles, profiles where profiles.active = 'yes' and users_profiles.active = 'yes' and profiles.idx = users_profiles.profiles_id ) "));
				$users->set_paginate(array(" 1 "));
				$users->load_data();

				if (isset($users->data[0]["idx"])) {
					$users->attach(array("profiles", "companies"), false, " limit 1 ");

					$_SESSION[constant("cAppKey")] = array(
						"credential" => current($users->data),
						"companie_id" => $users->data[0]["companies_attach"][0]["idx"]
					);

					$users->populate(array("last_login" => date("Y-m-d H:i:s")));
					$users->save();

					if (!isset($_COOKIE["token_auth_factors"])) {
						$_SESSION["auth_factor"] = true;
					} else {
						if ($_COOKIE["token_auth_factors"] != $_SESSION[constant("cAppKey")]["credential"]["token_auth_factors"]) {
							unset($_COOKIE["token_auth_factors"]);
							$_SESSION["auth_factor"] = true;
						}
					}
				} else {
					$_SESSION["messages_app"]["warning"] = array("Login e/ou Senha informados não conferem");
				}
			} else {
				$_SESSION["messages_app"]["warning"] = array("Login e/ou Senha são obrigatórios para realizar o login");
			}
			basic_redir($GLOBALS["home_url"]);
		}
	}

	public static function change_companie($info)
	{
		$_SESSION[constant("cAppKey")]["companie_id"] = $info["post"]["companie_id"];
	}

	// public function loginwithlink( $info ){
	// 	$users = new users_model();
	// 	$users->set_filter( array( " active = 'yes' " , " md5( concat( idx, login ) ) = '" . $info["slug"] . "' " , " idx in ( select users_profiles.users_id from users_profiles, profiles where users_profiles.active = 'yes' and profiles.active = 'yes' and users_profiles.profiles_id = profiles.idx and profiles.adm = 'yes' ) "  ) ) ;
	// 	$users->set_paginate( array( " 1 " ) ) ;
	// 	$users->load_data();
	// 	if( isset( $users->data[0]) ){
	// 		$users->attach( array("profiles") , false , " limit 1 " );
	// 		$_SESSION[ constant("cAppKey") ] = array(
	// 			"credential" => current( $users->data )
	// 		) ;
	// 	}
	// 	else{
	// 		unset( $_SESSION[ constant("cAppKey") ] );
	// 	}
	// 	basic_redir( $GLOBALS["home_url"] );
	// 	exit();
	// }
}
