<?php

# # Author mcdwayne 
# # email 1dwayne.mcdaniel @ gmail.com
# # website https://mcdwayne.com
# # github https://github.com/mcdwayne/ 
# # license: MIT License, https://github.com/mcdwayne/yeOleTerminusQuest/blob/master/LICENSE
# no
# Version 1.0
# All commands Tested against:  
# 	Terminus v2.0, 
#	PHP 7.2.9


# DESCRIPTION
# Learning Terminus has never been more like Zork.  
# Get ready to do what a Wizard says, meet robots and rescue the Terminus art!
#
# To to play:
#	1. Open your terminal
#	2. cd to wherever you put this file
#	3. run `php yeOleTerminusQuest.php`
#
#
#
#   Ready to go?  Why are you still reading this.


///////////////////////////////////////////////////////////
  ///                         /////////////////////////////
  //   Global Tools- GLBLTL   /////////////////////////////
 ///                          /////////////////////////////
///////////////////////////////////////////////////////////

/*
Clear the screen with this handy function. 
Thanks to 
https://gist.github.com/icebreaker/4130200
*/

 	function cls(){
    	print("\033[2J\033[;H");
    	return;
	}




function gamerun() {

///////////////////////////////////////////////////////////
  ///                     /////////////////////////////////
  //   Globals - GLBLS    /////////////////////////////////
 ///                      /////////////////////////////////
///////////////////////////////////////////////////////////

global $theUser;
global $roomNumber;
global $roomDescriptions;
global $roomTitle;
global $terminusCommandValue;



///////////////////////////////////////////////////////////
  ///                      ////////////////////////////////
  // Room Creation - RMCRN ////////////////////////////////
 ///                       ////////////////////////////////
///////////////////////////////////////////////////////////

 $roomDescriptions = array();
 $roomTitle = array();

// Room 1
    $roomDescriptions[1] = "The First room. It is dark and smells like stale coffee.\n\nThere is a Wizard in the corner hunched over a glowing terminal grumbling to himself.\n\nThere is an exit to the South";
    $roomTitle[1] = "You are in The First room.";
// Room 2
    $roomDescriptions[2] = "You are now in the Mirror Room.\nThere is a hazy mirror with a plaque beside it.\n\nThere are exits to the North, East and West" ;
    $roomTitle[2] = "\nYou are in the Mirror Room.\n\n";
// Room 3
    $roomDescriptions[3] = "You are now in the Authentication room.\n\nThere is a desk with a robot behind it.\n\nThere is an exit to the West" ;
    $roomTitle[3] = "\nYou are in the Authentication room.\n\n";
// Room 4
    $roomDescriptions[4] = "You are now in The Cowgirl's Campsite\n\nThere is a cowgirl with a 10 gallon hat, chaps and spurs sitting beside a roaring camp fire. She is casting a lasso out into the darkness beyond the edge of the camp fire light.\n\nThere are exits to the West and North\n\n";
    $roomTitle[4] = "You are in The Cowgirl's Campsite";


///////////////////////////////////////////////////////////
  ///                       ///////////////////////////////
  //   Objects   - OBJCTS   ///////////////////////////////
 ///                        ///////////////////////////////
///////////////////////////////////////////////////////////


//
//	User Object - USR
//
  class userObject{
	public $name = "YOURNAME"; // hard coded to this.
	public $authenticated = false; // Am I logged into Terminus with my email and my machine token?
	public $level = 0; // Easy way to tell the game what you can and can't do yet and what the Wizard says
	public $inventory = array(); //associative array
	public $siteListArray = array(); //associative array
	public $authMachine = false;
	public $authEmail = false;

/*
Print The USer's Name
*/
    public function printName()
    {
        print( $this->name."\n\n"); 
    }
/*
 Level related
*/    
 	public function printLevel(){
 		print($this->level."\n\n");
 		return; 
 	}

    public function getLevel(){
    	return $this->level;
    }
    public function promoteLevel(){
    	$this->level = $this->level + 1;
    }

/*
 Authentication related to $authentication, $authMachine, and $authEmail
*/ 
	public function checkAuthMachine(){
		return $this->authMachine;
	} 
	public function setAuthMachine(){
		$this->authMachine = true;
	}
	public function checkAuthEmail(){
		return $this->authEmail;
	} 
	public function setAuthEmail(){
		$this->authEmail = true;
	}
    public function authenticateUser(){
    	$this->authenticated = true;
    }
    public function checkUserAuth(){
    	return $this->authenticated; 
    }

/*
 Inventory stuff
*/

    public function showInventory(){
    	cls();
    	print("Current Inventory:\n");
    	foreach( $this->inventory as $x => $x_value) {
  		print($x . "\n");
  		}
  		print("\n\n");
  		return;
     }

    public function addToInventory($item){
    	$this->inventory[$item] = $item;
    	return;
    }

    public function isItInInventory($doWeHaveIt){
    	foreach( $this->inventory as $x => $x_value) {
  			if ( $x == $doWeHaveIt ){
  			return true;
  		} 
    }
     return false;
  }
/*
 siteListArray stuff
*/

    public function showSiteList(){
    	cls();
    	print("Current Site List:\n");
    	foreach( $this->siteListArray as $x => $x_value) {
  		print($x . "\n");
  		}
  		print("\n\n");
  		return;
     }

    public function addToSiteListArray($site){
    	$this->siteListArray[$item] = $site;
    	return;
    }

    public function isThisSiteInTheSiteListArray($doWeHaveIt){
    	foreach( $this->siteListArray as $x => $x_value) {
  			if ( $x == $doWeHaveIt ){
  				return true;
  			} 
   		 }
     	return false;
 	}  
}
///////////////////////////////////////////////////////////
  ///                      ////////////////////////////////
  //   Functions - FNCTNS  ////////////////////////////////
 ///                       ////////////////////////////////
///////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////
  ///                                //////////////////////
  //   Non Player Characters - NPC   //////////////////////
 ///                                 //////////////////////
///////////////////////////////////////////////////////////


//
// THE WIZARD Function
//

  function wizard($level) {
  	global $theUser;

	switch ($level) {
		case '0':
			cls();
			print("The Wizard looks at you and says\n\"Welcome YOURNAME.  I am the Wizard.\n\nYou are here because the evil Lord GUI has stolen all the Terminus art for himself.  I am busy with the Fires of Clients and can not leave this terminal.\n\nYour mission, if you choose to accept it, will be to gather all the art files back together. Along the way you will need to use the mystical spells of Terminus.\n\nFortunately, I can give you help as you go. Simply return after you find a piece of art or if anyone or anything tells you that you need to.\n\nYou need to travel South to start your quest.\n\nGood luck\"\n\nAnd with that, the Wizard turns to his terminal, sees Slack and IRC alerts piling up and grumbles under his breath....\n\n");
			$theUser->promoteLevel();
			break;
		case '1':
			cls();
			print("The Wizard does not look up, but says \"Go talk to the dang robot\"\n");
			break;
		case '2':
			if ( $theUser->isItInInventory("PantheonMachineToken") ) {
				cls();
				print("The Wizard does not look up, but says \"Go talk to the dang robot\"\n");
				break;
			} else {
				cls();
				print("The Wizard looks at you and says\n\"Oh yeah, you need a Pantheon Machine Token. This is the last time you will have to use the Pantheon dashboard while on this adventure.  Go to your user dashboard and generate a new Machine Token from under account.  Then give it to the robot, you will user terminus for the first time when you do this.\"\nThe Wizard looks at his machine and sees it piling up with alerts and shakes his head.  He pulls a token out his pocket and throws it to you.\n\"OK, for today, just use this token I made for you.  You gotta use your own for other relms.  Go back and use the spell `terminus auth:login --machine-token=PantheonMachineToken`, and I will make that work for you.  In other realms, the Pantheon dashboard will automatically generate the command to copy/paste.\"\n The terminal behind the Wizard sets off alarm bells.\n\"OK, go talk to the robot again\"\nThe Wizard grumbles about a beeper alert and huddles back over the monitor.\n\nYou now have a PantheonMachineToken!!!\n\n");

				$theUser->addToInventory('PantheonMachineToken');
				break;
				}
		
		case '3' :
			cls();
			print("The Wizard jumps from his terminal, knocking over empty cans and empty snack packaging that had been piling up as he says\n\"You found a piece of Terminus art?!?!\nThat is outstanding YOURNAME!  I have just copied it back to the system.  You can keep that copy.\nIf you want to see what is in the art files you have collected so far, just invoke the `terminus art` spell and it will pick one at random.\nI think this means you are ready to go find the next piece of the puzzle\nBefore I forget, you can start from this checkpoint next time by using the command savepoint1 \n\n");
				$theUser->promoteLevel();
			break;

		case '4':
		case '5':
		case '6':
		case '7':
		case '8':
			cls();
			print("What are you waiting for?  I have stuff to do. Try `help` if you get stuck.\n\n");
			break;
		default:
			print("This option is not set yet\n\n");
			break;
	   	}	
     }
 

//
// THE Cowgirl Function
//

  function cowgirl($level) {
  	global $theUser;

// note: Lowest level you can be for getting to this room is 4 
	switch ($level) {
		case '4':
			cls();
			print("The Cowgirl looks at you, ties off her lasso to the log she has been sitting on and says\n\"Well howdy! You must be YOURNAME.  The Wizard told me you would be coming this way soon enough.  People round these parts call me The Cowgirl.\n\nI sure to appreciate anyone brave enough to try and get back all the Terminus art from that measly so-and-so Lord GUI.  I'd love to sock him right in the face, but I am too busy managing all them client sites to go adventuring myself.\n\nThe Wizard said I was supposed to teach you how to manage Sites and I would be happy to, but I reckon you didn't bring any sites with ya and I don't suppose you have a lasso yet either.\n\nWell, here's my spare lasso, so that is easy solved.\n\nAs far as the other thing, I know up North of here there is a good little site in The Pasture you could lasso. Once you lasso a site it is added to your Site List, which you can see now by running `terminus site:list`\"\n\nThe fire turns a bright red and flares up high into the stary sky.\n\nThe Cowgirl looks at the fire and grabs her lasso once more as she says \"Gosh darn it, the Fires of Clients are really raging tonight.  Go lasso that Site and hopefully it will be a bit more peaceful like when you get back. Happy trails partner.\"\n\n\nYou now have a Lasso\n\n");
			$theUser->promoteLevel();
			$theUser->addToInventory('Lasso');
			break;
		case '5':
			cls();
			print("Did you lasso that Site yet?\n\n\n");
			break;
		default:
			print("This option is not set yet\n\n");
			break;
	   	}	
   	}



///////////////////////////////////////////////////////////
  ///                                 /////////////////////
  //   Terminus Commands - TRMNSCMDS  /////////////////////
 ///                                  /////////////////////
///////////////////////////////////////////////////////////


function tryTerminusCommand($attemptedCommand, $roomThisCameFrom){ //1
		global $theUser;

   		if ($theUser->getLevel() == 0 ){   		
   			return "Not allowed to do Terminus stuff yet, talk to the Wizard" ;
   		} 

   		if ($theUser->getLevel() > 0 ) {
   			 
  			  if ( $attemptedCommand == "terminus auth:login --machine-token=pantheonmachinetoken"){
  			  	if ($roomThisCameFrom < 2 ) {
  			  	return "\nYou need to do this with the Robot the first time.\n\n";
  			  	}		
  			  $theUser->setAuthMachine();
  			  	

  				if ($theUser->checkAuthEmail() == false) {
  					 return "\n\nThe robot inspects the Pantheon Machine Token and nods as it speaks\n\"You have successfully authenticated with a Pantheon Machine Token\n\nNext you need to authenticate with the email address you use for Pantheon\nCast the spell `terminus auth:login --email=your@email.com` Actually, the Wizard said you can ONLY use that email address down here, so please enter it just like that and do not use your normal Terminus email.\"\n";
  				} else {
  						$theUser->authenticateUser();
  						$theUser->promoteLevel();
  		        		 return "\n The robot opens a drawer and brings out a bottle of champaign, pours you a glass and says\n\"You have successfully authenticated with your email address YOURNAME\n\nWhenever you need to know who you are, just cast the spell `terminus auth:whoami`.\"\n\n"; 
  		        	}
  			 	} 
  		

  			if ($attemptedCommand == "terminus auth:login --email=your@email.com") {
  		    	    if ($roomThisCameFrom < 2 ){
  		        		return "\nYou need to do this with the Robot the first time.\n\n";		
  		        		}
  		        	$theUser->setAuthEmail();
  		        
  		       		if( $theUser->checkAuthMachine() == false ) {
  		        		return "\nYou are now authenticated with your email, but you need to set that terminus token...scroll up to get the right one if you didn't cheat\n\n";
  		        	} else {
  		        		$theUser->authenticateUser();
  		        		return "\n The robot opens a drawer and brings out a bottle of champaign, pours you a glass and says\n\"You have successfully authenticated with your email address YOURNAME\n\nWhenever you need to know who you are, just cast the spell `terminus auth:whoami`.\"\n\n"; 
  		        		}  		   	
 		 	} 

 		if($attemptedCommand == "terminus auth:whoami" ) {
  				if ( $theUser->checkUserAuth() ) {
  				    return "\nyour@email.com\n\n";
  		    	} else{
  		    		return "\nYou can not yet do this spell\n";
  		    	}

   		}
   		if ($attemptedCommand == "terminus art") {
   			if ($theUser->getLevel() > 2 ) {
  				   return "hello world!\n\n";
  			}
  		}
   	}
   		return "\nI don't think that is a correct command\n\n" ;
} 

///////////////////////////////////////////////////////////
  ///                                 /////////////////////
  //   Standard Commands - CMDS       /////////////////////
 ///                                  /////////////////////
///////////////////////////////////////////////////////////


	function getTheCommand($roomThisCameFrom){
		global $theUser;
   		global $roomDescriptions;
   		global $terminusCommandValue;

   		$roomNumber = intval($roomThisCameFrom);
   		$terminusCommandValue = "" ;

		echo "yotq>$";

		$userinput = strtolower(rtrim(fgets(STDIN)));
		// echo $userinput;
		 if ( substr($userinput, 0, 8) == "terminus"){
		 	$terminusCommandValue = $userinput ;
		 	$userinput = "terminus" ;
		 	$terminusCommandValue = tryTerminusCommand($terminusCommandValue, $roomNumber);
		 	echo $terminusCommandValue;
		} 	

		switch ($userinput) {
////// Standard commands
			case 'look':
			case 'l' :
			   	cls();
			    print($roomDescriptions[$roomNumber]."\n\n") ;
					break;
			case 'exit' :
			case 'quit':
			case 'q' :
			    exit('Thanks for playing!'."\n");
			    break;
			case 'inventory':
			case 'in':
				$theUser->showInventory();
				break;
			case 'talk':
			   	print("\nTalk to who?\n\n");
			    break;
			case 'help':
			case 'h':
				cls();
				print("There are standard commands, you can always do some of them.  Here is a short list:"
					."\nLook or l - look around the room.  To look at a thing, look at the thing"
					."\nquit or q or exit"
					."\ninventory or in - show what you have in your inventory"
					."\ntalk - only works if there is someone to talk to"
					."\nhelp or h - this is how you got here"
					."\nTo move a direction you can type north, south, east or west or just n,s,e,w\n\n");
					break;
//////// Tools - can only use what you have
	////////
	// The lasso

			case 'lasso':
				if ( !$theUser->isItInInventory('Lasso') ){
					print("\nYou don't have a lasso.\n\n");
					break;	
					}
				print("\nLasso what?\n\n");
				break;			
			case 'lasso site':
				if ( !$theUser->isItInInventory('Lasso') ){
					print("\nYou don't have a lasso.\n\n");
					break;	
					}
				print("\nLasso which site?\n\n");
				break;

//////// SAVE POINTS
			case 'savepoint1':
			case 'sp1':
				$theUser->promoteLevel();
				$theUser->promoteLevel();
				$theUser->promoteLevel();
				$theUser->promoteLevel();
				$theUser->addToInventory('PantheonMachineToken');
				$theUser->addToInventory('terminus-art-hello-world.txt');
				$theUser->authenticateUser();
				break;
			case 'terminus':
				break;
//////// ADMIN TOOLS				
			case "print level":
			case 'pl':
				$theUser->printLevel();
				break;	
			case 'warp1':
			case 'w1':
				cls();
				room1();
				break;
			case 'warp3':
			case 'w3':
				cls();
				room3();
				break;
			case 'lvlup':
				$theUser->promoteLevel();
				$theUser->addToInventory('PantheonMachineToken');
				$theUser->authenticateUser();
				break;
			default:
				return $userinput ;
 	  			}
 	    		return "done";  //this was the cleanest way I could think of to handle Terminus calls.  
    }

///////////////////////////////////////////////
// Rooms 
///////////////////////////////////////////////

/////
//// Start Room 1
// RM1

    function room1() {
     global $theUser;
     global $roomNumber;
     global $roomDescriptions;
     global $roomTitle;
     global $terminusCommandValue;

     $roomNumber = 1;

		while(1) {
			print($roomTitle[$roomNumber]."\n\n");

				$userInputInRoom = getTheCommand($roomNumber);

				switch ($userInputInRoom) {
					case 'done':
						break;
					//Move to another room 
				    
				    case 'south':
				    case 's':
				    	if( $theUser->getLevel() == 0 ) {
				    		print("A powerful force of some kind hold you back.  Have you tried to talk to the wizard? yet?\n\n");
					    } else {
				    		cls();
				    		print($roomDescriptions[2]."\n") ;
					    	room2();
					    	break;

					    }
					case 'north':
					case 'n':
					  	print("You can not go that way");
						break;
					case 'west':
					case 'w':
					  	print("You can not go that way");
						break;
					case 'east':
					case 'e':
					  	print("You can not go that way");
						break;
					//Specific to this room    
					//wizard
					case "talk to the wizard":
					case "talk to wizard" :
					case 'tw':
				    	wizard($theUser->getLevel());
					    break;
					case "look at wizard":
						cls();
						print("He looks just like what you imagined a wizard would look like.\n");
						break;
				    default;
				    	echo "that was not a known command, try again.  Type 'help' for help "."\n";
				    	
				}
			  }
			} 	
///// End Room 1
/////


/////
//// Start Room 2
//// RM2
   function room2() {
        global $theUser;
        global $roomNumber;
        global $roomDescriptions;
        global $roomTitle;

        $roomNumber = 2;

		while(1) {
			print($roomTitle[$roomNumber]."\n\n");

				$userInputInRoom = getTheCommand($roomNumber);

				switch ($userInputInRoom) {
					case 'done':
						break;
			//Move to another room 
			    case 'north':
			    case 'n':
			    	cls();
			    	print($roomDescriptions[1]."\n") ;
				    room1();
				    break;
			    case 'south':
			    case 's':
			    	print("You can not go that way");
				    break;
				case 'west': 
				case 'w':
					cls();
					print($roomDescriptions[3]."\n") ;
				    room3();
					break;   
				case 'east':
				case 'e':
					if ($theUser->getLevel() > 3 ){
						cls();
						print($roomDescriptions[4]."\n") ;
				    	room4();
					} else{
						cls();
						print("You are not yet ready for this part of the quest!\n\n\n\n");
					}
					break;
	// Interact with Mirror and Plaque
		//The Plaque
			    case 'read':
					print("\n"."Read what?"."\n\n");
				    break;
				case "read the plaque":
				case "read plaque":
					cls();
					print("\n"."The Plaque says \"This mirror only works for those who know who they are.\nTry `terminus auth:whoami` to prove you know who you are.\"\n\n");
				    break;
				case "look at the plaque":
				case "look at plaque":
				case "look plaque":
					print("\n"."It has words on it, maybe read them\n\n");
				    break;
		// THE MIRROR
				case "look at mirror":
				case "look in mirror":
				case "look mirror":
					if ( $theUser->checkUserAuth() ) {
						cls();
						print("\n\nYou see your reflection\nA voice from within the mirror says:\n\"Greetings YOURNAME\nYou know thyself.  To thine own self be true\nWhen away from the mirror you can cast `terminus auth:whoami` to remind yourself who you are.\"\n\n");

					if ( !$theUser->isItInInventory('terminus-art-hello-world.txt') ) {	
									cls();
									print("\nYou notice a small file behind the mirror.  You reach out for it because Dwayne was too lazy to to put in logic to add a puzzle here for this release.\n\nYou now posses Terminus Art file terminus-art-hello-world.txt");
								$theUser->addToInventory("terminus-art-hello-world.txt");
								} 
						break;
					} else{
						cls();
						print("\n\nYou can only see a hazy fog in the mirror.\nA voice from within the mirror says: \"Only those who know who they are may use this mirror!\"\n\n");
						break;
					}
					
			    default;
			    	echo "that was not a known command, try again.  Type 'help' for help "."\n";
				}
			}	
		}
///// End room 2
/////

/////
//// Start Room 3
//// RM3
    function room3() {
     global $theUser;
     global $roomNumber;
     global $roomDescriptions;
     global $roomTitle;
     global $terminusCommandValue;

        $roomNumber = 3;

		while(1) {
			
			print($roomTitle[$roomNumber]."\n\n");

			$userInputInRoom = getTheCommand($roomNumber);

			switch ($userInputInRoom) {
				case 'done':
					break;
		//Move to another room 
				case 'south':
				case 's':
				  	print("You can not go that way");
					break;
				case 'north':
				case 'n':
				  	print("You can not go that way");
					break;
				case 'west':
				case 'w':
				  	print("You can not go that way");
					break;
		    	case 'east':
		    	case 'e':
		    		cls();
			    	print($roomDescriptions[2]."\n") ;
				    room2();
				    break;
		//Specific to this room
				//the robot
				case "look at robot":
					print("\nIt looks exactly like you imagined a robot would look like.\n\n");
					break;
				case "talk to robot":
				case 'tr':
					if ($theUser->checkUserAuth() == true){
						cls();
						print("\nThe robot looks up and says \"Greetings YOURNAME.  You are authenticated.  Remember, use `terminus auth:whoami` if you ever forget who you are\n\n");
					} else{
						cls();
						print("\nThe robot springs to life and looks you up and down.  After a few seconds it speaks:\n\"Greetings mystic knight.  I do not recognize you.  My job is to help knights who are deemed worthy to posses the powers of Terminus.\nSpeak the spells to authenticate to continue.\nIf you get stuck, ask the Wizard. \"\n\n");
						$theUser->promoteLevel();
					}
					break;	
					// if ( $theUser->isItInInventory('PantheonMachineToken') ){
					// print("You are now authenticated");
					exit;
				// }else{
				// 	print("You need a Pantheon Machine Token to do that!");
				// 	break;
				// }
				default;
				    echo "\nthat was not a known command, try again.  Type 'help' for help\n";
				    	
				}
		}
	} 	
////// END OF ROOM 3
//////	 

/////
//// Start Room 4
/// rm4	

  function room4() {
     global $theUser;
     global $roomNumber;
     global $roomDescriptions;
     global $roomTitle;

     $roomNumber = 4;

		while(1) {
			
			print($roomTitle[$roomNumber]."\n\n");
		
				$userInputInRoom = getTheCommand($roomNumber);
		
				switch ($userInputInRoom) {
					case 'done':
						break;
					//Move to another room 		
		         	case 'south':
				    case 's':
				   		print("You can not go that way");
				 		break;
					case 'north':
				 	case 'n':
				   		print("NOT DEFINED YET");
				 		break;
				 	case 'west':
				 	case 'w':
				 		cls();
			    		print($roomDescriptions[2]."\n") ;
				   		room2();
				 		break;
		  			case 'east':
		  			case 'e':
				   		print("You can not go that way");
				 		break;					
			// The Cowgirl	    
					case 'talk to cowgirl':
					case 'talk cowgirl':
				    	cowgirl($theUser->getLevel());
					    break;
					case "look at cowgirl":
					case "look cowgirl":
						cls();
						print("She has a 10 gallon hat, chaps and spurs, otherwise she looks just like what you imagined a cowgirl would look like.\n\n");
						break;


			 	    default;
		 	    	echo "that was not a known command, try again.  Type 'help' for help "."\n";	    //	
			     }
			}
		} 	


///// End Room 4

///////////////////////////////////////////////////////////
  ///                           ///////////////////////////
  //   Make Objects  MKOBJCTS   ///////////////////////////
 ///                            ///////////////////////////
///////////////////////////////////////////////////////////

	$theUser = new userObject;

///////////////////////////////////////////////////////////
  ///                                                  ////
  //   START THE DANG GAME BY GOING TO THE FIRST ROOM  ////
 ///   STRTGM                                          ////
///////////////////////////////////////////////////////////

	print($roomDescriptions[1]."\n\n" );
    room1(); 
}


cls();
print( "THIS IS YE OLE TERMINUS QUEST!\n\n" );

gamerun();



///////////////////////////////////////////////////////////
  ///                           ///////////////////////////
  //   Room Template  - RMTMPLT ///////////////////////////
 ///                            ///////////////////////////
///////////////////////////////////////////////////////////


  // function roomROOMNUMBER() {
  //    global $theUser;
  //    global $roomNumber;
  //    global $roomDescriptions;
  //    global $roomTitle;

  //    $roomNumber = ROOMNUMBER;

		// while(1) {
		//	
		// 	print($roomTitle[$roomNumber]."\n\n");
		//
		// 		$userInputInRoom = getTheCommand($roomNumber);
		//
		// 		switch ($userInputInRoom) {
		// 			case 'done':
		// 				break;
		// 			//Move to another room 
		//
		//          case 'south':
		//		    case 's':
		//		   		print("You can not go that way");
		//		 		break;
		//			case 'north':
		//		 	case 'n':
		//		   		print("You can not go that way");
		//		 		break;
		//		 	case 'west':
		//		 	case 'w':
		//		   		print("You can not go that way");
		//		 		break;
		//   		case 'east':
		//   		case 'e':
		//		   		print("You can not go that way");
		//		 		break;
		// 			
		//			//Specific to this room    
		//
		//          /*
		//					
		//
		//
		//
		//			*/
		//			
		//  	    default;
		//  	    	echo "that was not a known command, try again.  Type 'help' for help "."\n";	    //	
		// 	     }
		//	}
		//} 	
