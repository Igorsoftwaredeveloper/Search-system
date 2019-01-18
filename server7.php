<?php
header("Content-type: text/html; charset=utf-8");

class External {
	var $request, $out = array(), $state = array(1, 1, 1, 1, 1, 1);
	var $name = array('Google','Bing','Yahoo','Mail.ru','Rambler','Sputnik');
	
	function  Order()
	{
		for ($i = 0; $i <= count($this->name) - 1 ; $i++)
		{
			for($j = 0; $j < $i; $j++)
			{
				if ($this->out[$i] == $this->out[$j])
				{	
					$this->state[$i] = 0;
					$this->name[$j] = $this->name[$j] . ', ' . $this->name[$i];
				}	
			}
		}
	}

	function Setrequest() 
	{
		$this->request = urlencode($_GET[1]);
	}

	function Result ($link,$i)
	{
		$this->out[$i] = $link;
	}
	
}

class Internal {
	var $link = array(),$page = array(),$fullrequest = array();

	function Setfullrequest($request) 
	{
		$this->fullrequest[0] = 'https://www.startpage.com/do/search?cmd=process_search&enginecount=1&query='.$request;
		$this->fullrequest[1] = 'https://www.bing.com/search?q='.$request;
		$this->fullrequest[2] = 'https://ru.search.yahoo.com/search?p='.$request;
		$this->fullrequest[3] = 'http://go.mail.ru/search?q='.$request;
		$this->fullrequest[4] = 'http://nova.rambler.ru/search?query='.$request;
		$this->fullrequest[5] = 'http://www.sputnik.ru/search?q='.$request;
	}	

	
	function Parse()
	{
		for ($i=0;$i<=5;$i++)
		{
			$this->page[$i] = file_get_contents($this->fullrequest[$i]);
		}
	}
	
	
	function Mask()
	{
		preg_match_all('#<h3 class="search-item__title"><a href="(.*?)"  target="_blank#',$this->page[0],$this->link[0]);
		preg_match_all('#<li class="b_algo"><h2><a href="(.*?)" h="ID=SERP,#',$this->page[1],$this->link[1]);
		preg_match_all('#<a class=" ac-algo fz-l ac-21th lh-24" href="(.*?)" target#',$this->page[2],$this->link[2]);
		preg_match_all('#","url":"(.*?)"#',$this->page[3],$this->link[3]);
		preg_match_all('#<a target="_blank" tabindex="2" class="b-serp-item__link" href="(.*?)"#',$this->page[4],$this->link[4]);
		preg_match_all('#<div class="b-result-title"><a href="(.*?)"#',$this->page[5],$this->link[5]);
	}		
	
}

$Interface = new External;
$Interface->Setrequest();
$Handler = new Internal;

$Handler->Setfullrequest($Interface->request);
$Handler->Parse();
$Handler->Mask();

for ($i=0;$i<=5;$i++)
{
	$Interface->Result($Handler->link[$i][1][0],$i);
}

$Interface->Order();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Search</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
 
	<img type="logo" src="pic.png" alt="100%">
	
	<form action="server7.php">
		<input class="layer1" type="text" placeholder="Enter request" name="1" value="<?=$_GET[1];?>" required /><br />
		<input class="layer2" type="submit" value="Search" />
	</form>

	<?php 
	
	$error = 1;
	for ($i=0;$i<=5;$i++)
	{
		if (!empty($Interface->out[$i]) && $Interface->state[$i]) {
			echo '<a href="'.$Interface->out[$i].'">'.$Interface->out[$i].'</a> <span>by '.$Interface->name[$i].'</span><br />';
			$error = 0;
		}
	}
	if ($error) {
		echo 'Nothing is found.';
	}
	
	?>

</body>
</html>
