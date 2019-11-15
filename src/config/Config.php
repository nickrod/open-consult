<?php

//

namespace openconsult\config;

//

use PDO;
use PDOException;
use Mobile_Detect;
use openconsult\exceptions\OpenconsultException;
use openconsult\tools\Singleton;

//

class Config extends Singleton
{
  // pdo connection

  protected $pdo;

  // pdo options

  private $pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
  ];

  // dsn

  private $dsn;

  // db username

  private $username;

  // db password

  private $password;

  // db settings ini

  private $db_settings = '/usr/local/include/simpleconsulting.ini';

  // site url

  private const SITE_URL = "https://www.simpleconsulting.io/";

  // constructor

  public function __construct()
  {
    // set the session

    if (!session_id())
    {
      session_start();
    }

    // detect mobile and set session var

    if (!isset($_SESSION['is_mobile']))
    {
      $detect = new Mobile_Detect();

      //

      if ($detect->isMobile())
      {
        $_SESSION['is_mobile'] = 1;
      }
      else
      {
        $_SESSION['is_mobile'] = 0;
      }
    }

    // load db options

    $this->loadDbSettings();

    //

    if (!empty($this->dsn) && !empty($this->username) && !empty($this->password) && !empty($this->pdo_options))
    {
      try
      {
        $this->pdo = new PDO($this->dsn, $this->username, $this->password, $this->pdo_options);
      }
      catch (PDOException $e)
      {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
      }
    }
  }

  // getters

	public function getPdo()
  {
    return $this->pdo;
	}

  // setters

	public function setDbSettings($db_settings)
  {
    if (file_exists($db_settings))
    {
      $this->db_settings = $db_settings;
    }
	}

  //

	public function setPdoOptions($pdo_options)
  {
    if (is_array($pdo_options))
    {
      $this->pdo_options = $pdo_options;
    }
	}

  //

  private function loadDbSettings()
  {
    if (!empty($this->db_settings) && file_exists($this->db_settings))
    {
      if (!$settings = parse_ini_file($this->db_settings, true))
      {
        throw new OpenconsultException(27, __METHOD__);
      }

      //

      $this->dsn = $settings['database']['driver'] . ':host=' . $settings['database']['host'] . ';port=' . $settings['database']['port'] . ';dbname=' . $settings['database']['dbname'] . ";options='-c client_encoding=" . $settings['database']['charset'] . "'";
      $this->username = $settings['database']['username'];
      $this->password = $settings['database']['password'];
    }
  }
}
