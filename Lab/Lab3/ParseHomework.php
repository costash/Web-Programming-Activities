<pre><?php
interface IParseHomework {
   public function __construct ($nume_tema);
   public function getNumeTema();
   public function __toString ();
}

function generateRandomString($length = 16) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
return $randomString;
}

class ParseHomework implements IParseHomework {
	private $nume_tema;
	private $nume;
	private $prenume;
	private $grupa;
	private $tema;
	private $materie;
	private $numarTaskuri;
	private $scores;
	function __construct ($nume_tema) {
		$this->nume_tema = $nume_tema;
		list($this->nume, $this->prenume, $this->grupa, $this->tema, $this->materie) = explode(".", $nume_tema);
		$this->scores = array();
	}
	function getNumeTema() {
		return $this->nume_tema;
	}
	function __toString() {
		return '['.$this->nume.','.$this->prenume.','.$this->grupa.','.$this->tema.','.$this->materie.']';
	}
	function setNumberOfTasks () {
		list($crap, $numar) = explode("Tema", $this->tema);
		echo 'crap'.$crap.','.$numar."\n";
		$this->numarTaskuri = rand(2, 10) / $numar + 1;
	}
	function getNumOfTasks() {
		return $this->numarTaskuri;
	}
	function getScores() {
		return $this->scores;
	}
	function initScore() {
		for ($x = 1; $x <= $this->numarTaskuri; $x++) {
			array_push($this->scores, array());
		}
	}
	function checkTasks() {
		for ($x = 0; $x < $this->numarTaskuri; $x++) {
			$this->scores[$x]["nota"] = rand(1, 10);
			$this->scores[$x]["obs"] = generateRandomString();
		}
	}
	function sortTasks() {
		for ($x = 0; $x < $this->numarTaskuri - 1; $x++) {
			for ($y = $x + 1; $y < $this->numarTaskuri; $y++) {
				if ($this->scores[$x]['nota'] > $this->scores[$y]['nota']) {
					$temp = $this->scores[$x]['nota'];
					$this->scores[$x]['nota'] = $this->scores[$y]['nota'];
					$this->scores[$y]['nota'] = $temp;
				}
			}
		}
	}
}

$test = new ParseHomework('Chelcioiu.Ionut-Daniel.341C1.Tema1.PW.zip');
echo $test."\n";
echo 'numar taskuri = '.$test->getNumOfTasks()."\n";
$test->setNumberOfTasks();
echo 'numar taskuri setate = '.$test->getNumOfTasks()."\n";

var_dump($test->getScores());
$test->initScore();
var_dump($test->getScores());

echo "Checking tasks ... \n";
$test->checkTasks();
var_dump($test->getScores());

echo "Sorting by grade ...\n";
$test->sortTasks();
var_dump($test->getScores());

?></pre>