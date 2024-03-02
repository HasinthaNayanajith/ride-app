<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class PHPMailer extends BaseConfig
{
    public $SMTPHost = 'smtp.gmail.com';
    public $SMTPUser = 'mdimuthusw@gmail.com';
    public $SMTPPass = 'dwulosrdowtwxzxp';
    public $SMTPPort = 587;
    public $SMTPCrypto = 'tls';
    public $mailType = 'html';
    public $charset = 'UTF-8';
    public $validate = true;
    public $priority = 3;
}
