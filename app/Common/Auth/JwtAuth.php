<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/25 0025
 * Time: 23:10
 */
namespace App\Common\Auth;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;

/**
 * 单例
 * Class JwtAuth
 * @package App\Common\Auth
 */
class JwtAuth
{
    private $token;
    private $iss = 'api.test.com';
    private $aud = 'imooc_server_app';
    private $uid;
    private $secrect = '#HHHHGKIh*t*guitg&%R7YF&r&*F';
    /**
     * 用户传过来的decodeToken
     * @var
     */
    private $decodeToken;
    private static $instance;

    /**
     * 获取jwtAuth的句柄
     * @return JwtAuth
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    private function __construct()
    {
    }
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public function getToken()
    {
        return (string)$this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }
    public function encode()
    {
        $time = time();
        /*$this->token = (new Builder())->setHeader('alg', 'HS256')
            ->setIssuer($this->iss)
            ->setAudience($this->aud)
            ->setIssuedAt($time)
            ->setExpiration($time + 3600)
            ->set('uid', $this->uid)
            ->sign(new Sha256(), $this->secrect)
            ->getToken();*/
        $this->token = (new Builder())->issuedBy('http://example.com') // Configures the issuer (iss claim)
            ->permittedFor('http://example.org') // Configures the audience (aud claim)
            ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
            ->issuedAt($time) // Configures the time that the token was issue (iat claim)
            ->expiresAt($time + 3600) // Configures the expiration time of the token (exp claim)
            ->withClaim('uid', $this->uid) // Configures a new claim, called "uid"
            ->getToken(new Sha256(), new Key($this->secrect)); // Retrieves the generated token
        return $this;
    }

    public function decode()
    {
        if (!$this->decodeToken) {
            $this->decodeToken = (new Parser())->parse((string)$this->token);
            $this->uid = $this->decodeToken->getClaim('uid');
        }
        return $this->decodeToken;
    }

    public function verify()
    {
        $result = $this->decode()->verify(new Sha256(), $this->secrect);
        return $result;
    }
    public function validate()
    {
        $data = new ValidationData();
//        $data->setIssuer();
//        $data->setAudience();
        $data->setIssuer('http://example.com');
        $data->setAudience('http://example.org');
        $data->setId('4f1g23a12aa');

        return $this->decode()->validate($data);
    }
}