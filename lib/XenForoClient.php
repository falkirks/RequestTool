<?php
/*
 * XenForo client written in PHP
 * https://github.com/Falkirks/XenForo-Client
 */
class XenForoClient {
    private $c, $b, $u, $p;
  function __construct($url, $user, $pass) {
      $this->b = $url;
      $this->p = $pass;
      $this->u = $user;
      $this->c = [];
      if (!$this->connect($this->b, null)) throw new Exception;
      if (!$this->login($this->u, $this->p)) throw new Exception;
  }
  private function login($user, $password) {
        $result = $this->connect($this->b . '/login/login', [
            'login' => $user,
            'password' => $password,
            'register' => "0",
            'remember' => "1",
            'cookie_check' => "1",
            '_xfToken' => "",
            'redirect' => $this->b]);
        if (isset($this->c["xf_user"])) {
            return true;
        }
        else {
            return false;
        }
    }
  public function connect($url, $post) {
        global $http_response_header;
        if ($post != null) {
            $opts = ['http' =>
                ['method'  => 'POST',
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n" . $this->cookiesToString(),
                    'content' => http_build_query($post)]];
        }
        else {
            $opts = ['http' =>
                ['method'  => 'GET',
                    'header'  => $this->cookiesToString()]];
        }
        $res = file_get_contents($url, false, stream_context_create($opts));
        $cookies = [];
        foreach ($http_response_header as $hdr) {
            if (preg_match('/^Set-Cookie:\s*([^;]+)/', $hdr, $matches)) {
                parse_str($matches[1], $tmp);
                $cookies += $tmp;
            }
        }
        $this->c = array_merge($this->c, $cookies);
        return $res;
    }
  public function cookiesToString(){
        $ret = "Cookie: ";
        foreach ($this->c as $name => $val) {
            $ret .= $name . "=" . $val . "; ";
        }
        return $ret;
    }
}