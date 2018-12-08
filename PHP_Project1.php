
class Pet {
	public $cName;
	public $cAge;
	public $cNoise;
	public $cPetType;
	public $cNameList;
	public $cNameListCount=0;
	public $cSpeakCount=0;
	
	public function getType()
	{
		return $this->cPetType;
	}
	
	public function getName()
	{
		return $this->cName;
	}
	
	public function setName($Name)
	{
		
		if (isset($Name))
		{
			$this->cNameList[$this->cNameListCount]=$this->cName;
			$this->cNameListCount++;
			$this->cName=$Name;
        } else {
            $this->cName=$Name;
            $this->cNameListCount=0;
        }
	}
    
	public function getNameLengthAverage()
	{
		$totalLength=strlen($this->cName);
		$nameCount=1;
		for ($i=0;$i<$this->cNameListCount;$i++)
		{
			$totalLength+=strlen($this->cNameList[$i]);
			$nameCount++;
		}
		return $totalLength/$nameCount;
	}
        
	public function getAge()
	{
		return $this->cAge;
	}
    public function setNoise($Noise)
	{
		$this->cNoise=$Noise;
	}
	
	public function getNoise()
	{
		return $this->cNoise;
	}
}

class Dog extends Pet{	
	public function __construct($Name, $Type, $Age,$Noise)
	{
			$this->cName=$Name;
			$this->cAge=$Age;
			$this->cPetType=$Type;
			if (isset($Noise))
                $this->cNoise=$Noise;
            else
                $this->cNoise="bow-wow";
            $this->cDefNoise="bow-wow";
            echo $this->cName, " is currently ", $this->cAge," years old.\n";

	}

	public function getType()
	{
		return "dog";
	}
    public function speak()
	{
		if ($this->cSpeakCount) {
        	echo "Adding year ","\n";
			$this->cSpeakCount=0;
			$this->cAge++;
		} else
			$this->cSpeakCount++;
        echo $this->cName, " says ",$this->cNoise,". Nah, ",$this->cName," says ",$this->cDefNoise,"! Now ",$this->cName," is ",$this->cAge," years old.\n";
        return $this->cNoise;
	}

}

class Cat extends Pet{	
	public function __construct($Name, $Type, $Age,$Noise)
	{
			$this->cName=$Name;
			$this->cAge=$Age;
			$this->cPetType=$Type;
            if (isset($Noise))
                $this->cNoise=$Noise;
            else
			    $this->cNoise="meow";
            echo "The cat's name is ",$this->cName,".\n";
	}
 	public function getType()
	{
		return "cat";
	} 
    public function defNoise()
    {
        return "meow";
    }
    public function speak()
	{
		if ($this->cSpeakCount) {
        	echo "Adding year ","\n";
			$this->cSpeakCount=0;
			$this->cAge++;
		} else
			$this->cSpeakCount++;
        echo $this->cName, " says ",$this->cNoise,". Nah,",$this->cName," says ",$this->cDefNoise,"!"," Now ",$name," is ",$this->cAge," years old.\n";
        return $this->cNoise;
	}


}

////// MAIN RUN  ////////////

$cmdline="";
$type="";
$name="";
$age=0;

function processCommands($cmd,$type,$name,$arg1,$arg2,$arg3) 
{

	global $array;
	
	switch ($cmd) 
	{
		case "new":
			$age=rand($arg1,$arg2);		
			if ($type=="dog") 
			{
				$newDog=new Dog($name,"dog",$age,$arg3);
				$array[$name]=$newDog;
			} else if ($type=="cat")
			{
				$newCat=new Cat($name,"cat",$age,$arg3);
				$array[$name]=$newCat;
			}
			break;
		case "speak":
			$noise=$array[$name]->speak();
			break;
		case "age":
			$petAge=$array[$name]->getAge();
			echo $name, " is currently ",$petAge," years old.\n";
			break;
		case "avg":
			$petAvg=$array[$name]->getNameLengthAverage();
			break;
		case "noise":
			$noise=$arg1;
			$array[$name]->setNoise($noise);
			break;
		case "getname":
            echo "The ",$type,"'s name is ",$name,"\n";
			break;
		case "newname":
			$newName=$arg1;
			$array[$name]->setName($newName);
            $array[$newName]=$array[$name];
            unset($array[$name]);
            $array[$newName]->getName();
            echo "The ",$type, "'s name has been changed to ",$newName,"."," The average length of the ",$type, "'s name is ", $array[$newName]->getNameLengthAverage();
			break;
		default:
			echo "Error: Invalid Command: ",$cmd,"\n";
	}
	return;
}

processCommands("new","dog","Santas Little Helper",1,3,"meow");
processCommands("new","cat","Snowball II",3,5,"");
processCommands("speak","dog","Santas Little Helper",0,0,"");
processCommands("newname","cat","Snowball II","Garfield",0,"");
