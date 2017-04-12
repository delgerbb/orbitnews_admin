<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class
 *
 * @author User
 */

namespace mongoliax\includes\cp_Security;

class cpSecurity {

//put your code here
    private $dbMan;
    private $options = ['cost' => 12,];
    public $App_Config;
    private $validUserDetails;
    private $bcrypt;

    public function __construct() {
        $this->dbMan = new \mongoliax\includes\MysqliDb\MysqliDb();
        $this->bcrypt = new \mongoliax\includes\cp_bcrypt\Bcrypt();
    }

    public function isUserLogged() {
        if (isset($_SESSION["user_code"]) && $_SESSION["user_level"] === 1) {
            return true;
        } else if (isset($_SESSION["fb_user_code"])) {
            return true;
        } else {
            return false;
        }
    }

    public function isOldPasswordValid($userName, $oldPassword) {
        $this->dbMan->where("officer_username", $userName);
        $columns = array("officer_password", "officer_username", "code_officer", "officer_realname", "officer_access_codes", "officer_access_menus");
        $userDetails = $this->dbMan->getOne("mglx_officers", $columns);

        if ($this->bcrypt->checkPassword($oldPassword, $userDetails['officer_password'])) {
            $this->validUserDetails = $userDetails;
            return true;
        } else {
            return false;
        }


        /* if (password_verify($oldPassword, $user['moba_password'])) {
          return true;
          } else {
          return false;
          } */
    }

    public function setUserPasswordUpdate($userCode, $newPassword) {
        //$newPassword = password_hash($newPassword, PASSWORD_BCRYPT, $this->options);
        $newPassword = $this->bcrypt->hashPassword($newPassword, 3);

        $data = Array(
            'moba_password' => $newPassword
        );

        $this->dbMan->where('moba_code', $userCode);
        if ($this->dbMan->update('moba_users', $data))
            return true; //echo $this->dbMan->count . ' records were updated';
        else
            return false; //echo 'update failed: ' . $db->getLastError();
    }

    public function checkControlPanelLanguage($tobeChangeLang = NULL) {
        $backdata = "";
        if (empty($tobeChangeLang)) {
            $tobeChangeLang = $this->App_Config['cookie_system_default_lang'];
        }

        if (!isset($_COOKIE[$this->App_Config['cookie_system_lang']])) {
            //setcookie($this->App_Config['cookie_system_lang'], $tobeChangeLang, time() + ($this->App_Config['user_cookie_expire_time'])); // 86400 = 1 day
            setcookie($this->App_Config['cookie_system_lang'], $tobeChangeLang, time() + ($this->App_Config['user_cookie_expire_time']), "/", "", FALSE, TRUE); // 86400 = 1 day
            $backdata .= "System language is set in (" . strtoupper($tobeChangeLang) . ").";
        } else {
            //setcookie($this->App_Config['cookie_system_lang'], $tobeChangeLang, time() + ($this->App_Config['user_cookie_expire_time'])); // 86400 = 1 day
            setcookie($this->App_Config['cookie_system_lang'], $tobeChangeLang, time() + ($this->App_Config['user_cookie_expire_time']), "/", "", FALSE, TRUE); // 86400 = 1 day
            $backdata .= "System language is set in (" . strtoupper($tobeChangeLang) . ").";
        }
        return $backdata;
    }

    private function generateUserCookie() {
        if (!empty($this->validUserDetails)) {
            //setcookie($this->App_Config['user_cookie_access_codes'], $this->validUserDetails['officer_access_codes'], time() + ($this->App_Config['user_cookie_expire_time'])); // 86400 = 1 day
            setcookie($this->App_Config['user_cookie_access_codes'], $this->validUserDetails['officer_access_codes'], time() + ($this->App_Config['user_cookie_expire_time']), "/", "", FALSE, TRUE); // 86400 = 1 day
            //
            //setcookie($this->App_Config['user_cookie_name'], $this->validUserDetails['officer_username'], time() + ($this->App_Config['user_cookie_expire_time'])); // 86400 = 1 day
            setcookie($this->App_Config['user_cookie_name'], $this->validUserDetails['officer_username'], time() + ($this->App_Config['user_cookie_expire_time']), "/", "", FALSE, TRUE); // 86400 = 1 day

            $cookieUserDetails = $this->validUserDetails['officer_realname'] . "|";

            //setcookie($this->App_Config['user_cookie_details'], $cookieUserDetails, time() + ($this->App_Config['user_cookie_expire_time'])); // 86400 = 1 day
            setcookie($this->App_Config['user_cookie_details'], $cookieUserDetails, time() + ($this->App_Config['user_cookie_expire_time']), "/", "", FALSE, TRUE); // 86400 = 1 day
            //setcookie($this->App_Config['user_cookie_access_menus'], $this->validUserDetails['officer_access_menus'], time() + ($this->App_Config['user_cookie_expire_time'])); // 86400 = 1 day
            setcookie($this->App_Config['user_cookie_access_menus'], $this->validUserDetails['officer_access_menus'], time() + ($this->App_Config['user_cookie_expire_time']), "/", "", FALSE, TRUE); // 86400 = 1 day

            setcookie($this->App_Config['user_cookie_officer_code'], $this->validUserDetails['code_officer'], time() + ($this->App_Config['user_cookie_expire_time']), "/", "", FALSE, TRUE); // 86400 = 1 day
        }
    }

    public function checkThisUserHasValidAccess($pass_user_name, $pass_user_password) {
        if ($this->isOldPasswordValid($pass_user_name, $pass_user_password)) {
            $this->generateUserCookie();
            return "user_is_valid";
        } else {
            return "user_is_not_valid";
        }
    }

    /*
      Array
      (
      [newUsername] => officer02
      [newUserPassword] => 123456
      [newRealName] => delger
      [newUserEmail] => delger@gmail.com
      [newUserWebsiteURL] => www.google.mn
      [newUserFacebookURL] => facebook
      [newUserTwitterURL] => twitter
      [newUserYoutubeURL] => youtube
      [newUserGoogleURL] => google
      [newUserStatus] => 1
      [newUserLevel] => 2
      [newUserOnContactPage] => 1
      [btn_InsertNewAuthorUser] =>
      )
     */

    public function insertNewAuthorUser($postData) {
        $backdata = "";
        $new_code_officer = substr(md5(rand(10000, 90000) . "_" . rand(2000, 9000) . "_" . rand(101000, 900900)), 0, 20);
        $new_officer_activation_key = substr(md5(rand(10000, 90000) . "_" . rand(2000, 9000) . "_" . rand(101000, 900900)) . md5(rand(10000, 90000) . "_" . rand(2000, 9000) . "_" . rand(101000, 900900)), 0, 60);

        $postData['newUserPassword'] = $this->bcrypt->hashPassword($postData['newUserPassword'], 3);

        $data = Array(
            'code_sector' => 1000,
            'access_code' => 'ABC',
            'code_officer' => $new_code_officer,
            'officer_username' => $postData['newUsername'],
            'officer_password' => $postData['newUserPassword'],
            'officer_realname' => $postData['newRealName'],
            'officer_email' => $postData['newUserEmail'],
            'officer_website' => $postData['newUserWebsiteURL'],
            'officer_facebook' => $postData['newUserFacebookURL'],
            'officer_twitter' => $postData['newUserTwitterURL'],
            'officer_youtube' => $postData['newUserYoutubeURL'],
            'officer_googleplus' => $postData['newUserGoogleURL'],
            'officer_status' => $postData['newUserStatus'],
            'officer_displaynote' => $postData['previewNoteAuthor'],
            'officer_level' => $postData['newUserLevel'],
            'officer_on_page' => $postData['newUserOnPage'],
            'officer_activation_key' => $new_officer_activation_key,
            'officer_access_codes' => '',
            'officer_updated' => $this->dbMan->now(),
            'officer_registered' => $this->dbMan->now()
        );
		/*
        $new_system_user_id = $this->dbMan->insert('mglx_officers', $data);
        if ($new_system_user_id) {
            $backdata .="#" . $new_system_user_id . ' ID data inserted. <br/>';
        } else {
            $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
        }
		*/
		echo("delger: " . $postData['newUserPassword']);
        return $backdata;
    }

    public function insertNewSystemUser($postData) {
        $backdata = "";
        $new_code_officer = substr(md5(rand(10000, 90000) . "_" . rand(2000, 9000) . "_" . rand(101000, 900900)), 0, 20);
        $new_officer_activation_key = substr(md5(rand(10000, 90000) . "_" . rand(2000, 9000) . "_" . rand(101000, 900900)) . md5(rand(10000, 90000) . "_" . rand(2000, 9000) . "_" . rand(101000, 900900)), 0, 60);

        $postData['newUserPassword'] = $this->bcrypt->hashPassword($postData['newUserPassword'], 3);

        $data = Array(
            'code_sector' => $postData['newUserRelatedSector'],
            'access_code' => 'ABC',
            'code_officer' => $new_code_officer,
            'officer_username' => $postData['newUsername'],
            'officer_password' => $postData['newUserPassword'],
            'officer_realname' => $postData['newRealName'],
            'officer_email' => $postData['newUserEmail'],
            'officer_url' => $postData['newUserURL'],
            'officer_status' => 1,
            'officer_displaynote' => 'fill it by your note',
            'officer_level' => 1,
            'on_contact_page' => 0,
            'officer_activation_key' => $new_officer_activation_key,
            'officer_access_codes' => '',
            'officer_updated' => $this->dbMan->now(),
            'officer_registered' => $this->dbMan->now()
        );

        $new_system_user_id = $this->dbMan->insert('mglx_officers', $data);
        if ($new_system_user_id) {
            $backdata .= $new_system_user_id . ' id data inserted. <br/>';
        } else {
            $backdata .= 'Error: ' . $this->dbMan->getLastError() . "<br/>";
        }

        return $backdata;
    }

    private function updateOfficerResetKey($recoveryEmail) {
        $backdata = "";
        $newResetKey = md5(mt_rand());
        $data = Array(
            'officer_reset_key' => $newResetKey,
            'officer_updated' => $this->dbMan->now()
        );

        $this->dbMan->where("officer_email", $recoveryEmail);
        if ($this->dbMan->update('mglx_officers', $data)) {
            $backdata .= $this->dbMan->count . ' record(s) are updated. <br/>';
        } else {
            $backdata .= 'Reset key update failed: error is ' . $this->dbMan->getLastError() . "<br/>";
        }

        return $newResetKey;
    }

    public function checkAvialableToRecoverByEmail($recoveryEmail) {
        $this->dbMan->where("officer_email", $recoveryEmail);
        $columns = array('officer_email', 'officer_realname');
        $gobi_officers = $this->dbMan->getOne("mglx_officers", $columns);
        if (!empty($gobi_officers)) {
            $newGenResetKey = $this->updateOfficerResetKey($recoveryEmail);
            $to = $recoveryEmail;
            $subject = "Password recovery email | MongoliaX";
            $message = "<h4>Сайн байна уу, " . $gobi_officers['officer_realname'] . " </h4>";
            $message .= "<b>MongoliaX.MN веб сайт дээрхи таны хэрэглэгчийн нууц үгээ та мартсан тул сэргээхийг хүссэн байна.</b><br/>";
            $message .= "<b>Тиймээс бид энэ и-мэйлыг таны нууц үгийг сэргээхээр илгээж байна.</b><br/>";
            $message .= "<b>Доорхи хаяг дээр дарж MongoliaX.MN дээрхи өөрийн нууц үгийг сэргээж авна уу.</b><br/>";
            $message .= "<a href='http://mongoliax.mn/reset-password/?key={$newGenResetKey}'>reset password</a><br/><br/>";
            $message .= "<b>хэрэв холбоос хаяг ажиллахгүй бол доод хаягыг хуулж аваад хөтөч програм дээр ажиллуулан уу!.</b><br/><br/>";
            $message .= "<p>http://mongoliax.mn/reset-password/?key={$newGenResetKey}</p><br/><br/>";
            $message .= "<b>Баярлалаа.</b><br/>";
            $header = "From:email@mongoliax.mn \r\n";
            //$header .= "Cc:afgh@somedomain.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            $mailSendStatus = mail($to, $subject, $message, $header);

            if ($mailSendStatus == true) {
                return "valid_email_sent";
            } else {
                return "valid_email";
            }
        } else {
            return "wrong_email";
        }
    }

}
