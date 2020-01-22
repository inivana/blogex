<?php
define('COOKIE_EXPIRE', 5 * 60);
define('COOKIE_NAME', 'sessval');

class Session
{
    static function create($user_id)
    {
        if (Session::exists()) {
            return true;
        }

        $db = new Database;

        do {
            $session_value = sha1(uniqid(time() + $_SERVER['REMOTE_ADDR']));
            $result = $db->where("ID", "sessions", "value = '" . $session_value . "'");

            if (!count($result)) {
                break;
            }
        } while (1);

        setcookie(COOKIE_NAME, $session_value, time() + COOKIE_EXPIRE, "/");
        $db->query(sprintf('INSERT INTO sessions(Value, UserID, IP, Browser) VALUES("%s", "%s", "%s", "%s")',
            $session_value,
            $user_id,
            $_SERVER['REMOTE_ADDR'],
            $_SERVER['HTTP_USER_AGENT']
        ));

        return true;
    }

    public static function exists()
    {
        if (!array_key_exists(COOKIE_NAME, $_COOKIE))
            return false;

        $db = new Database;

        $session_value = $_COOKIE[COOKIE_NAME];

        $result = $db->query('SELECT * FROM sessions WHERE value="' . $session_value . '" AND date > NOW() - INTERVAL ' . COOKIE_EXPIRE . ' SECOND AND Expired = 0');

        if (!$result) {
            return false;
        }

        return true;
    }

    public static function regenerate()
    {
        if (Session::exists()) {
            $db = new Database;

            setCookie(COOKIE_NAME, $_COOKIE[COOKIE_NAME], time() + COOKIE_EXPIRE, "/");
            $db->query('UPDATE sessions SET time = NOW() WHERE value = "' . $_COOKIE[COOKIE_NAME] . '"');
            return true;
        }
        return false;
    }

    public static function destroy()
    {
        if (Session::exists()) {
            $db = new Database;

            setCookie(COOKIE_NAME, "", time() - 5, "/");
            echo 'UPDATE sessions SET Expired = 1 WHERE value = "' . $_COOKIE[COOKIE_NAME] . '"';
            $db->query('UPDATE sessions SET Expired = 1 WHERE value = "' . $_COOKIE[COOKIE_NAME] . '"');
            return true;
        }
        return false;
    }

    public static function get_user_id()
    {
        if (Session::exists()) {
            $db = new Database;

            $result = $db->query('SELECT * FROM sessions WHERE value="' . $_COOKIE[COOKIE_NAME] . '"');

            if (array_key_exists("UserID", $result[0])) {
                return $result[0]["UserID"];
            }
        }
        return null;
    }

    public static function garbage_collector()
    {
        $db = new Database;
        $db->query('UPDATE sessions SET expired = 1 WHERE time < NOW() - INTERVAL ' . COOKIE_EXPIRE . ' SECOND');
    }
}

?>