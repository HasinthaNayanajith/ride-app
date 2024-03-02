<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'mdimuthusw@gmail.com';
    public string $fromName   = 'city-ride';

    public string $userAgent = 'CodeIgniter';
    public string $protocol = 'smtp';

    public string $SMTPHost = 'smtp.gmail.com';
    public string $SMTPUser = 'mdimuthusw@gmail.com'; 
    public string $SMTPPass = 'dwulosrdowtwxzxp'; 

    public int $SMTPPort = 587;
    public string $SMTPCrypto = 'tls';

    public bool $wordWrap = true;
    public int $wrapChars = 76;

    public string $mailType = 'text';
    public string $charset = 'UTF-8';

    public bool $validate = true;
    public int $priority = 3;

    public string $CRLF = "\r\n";
    public bool $BCCBatchMode = false;
    public int $BCCBatchSize = 200;
    public bool $DSN = false;
}
