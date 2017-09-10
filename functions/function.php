<?php

class URLShortener
{
	protected $db;

	public function __construct()
	{
		$this->db = new mysqli("localhost","root","","smalr");
		if($this->db->connect_errno)
		{
			header(("Error: 404"));
			die();
		}
	}

	public function generateCode($num)
	{
		$num=$num+10000000;
		return base_convert($num,10,36);
	}
	public function returnShortCode($url)
	{
		$url=trim($url);

		if(!filter_var($url,FILTER_VALIDATE_URL)){
			header("Location: ../index.php?error=inurl");
			die();
		}
		else
		{
			$url=$this->db->real_escape_string($url);
			$exist=$this->db->query("SELECT * FROM urlbank WHERE url='{$url}'");
			if($exist->num_rows)
			{
				$code = $exist->fetch_object()->shortcode;
				return $code;
			}
			else
			{
				$insert=$this->db->query("INSERT INTO urlbank (url,time_stamp) VALUES ('{$url}',NOW())");
				$fetch=$this->db->query("SELECT * FROM link WHERE url='{$url}'");
				$get_id = $fetch->fetch_object()->id;
				$secret = generateCode($get_id);

				$update = $this->db->query("UPDATE urlbank SET shortcode = '{$secret}' WHERE url = '{$url}'");
				return $secret;
			}
		}
	}


	public function returnShortCodeCustom($url,$custom){
		$url = trim($url);
		$custom = trim($custom);
		$url=$this->db->real_escape_string($url);
		if(filter_var($url,FILTER_VALIDATE_URL)){
			$insert=$this->db->query("INSERT INTO urlbank(url,code,created) VALUES ('{$url}','{$custom}',NOW())");
			return true;
		}
		return false;
	}

	 public function existsURL($short)
    {
        $short = $this->db->real_escape_string(strip_tags(addslashes($short)));
        $rows = $this->db->query("SELECT url FROM urlbank WHERE shortcode = '{$short}' LIMIT 1");
        return $rows->num_rows > 0;
    }

    public function getUrl($string){
    	$string = $this->db->real_escape_string(strip_tags(addslashes($string)));
    	$rows = $this->db->query("SELECT url FROM urlbank WHERE shortcode = '{$string}'");
    	if($rows->num_rows){
    		return $rows->fetch_object()->url;
    	} else{
    		header("Location: index.php?error=dnp");
    		die();
    	}

    }
}