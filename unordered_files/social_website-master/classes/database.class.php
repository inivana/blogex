<?php
  class Database extends MySQLi
  /*
   * IMPORTANT !!!
   * Przy zmianie interfejsu bazy danych
   * trzeba by nadpisać[w miarę potrzeby] niektóre metody i zmienne rodzica
   * takie jak query(), num_rows
   * ze względu na pierwotne przygotowanie tej bazy pod interfejs MySQLi
   */
  {
    function __construct()
    {
      parent::__construct('*', '*', '*');
      parent::select_db('zs1jas_1');
      parent::query("SET NAMES utf8");
    }
    function __destruct()
    {
      parent::close();
    }
  }
