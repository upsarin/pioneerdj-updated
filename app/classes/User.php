<?class User {	static function login($user){			foreach($user as $key => $val){				$_SESSION['user'][$key] = $val;				$_SESSION['user']['sess_id'] = md5($user['login'] ."proto". $user['id'] ."box");			}		$params = array("id" => $_SESSION['user']['id']);		$upd_array = array("sess_id" => $_SESSION['user']['sess_id']);		DBConnect::init()->upd_user($params, $upd_array);	}		static function check(){		if(!isset($_SESSION['user']['sess_id'])) {			$_SESSION['user']['id'] = 'guest';			$_SESSION['user']['permissions'] = '11';					}	}    static function check_city()    {        if(empty($_SESSION['user']['city']) || !$_SESSION['user']['city']){            $_SESSION['user']['city'] = "moscow";            $_SESSION['user']['city_array'] = array(array("id" => "moscow", "title" => "Moscow"), array("id" => "nsk", "title" => "Novosibirsk"), array("id" => "almaty", "title" => "Almaty"));            $_SESSION['user']['vk_link'] = "https://vk.com/pioneerdjmsk";            $_SESSION['user']['facebook_link'] = "https://www.facebook.com/PioneerDJmsk/";            $_SESSION['user']['instagram_link'] = "https://www.instagram.com/pioneerdjmsk/";            $_SESSION['user']['youtube_link'] = "https://www.youtube.com/pioneerdjschoolru";        } else if ($_SERVER['QUERY_STRING']){            $city = $_GET['city'];            $city = "moscow";            if ($city == "nsk") {                $_SESSION['user']['city'] = "nsk";                $_SESSION['user']['city_array'] = array(array("id" => "nsk", "title" => "Novosibirsk"), array("id" => "moscow", "title" => "Moscow"), array("id" => "almaty", "title" => "Almaty"));                $_SESSION['user']['vk_link'] = "https://vk.com/pioneerdjnsk";                $_SESSION['user']['facebook_link'] = "https://www.facebook.com/PioneerDJnsk/";                $_SESSION['user']['instagram_link'] = "https://www.instagram.com/pioneerdjnsk/";                $_SESSION['user']['youtube_link'] = "https://www.youtube.com/pioneerdjschoolru";            } else if ($city == "almaty") {                $_SESSION['user']['city'] = "almaty";                $_SESSION['user']['city_array'] = array(array("id" => "almaty", "title" => "Almaty"), array("id" => "nsk", "title" => "Novosibirsk"), array("id" => "moscow", "title" => "Moscow"));                $_SESSION['user']['vk_link'] = "https://vk.com/pioneerdjalmaty";                $_SESSION['user']['facebook_link'] = "https://www.facebook.com/PioneerDJalmaty/";                $_SESSION['user']['instagram_link'] = "https://www.instagram.com/pioneerdjalmaty/";                $_SESSION['user']['youtube_link'] = "https://www.youtube.com/pioneerdjschoolru";            } else if ($city == "moscow"){                $_SESSION['user']['city'] = "moscow";                $_SESSION['user']['city_array'] = array(array("id" => "moscow", "title" => "Moscow"), array("id" => "nsk", "title" => "Novosibirsk"), array("id" => "almaty", "title" => "Almaty"));                $_SESSION['user']['vk_link'] = "https://vk.com/pioneerdjmsk";                $_SESSION['user']['facebook_link'] = "https://www.facebook.com/PioneerDJmsk/";                $_SESSION['user']['instagram_link'] = "https://www.instagram.com/pioneerdjmsk/";                $_SESSION['user']['youtube_link'] = "https://www.youtube.com/pioneerdjschoolru";            }        }        if($_SERVER['QUERY_STRING']) {            header("Location: " . $_SERVER['REDIRECT_URL']);        }    }		/*	static function permission($permission){				if($_SESSION['user']['permissions'] > $permission && $array['name'] != 'administrator'){			header("Location: /");		}	} 	*/	static function logout(){		$params = array("id" => $_SESSION['user']['id']);		$upd_array = array("sess_id" => "offline");		DBConnect::init()->upd_user($params, $upd_array);		session_destroy();	}	}?>