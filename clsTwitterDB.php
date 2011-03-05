<?php
require_once('config.php');

/**
 * Description of clsTwitterDB
 *
 * @author andre
 */
class clsTwitterDB
{

    private $server = SERVERDB;
    private $user = USERDB;
    private $pass = PASSDB;
    private $con;
    private $db = DB;
    private $log = LOGDB;
	private $text = "";
	private $author = "";

    /* Database connection */
    function __construct()
    {
        $this->con = @mysql_connect($this->server,$this->user,$this->pass) or die(mysql_error());
        @mysql_select_db($this->db,$this->con);
    }


	function setText($text=null)
	{
		if($text)
		{
			$this->text = $text;
		}
	}

	function setAuthor($author=null)
	{
		if($author)
		{
			$this->author = $author;
		}
	}

    /* Insert twitter data on Log table */
    function insert_log()
    {
        $query = "INSERT INTO TB_LOG (NM_USER) VALUES ('".$this->author."')";
		mysql_query($query, $this->con) or die(mysql_error());
        return false;
    }

    function split()
    {
        $tw_text = str_split($this->text, 135);

		$total = count($tw_text);

        foreach($tw_text as $id => $data)
        {
            $text[] = $data.'['.($id+1).'/'.$total.']';
        }

		$this->text = $text;
    }

    function tweet()
    {
        //If the admin need to log tweets
        if($this->log)
        {
			$this->insert_log();
        }
		
		return $this->text;
    }
}
?>
