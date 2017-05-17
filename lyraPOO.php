<?php 

class Message
{
	private $_time;
	private $_user;
	private $_content;

	public function __construct($t, $u, $c)
	{
		$this->setTime($t);
		$this->setUser($u);
		$this->setContent($c);
	}

	public function getTime()
	{
		return $this->_time;
	}

	public function getUser()
	{
		return $this->_user;
	}

	public function getContent()
	{
		return $this->_content;
	}

	public function setTime($time)
	{
		$this->_time = $time;
	}

	public function setUser($user)
	{
		$this->_user = $user;
	}

	public function setContent($content)
	{
		$this->_content = $content;
	}
}

class BDD
{
	public function getMessages($user = null, $time = 0)
	{
		$fname = "messages.txt";
		$file = fopen($fname, "r");

		$toReturn = array();

		if(!$file)
		{
			echo 'Erreur de lecture ...';
		}
		else
		{
			$content = fread($file, filesize($fname));
			$contentArray = explode(PHP_EOL, $content);

			foreach ($contentArray as $c)
			{
				$contentLine = explode("×", $c);
				$current = new Message($contentLine[0], $contentLine[1], $contentLine[2]);

				if($current->getTime() >= $time)
				{
					if($user != null)
					{
						$users = explode("|", $user);
						foreach ($users as $u)
						{
							if($u == $current->getUser())
							{
								$toReturn[] = $current;
							}
						}
					}
					else
					{
						$toReturn[] = $current;
					}
				}
			}
		}

		fclose($file);

		return $toReturn;
	}

	public function changeMessage($time, $user, $content, $newcontent)
	{
		$fname = "messages.txt";
		$file = fopen($fname, "r");

		unlink("messages2.txt");

		if(!$file)
		{
			echo 'Erreur de lecture ...';
		}
		else
		{
			$content = fread($file, filesize($fname));
			$contentArray = explode(PHP_EOL, $content);

			foreach ($contentArray as $c)
			{
				$contentLine = explode("×", $c);
				$current = new Message($contentLine[0], $contentLine[1], $contentLine[2]);

				if($current->getTime() == $time && $current->getUser() == $user && $current->getContent() == $content)
					$current->setContent($newcontent);

				$line = PHP_EOL . $current->getTime() . '×' . $current->getUser() . '×' . $current->getContent();
				file_put_contents("messages2.txt", $line, FILE_APPEND);
			}
		}

		fclose($file);

		return rename("messages2.txt", "messages.txt");
	}
}

?>