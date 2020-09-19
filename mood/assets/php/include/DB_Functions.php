<?php
 

 
class DB_Functions {
 
    private $conn;
 
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }
 
    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($birthdate, $email, $password, $username, $sequrity_q, $sequrity_a, $about) {
        
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
 
        $stmt = $this->conn->prepare("INSERT INTO users(name, dateOfBirth, email, encrypted_password, salt, about, secretQuestion, secretAnswer, dateOfSignup) VALUES(?, ?, ?, ?, ?, ?, ?, ?,NOW())");
		$stmt->bind_param("ssssssss", $username, $birthdate, $email, $encrypted_password, $salt, $about, $sequrity_q, $sequrity_a);
        $result = $stmt->execute();
        $stmt->close();
 
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }
	
	
	
	
	  /**
     * verify user
     * returns user details
     */
    public function verify($email) {
        
   
 
        $stmt = $this->conn->prepare("UPDATE users SET verification = 'verified' where email = ?");
		$stmt->bind_param("s", $email);
        $result = $stmt->execute();
        $stmt->close();
 
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }
 
 
 
 
    /**
     * Get user by username and password
     */
    public function getUserByUsernameAndPassword($username, $password) {
 
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE name = ?");
 
        $stmt->bind_param("s", $username);
 
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $user;
            }
        } else {
            return NULL;
        }
    }
	
	
	
	
	/**
     * 
     * returns profile details for text mood
     */
    public function returnupdateinfo($username) {
        
 
     $stmt = $this->conn->prepare("SELECT * FROM users WHERE name = ? ");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
            $result = $stmt->get_result()->fetch_assoc();


            $stmt->close();

  // check for successful 
        if ($result) {
          $array = array();
               $array ["name"] = $result["name"];
               $array ["email"] = $result["email"];
			   $array ["encrypted_password"] = $result["encrypted_password"];
			   $array ["salt"] = $result["salt"];
			   $array ["secretQuestion"] = $result["secretQuestion"];
			   $array ["secretAnswer"] = $result["secretAnswer"];
               $array ["about"] = $result["about"];
               $array ["dateOfSignup"] = $result["dateOfSignup"];  
            return $array;
        } else {
            return false;
        }

    }
	
	
	
	    /**
     * Get user ID by username
     */
    public function getUserIDByName($username) {
 
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE name = ?");
 
        $stmt->bind_param("s", $username);
 
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
         
            // check for password equality
            if ($result) {
                // user authentication details are correct
                return $result["ID"];
            }
        } else {
            return NULL;
        }
    }
	
	
	
	
	
	
	
	
	
	
	
	
	    /**
     * Get user secret question by username
     */
    public function getUserSQByName($username) {
 
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE name = ?");
 
        $stmt->bind_param("s", $username);
 
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
         
            // check for password equality
            if ($result) {
                // user authentication details are correct
                return $result["secretQuestion"];
            }
        } else {
            return NULL;
        }
    }
	
	
	
	
	
	
	
	
	
	
	
	    /**
     * Get user ID by username
     */
    public function getUserNameByID($username) {
 
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE ID = ?");
 
        $stmt->bind_param("s", $username);
 
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
         
            // check for password equality
            if ($result) {
                // user authentication details are correct
                return $result["name"];
            }
        } else {
            return NULL;
        }
    }
	
	
	
	
 
    /**
     * Check user is existed or not
     */
    public function isUserExisted($username) {
        $stmt = $this->conn->prepare("SELECT name from users WHERE name = ?");
 
        $stmt->bind_param("s", $username);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }





 /**
     * Check user is existed or not
     */
    public function isEmailExisted($email) {
        $stmt = $this->conn->prepare("SELECT email from users WHERE email = ?");
 
        $stmt->bind_param("s", $email);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }








  /**
     * is user already following
     * 
     * 
     */



    public function isUserfollowing($username, $follows) {
        $stmt = $this->conn->prepare("SELECT * from following WHERE username = ? and follow = ? and mood in (select mood_id from users where username = ?)");
 
        $stmt->bind_param("sss", $username, $follows, $username);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

	
	  /**
     * is user already following in text mood
     * 
     * 
     */



    public function isUserfollowingt($username, $follows) {
        $stmt = $this->conn->prepare("SELECT * from following WHERE ID = ? and follows = ? and inMood = 'text'");
 
        $stmt->bind_param("ss", $username, $follows);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

	
	
	  /**
     * is user already following in text mood
     * 
     * 
     */



    public function isUserfollowinga($username, $follows) {
        $stmt = $this->conn->prepare("SELECT * from following WHERE ID = ? and follows = ? and inMood = 'audio'");
 
        $stmt->bind_param("ss", $username, $follows);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }








    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
 
    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {
 
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
 
        return $hash;
    }





 /**
     * making the user follows
     * returns following details
     */
    public function followUser($username, $follows, $inMood) {
        
        
      

        $stmt = $this->conn->prepare("INSERT INTO following(ID, follows, inMood) values (?,?,?) ");
        $stmt->bind_param("sss", $username, $follows, $inMood);
        $result = $stmt->execute();
        $stmt->close();
 
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM following WHERE ID = ? and follows = ? and inMood = ?");
            $stmt->bind_param("sss", $username, $follows, $inMood);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }
 








 /**
     * checks if the answer is right
     * returns true or false
     */
    public function checks_a ($follows, $s_a) {
        
        
      $stmt = $this->conn->prepare("SELECT * from users WHERE name = ? and secretAnswer = ? ");
 
        $stmt->bind_param("ss", $follows, $s_a);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // answer is write 
            $stmt->close();
            return true;
        } else {
            // not right
            $stmt->close();
            return false;
        }



    }
 








 /**
     * writing content (just Delta mood)
     * returns content details
     */
    public function signalDelta($writer, $txt) {
        

        $stmt = $this->conn->prepare("INSERT INTO mood_signal(writer, txt, mood, created_at) values (?,?,(select mood_id from users where username = ?),NOW())   ");
        $stmt->bind_param("sss", $writer, $txt, $writer);
        $result = $stmt->execute();
        $stmt->close();
 
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM mood_signal WHERE writer = ? and txt = ? and mood in (select mood_id from users where username = ?)");
            $stmt->bind_param("sss", $writer, $txt, $writer);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }

/**
     * Check content is existed or not
     */
    public function isContentExisted($writer, $txt) {
        $stmt = $this->conn->prepare("SELECT writer, content from text_post WHERE writer = ? and content = ?");
 
        $stmt->bind_param("ss", $writer, $txt);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // content existed 
            $stmt->close();
            return true;
        } else {
            // content not existed
            $stmt->close();
            return false;
        }
    }



/**
     * Check content if mood is delta
     */
    public function isDelta($writer) {
        $stmt = $this->conn->prepare("SELECT username from users WHERE mood_id = 3 and username = ?");
 
        $stmt->bind_param("s", $writer);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // mood is delta 
            $stmt->close();
            return true;
        } else {
            // mood isn't delta
            $stmt->close();
            return false;
        }
    }


	
	
	
	/**
     * post audio
     * returns content details
     */
    public function posta($writer) {
        
$date = date('Y-m-d-H-i-s');
        $stmt = $this->conn->prepare("INSERT INTO audio_post(writer, content, readUnread, date_) values (?,?, 'unread', NOW())");
        $stmt->bind_param("ss", $writer, $date);
        $result = $stmt->execute();
        $stmt->close();
 
 
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM audio_post WHERE writer = ? and content = ?");
            $stmt->bind_param("ss", $writer, $date);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }

	
	
	
	
	
/**
     * writing content (not Delta mood)
     * returns content details
     */
    public function postt($writer, $txt) {
        

        $stmt = $this->conn->prepare("INSERT INTO text_post(writer, content, readUnread, date_) values (?,?, 'unread' , NOW())   ");
        $stmt->bind_param("ss", $writer, $txt);
        $result = $stmt->execute();
        $stmt->close();
 
 
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM text_post WHERE writer = ? and content = ?");
            $stmt->bind_param("ss", $writer, $txt);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }

	
	
	/**
	     * blocking user
     * returns content details
     */
    public function block($mentioned, $pid) {
        

        $stmt = $this->conn->prepare("INSERT INTO block(ID , blocked) values (?,?)");
        $stmt->bind_param("ss", $pid, $mentioned);
        $result = $stmt->execute();
        $stmt->close();
 
 
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM block WHERE ID = ? and blocked = ?");
            $stmt->bind_param("ss", $pid, $mentioned);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }

	
	
	
	
	
	
	
	

   /**
     * change user information
     * returns user details
     */
    public function changeinfo($id, $birthdate, $email, $password, $username, $sequrity_q, $sequrity_a, $about, $flag, $salt, $encrypted_password) {
        
		if ($flag==1) {
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
		} 
 
        $stmt = $this->conn->prepare("update users set name = ? , dateOfBirth = ? ,  email = ? , encrypted_password = ? , salt = ?, about = ?, secretQuestion = ?, secretAnswer = ? where ID = ?");
        $stmt->bind_param("sssssssss", $username, $birthdate, $email, $encrypted_password, $salt, $about, $sequrity_q, $sequrity_a, $id);
        $result = $stmt->execute();
        $stmt->close();

        
      

 
        // check for successful store
        if ($result) {
		

            $stmt = $this->conn->prepare("SELECT * FROM users WHERE ID = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }

/**
     * delete the users who are following you
     * returns nothing
     */



         public function changedsequrity ($username) {
        
        $stmt = $this->conn->prepare("delete from following where follows = ? and inMood = 'audio'");
        $stmt->bind_param("s", $username);
        $result = $stmt->execute();
        $stmt->close();
 
      
    }




/**
     * reply
     * returns reply in text mood
     */
    public function replyt($id, $to_id) {
        
 
        $stmt = $this->conn->prepare("insert into text_replies (ID, replyToID) values (?,?)");
        $stmt->bind_param("ss", $id, $to_id);
        $result = $stmt->execute();
        $stmt->close();


        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM text_replies WHERE ID = ? and  replyToID = ?");
            $stmt->bind_param("ss", $id, $to_id);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }
	
	
	
	
	/**
     * reply
     * returns reply in audio mood
     */
    public function replya($id, $to_id) {
        
 
        $stmt = $this->conn->prepare("insert into audio_replies (ID, replyToID) values (?,?)");
        $stmt->bind_param("ss", $id, $to_id);
        $result = $stmt->execute();
        $stmt->close();


        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM audio_replies WHERE ID = ? and  replyToID = ?");
            $stmt->bind_param("ss", $id, $to_id);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }



	
	
	
	
	/**
     * like
     * returns likes of text mood
     */
    public function liket($pid, $uid) {
        
 
        $stmt = $this->conn->prepare("insert into tplikes (PID, UID) values (?,?)");
        $stmt->bind_param("ss", $pid, $uid);
        $result = $stmt->execute();
        $stmt->close();


        // check for successful 
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM tplikes WHERE PID = ? and UID =?");
            $stmt->bind_param("ss", $pid, $uid);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }
	
	
	
	/**
     * like
     * returns likes of audio mood
     */
    public function likea($pid, $uid) {
        
 
        $stmt = $this->conn->prepare("insert into aplikes (PID, UID) values (?,?)");
        $stmt->bind_param("ss", $pid, $uid);
        $result = $stmt->execute();
        $stmt->close();


        // check for successful 
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM aplikes WHERE PID = ? and UID =?");
            $stmt->bind_param("ss", $pid, $uid);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }
	
	


/**
     * no like
     * returns like details
     */
    public function returnlike($id) {
        
 
     $stmt = $this->conn->prepare("SELECT likes FROM mood_signal WHERE id = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            $stmt->close();

    


        // check for successful 
        if ($result) {
            $stmt = $this->conn->prepare("SELECT likes FROM mood_signal WHERE id = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }



/**
     * no following order
     * returns followers details
     */
    public function returnfollowers($username) {
        
 
     $stmt = $this->conn->prepare("SELECT count(*) as c, mood FROM following WHERE follow = ? group by mood order by mood");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

  // check for successful 
        if ($result) {
          
           $array = array();
        while ($row = $result->fetch_assoc() ) {
               $mood = 1;
               $array [$mood] = $row["c"];
               $mood = $mood + 1;
              

          } 
         
          
            return $array;
        } else {
            return false;
        }

    


      
    }



	
	
	/**
     * no writing reply
     * returns replies details of text mood
     */
    public function returnrepliest($to_id) {
        
 
     $stmt = $this->conn->prepare("SELECT text_post.ID, text_post.content, text_post.date_, text_post.writer, count(DISTINCT tplikes.UID) as likes, COUNT(DISTINCT text_replies.ID) as replies, block.blocked FROM 
text_post left join tplikes on text_post.ID = tplikes.PID left join text_replies on text_post.ID = text_replies.replyToID left join block on text_post.ID = block.ID
where text_post.ID in (
    SELECT text_replies.ID
    FROM text_replies, text_post
    WHERE text_replies.replyToID = text_post.ID and text_replies.replyToID = ?
    
    
    )
group by text_post.ID
order by text_post.date_ DESC");
            $stmt->bind_param("s", $to_id);
            $stmt->execute();
           
            //$result = $stmt->get_result();
            $stmt->store_result();
            $num = $stmt->num_rows;
            
            $stmt->close();
        
  $stmt = $this->conn->prepare("SELECT text_post.ID, text_post.content, text_post.date_, text_post.writer, count(DISTINCT tplikes.UID) as likes, COUNT(DISTINCT text_replies.ID) as replies, block.blocked FROM 
text_post left join tplikes on text_post.ID = tplikes.PID left join text_replies on text_post.ID = text_replies.replyToID left join block on text_post.ID = block.ID
where text_post.ID in (
    SELECT text_replies.ID
    FROM text_replies, text_post
    WHERE text_replies.replyToID = text_post.ID and text_replies.replyToID = ?
    
    
    )
group by text_post.ID
order by text_post.date_ DESC");
            $stmt->bind_param("s", $to_id);
            $stmt->execute();
           
            $result = $stmt->get_result();
          //  $stmt->store_result();
         //   $num = $stmt->num_rows;
            
            $stmt->close();
        
        

  // check for successful 
        if ($num>=1) {
          
           $array = array();
          // $array ["count"] = result->num_rows;
           $array ["count"] = $num;
 $count = 0;
        while ($row = $result->fetch_assoc()) {
		
		
		
		 $array [$count]["ID"] = $row["ID"];
               $array [$count]["writer"] = $row["writer"];
               $array [$count]["content"] = $row["content"];
               $array [$count]["likes"] = $row["likes"];
			   $array [$count]["replies"] = $row["replies"];
			   $array [$count]["b1"] = $row["blocked"];
			   $array [$count]["b2"] = 10;
			   $array [$count]["b3"] = 10;
               $array [$count]["date_"] = $row["date_"];
			   
             
              
               $count = $count + 1;


          } 
         
            
            
        //  echo json_encode($array);

            return $array;
        } else {

            return false;
        }

    }


	
	/**
     * no writing reply
     * returns replies details of text mood
     */
    public function returnrepliesa($to_id) {
        
 
     $stmt = $this->conn->prepare("SELECT audio_post.ID, audio_post.content, audio_post.date_, audio_post.writer, count(DISTINCT aplikes.UID) as likes, COUNT(DISTINCT audio_replies.ID) as replies FROM 
audio_post left join aplikes on audio_post.ID = aplikes.PID left join audio_replies on audio_post.ID = audio_replies.replyToID 
where audio_post.ID in (
    SELECT audio_replies.ID
    FROM audio_replies, audio_post
    WHERE audio_replies.replyToID = audio_post.ID and audio_replies.replyToID = ?
    
    
    )


group by audio_post.ID
order by audio_post.date_ DESC");
            $stmt->bind_param("s", $to_id);
            $stmt->execute();
           
            //$result = $stmt->get_result();
            $stmt->store_result();
            $num = $stmt->num_rows;
            
            $stmt->close();
        
  $stmt = $this->conn->prepare("SELECT audio_post.ID, audio_post.content, audio_post.date_, audio_post.writer, count(DISTINCT aplikes.UID) as likes, COUNT(DISTINCT audio_replies.ID) as replies FROM 
audio_post left join aplikes on audio_post.ID = aplikes.PID left join audio_replies on audio_post.ID = audio_replies.replyToID 
where audio_post.ID in (
    SELECT audio_replies.ID
    FROM audio_replies, audio_post
    WHERE audio_replies.replyToID = audio_post.ID and audio_replies.replyToID = ?
    
    
    )


group by audio_post.ID
order by audio_post.date_ DESC");
            $stmt->bind_param("s", $to_id);
            $stmt->execute();
           
            $result = $stmt->get_result();
          //  $stmt->store_result();
         //   $num = $stmt->num_rows;
            
            $stmt->close();
        
        

  // check for successful 
        if ($num>=1) {
          
           $array = array();
          // $array ["count"] = result->num_rows;
           $array ["count"] = $num;
 $count = 0;
        while ($row = $result->fetch_assoc()) {
              
                        $array [$count]["ID"] = $row["ID"];
               $array [$count]["writer"] = $row["writer"];
               $array [$count]["content"] = $row["content"];
               $array [$count]["replies"] = $row["replies"];
               $array [$count]["date_"] = $row["date_"];
         
               $array [$count]["likes"] = $row["likes"];
               $count = $count + 1;


          } 
         
            
            
        //  echo json_encode($array);

            return $array;
        } else {

            return false;
        }

    }
	
	
	
	
	
	
	
	


/**
     * 
     * returns profile details
     */
    public function returnuser($username) {
        
 
     $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ? ");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
            $result = $stmt->get_result()->fetch_assoc();


            $stmt->close();

  // check for successful 
        if ($result) {
          $array = array();
               $array ["username"] = $result["username"];
               $array ["realname"] = $result["realname"];
$array ["sequrity_a"] = $result["sequrity_a"];
$array ["sequrity_q"] = $result["sequrity_q"];
               $array ["about"] = $result["about"];
               $array ["updated_at"] = $result["updated_at"];  
            return $array;
        } else {
            return false;
        }

    }
	
	
	
	
	
	/**
     * 
     * returns profile details for text mood
     */
    public function returnusert($username) {
        
 
     $stmt = $this->conn->prepare("SELECT * FROM users WHERE name = ? ");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
            $result = $stmt->get_result()->fetch_assoc();


            $stmt->close();

  // check for successful 
        if ($result) {
          $array = array();
               $array ["name"] = $result["name"];
             
               $array ["about"] = $result["about"];
               $array ["dateOfSignup"] = $result["dateOfSignup"];  
            return $array;
        } else {
            return false;
        }

    }
	
	
	
	










	/**
     * no writing reply
     * returns replies details of profile of  text mood
     */
    public function returnt($username) {
        
 
     $stmt = $this->conn->prepare("SELECT text_post.ID, text_post.content, text_post.date_, text_post.writer, count(DISTINCT tplikes.UID) as likes, COUNT(DISTINCT text_replies.ID) as replies, block.blocked FROM 
text_post left join tplikes on text_post.ID = tplikes.PID left join text_replies on text_post.ID = text_replies.replyToID left join block on text_post.ID = block.ID
where block.blocked = ?

group by text_post.ID
order by text_post.ID DESC
");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
            $result = $stmt->get_result();
           // $stmt->store_result();
          //  $num = $stmt->num_rows;
            $stmt->close();
        
        $stmt = $this->conn->prepare("SELECT text_post.ID, text_post.content, text_post.date_, text_post.writer, count(DISTINCT tplikes.UID) as likes, COUNT(DISTINCT text_replies.ID) as replies, block.blocked FROM 
text_post left join tplikes on text_post.ID = tplikes.PID left join text_replies on text_post.ID = text_replies.replyToID left join block on text_post.ID = block.ID
where block.blocked = ?

group by text_post.ID
order by text_post.ID DESC
");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
          //  $result = $stmt->get_result();
            $stmt->store_result();
            $num = $stmt->num_rows;
            $stmt->close();

  // check for successful 
        if ($num>=1) {
          
           $array = array();
        //   $array ["count"] = result->num_rows;
           $array ["count"] = $num;
            $count = 0;
        while ($row = $result->fetch_assoc()) {
               
		      $array [$count]["ID"] = $row["ID"];
               $array [$count]["writer"] = $row["writer"];
               $array [$count]["content"] = $row["content"];
               $array [$count]["likes"] = $row["likes"];
			   $array [$count]["replies"] = $row["replies"];
			   $array [$count]["b1"] = $row["blocked"];
			   $array [$count]["b2"] = 10;
			   $array [$count]["b3"] = 10;
               $array [$count]["date_"] = $row["date_"];
			   
			   
               $count = $count + 1;
			   
			   
              

          } 
         
          
            return $array;
        } else {
            return false;
        }

    }
	
	
	/**
     * no writing reply
     * returns replies details of profile of  text mood of user himself
     */
    public function returnut($username) {
        
 
     $stmt = $this->conn->prepare("SELECT text_post.ID, text_post.content, text_post.date_, text_post.writer, count(DISTINCT tplikes.UID) as likes, COUNT(DISTINCT text_replies.ID) as replies, block.blocked FROM 
text_post left join tplikes on text_post.ID = tplikes.PID left join text_replies on text_post.ID = text_replies.replyToID left join block on text_post.ID = block.ID
where text_post.writer = ?

group by text_post.ID
order by text_post.ID DESC
");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
            $result = $stmt->get_result();
           // $stmt->store_result();
          //  $num = $stmt->num_rows;
            $stmt->close();
        
        $stmt = $this->conn->prepare("SELECT text_post.ID, text_post.content, text_post.date_, text_post.writer, count(DISTINCT tplikes.UID) as likes, COUNT(DISTINCT text_replies.ID) as replies, block.blocked FROM 
text_post left join tplikes on text_post.ID = tplikes.PID left join text_replies on text_post.ID = text_replies.replyToID left join block on text_post.ID = block.ID
where text_post.writer = ?

group by text_post.ID
order by text_post.ID DESC
");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
          //  $result = $stmt->get_result();
            $stmt->store_result();
            $num = $stmt->num_rows;
            $stmt->close();

  // check for successful 
        if ($num>=1) {
          
           $array = array();
        //   $array ["count"] = result->num_rows;
           $array ["count"] = $num;
            $count = 0;
        while ($row = $result->fetch_assoc()) {
               
		      $array [$count]["ID"] = $row["ID"];
               $array [$count]["writer"] = $row["writer"];
               $array [$count]["content"] = $row["content"];
               $array [$count]["likes"] = $row["likes"];
			   $array [$count]["replies"] = $row["replies"];
			   $array [$count]["b1"] = $row["blocked"];
			   $array [$count]["b2"] = 10;
			   $array [$count]["b3"] = 10;
               $array [$count]["date_"] = $row["date_"];
			   
			   
               $count = $count + 1;
			   
			   
              

          } 
         
          
            return $array;
        } else {
            return false;
        }

    }
	
	
	
	
	/**
     * no writing reply
     * returns replies details of profile of  audio mood
     */
    public function returna($username) {
        
 
     $stmt = $this->conn->prepare("SELECT audio_post.ID, audio_post.content, audio_post.date_, audio_post.writer, count(DISTINCT aplikes.UID) as likes, COUNT(DISTINCT audio_replies.ID) as replies FROM 
audio_post left join aplikes on audio_post.ID = aplikes.PID left join audio_replies on audio_post.ID = audio_replies.replyToID 
where audio_post.writer = ?


group by audio_post.ID
order by audio_post.ID DESC");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
            $result = $stmt->get_result();
           // $stmt->store_result();
          //  $num = $stmt->num_rows;
            $stmt->close();
        
        $stmt = $this->conn->prepare("SELECT audio_post.ID, audio_post.content, audio_post.date_, audio_post.writer, count(DISTINCT aplikes.UID) as likes, COUNT(DISTINCT audio_replies.ID) as replies FROM 
audio_post left join aplikes on audio_post.ID = aplikes.PID left join audio_replies on audio_post.ID = audio_replies.replyToID 
where audio_post.writer = ?


group by audio_post.ID
order by audio_post.ID DESC");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
          //  $result = $stmt->get_result();
            $stmt->store_result();
            $num = $stmt->num_rows;
            $stmt->close();

  // check for successful 
        if ($num>=1) {
          
           $array = array();
        //   $array ["count"] = result->num_rows;
           $array ["count"] = $num;
            $count = 0;
        while ($row = $result->fetch_assoc()) {
               
			   $array [$count]["ID"] = $row["ID"];
               $array [$count]["writer"] = $row["writer"];
               $array [$count]["content"] = $row["content"];
               $array [$count]["replies"] = $row["replies"];
               $array [$count]["date_"] = $row["date_"];

               $array [$count]["likes"] = $row["likes"];
               $count = $count + 1;
			   
			   
              

          } 
         
          
            return $array;
        } else {
            return false;
        }

    }
	
	
	

	
	
	

 public function returnsignal23 ($username, $mood) {
        
 
     $stmt = $this->conn->prepare("SELECT * FROM mood_signal WHERE writer = ? and mood = ?");
            $stmt->bind_param("ss", $username, $mood);
            $stmt->execute();

            
            $result = $stmt->get_result();
        //    $stmt->store_result();
        //    $num = $stmt->num_rows;
            $stmt->close();
     
      $stmt = $this->conn->prepare("SELECT * FROM mood_signal WHERE writer = ? and mood = ?");
            $stmt->bind_param("ss", $username, $mood);
            $stmt->execute();

            
       //     $result = $stmt->get_result();
            $stmt->store_result();
            $num = $stmt->num_rows;
            $stmt->close();

  // check for successful 
        if ($num>=1) {
          
           $array = array();
        //   $array ["count"] = result->num_rows;
           $array ["count"] = $num;
              $count = 0;
        while ($row = $result->fetch_assoc()) {
             
               
               $array [$count]["id"] = $row["id"];
               $array [$count]["writer"] = $row["writer"];
               $array [$count]["txt"] = $row["txt"];
               $array [$count]["mood"] = $row["mood"];
               $array [$count]["created_at"] = $row["created_at"];
               $array [$count]["mentioned"] = $row["mentioned"];
               $array [$count]["likes"] = $row["likes"];
               $count = $count + 1;
              

          } 
         
          
            return $array;
        } else {
            return false;
        }

    }



/**
     * needs username
     * returns username mainstream 2 and 3
     */
    public function returnmainstream23($username) {
        
 
     $stmt = $this->conn->prepare("SELECT * FROM mood_signal, following, users WHERE users.username = ? and following.username = users.username  and following.mood = mood_id and mood_signal.mood = mood_id and following.follow = writer");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
            $result = $stmt->get_result();
            //$stmt->store_result();
          //  $num = $stmt->num_rows;
            $stmt->close();
        
        
     $stmt = $this->conn->prepare("SELECT * FROM mood_signal, following, users WHERE users.username = ? and following.username = users.username  and following.mood = mood_id and mood_signal.mood = mood_id and following.follow = writer");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
       //     $result = $stmt->get_result();
            $stmt->store_result();
            $num = $stmt->num_rows;
            $stmt->close();

  // check for successful 
        if ($num>=1) {
          
           $array = array();
        //   $array ["count"] = result->num_rows;
           $array ["count"] = $num;
             $count = 0;
        while ($row = $result->fetch_assoc()) {
              
               
               $array [$count]["id"] = $row["id"];
               $array [$count]["writer"] = $row["writer"];
               $array [$count]["txt"] = $row["txt"];
               $array [$count]["mood"] = $row["mood"];
               $array [$count]["created_at"] = $row["created_at"];
               $array [$count]["mentioned"] = $row["mentioned"];
               $array [$count]["likes"] = $row["likes"];
               $count = $count + 1;
              

          } 
         
          
            return $array;
        } else {
            return false;
        }

    }


/**
     * needs username
     * returns username mainstream 1
     */
    public function returnmainstream1($username) {
        
 
     $stmt = $this->conn->prepare("SELECT * FROM mood_signal, following, users WHERE users.username = ? and following.username = users.username  and following.mood = mood_id and mood_signal.mood = mood_id and following.follow = mentioned");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
            $result = $stmt->get_result();
          //  $stmt->store_result();
           // $num = $stmt->num_rows;
            $stmt->close();
        
        
     $stmt = $this->conn->prepare("SELECT * FROM mood_signal, following, users WHERE users.username = ? and following.username = users.username  and following.mood = mood_id and mood_signal.mood = mood_id and following.follow = mentioned");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
       //     $result = $stmt->get_result();
            $stmt->store_result();
            $num = $stmt->num_rows;
            $stmt->close();

  // check for successful 
        if ($num>=1) {
          
           $array = array();
        //   $array ["count"] = result->num_rows;
           $array ["count"] = $num;
            $count = 0;
        while ($row = $result->fetch_assoc()) {
               
               
               $array [$count]["id"] = $row["id"];
               $array [$count]["writer"] = $row["writer"];
               $array [$count]["txt"] = $row["txt"];
               $array [$count]["mood"] = $row["mood"];
               $array [$count]["created_at"] = $row["created_at"];
               $array [$count]["mentioned"] = $row["mentioned"];
               $array [$count]["likes"] = $row["likes"];
               $count = $count + 1;
              

          } 
         
          
            return $array;
        } else {
            return false;
        }

    }




/**
     * needs username
     * returns notification
     */
    public function notify($username) {
        
 
     $stmt = $this->conn->prepare("SELECT * FROM mood_signal, users WHERE mood_signal.mood = mood_id and  users.username = mentioned and mentioned = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
            $result = $stmt->get_result();
         //   $stmt->store_result();
        //    $num = $stmt->num_rows;
            $stmt->close();
        
         $stmt = $this->conn->prepare("SELECT * FROM mood_signal, users WHERE mood_signal.mood = mood_id and  users.username = mentioned and mentioned = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
          //  $result = $stmt->get_result();
            $stmt->store_result();
            $num = $stmt->num_rows;
            $stmt->close();

  // check for successful 
        if ($num>=1) {
          
           $array = array();
        //   $array ["count"] = result->num_rows;
           $array ["count"] = $num;
             $count = 0;
        while ($row = $result->fetch_assoc()) {
              
               
               $array [$count]["id"] = $row["id"];
               $array [$count]["writer"] = $row["writer"];
               $array [$count]["txt"] = $row["txt"];
               $array [$count]["mood"] = $row["mood"];
               $array [$count]["created_at"] = $row["created_at"];
               $array [$count]["mentioned"] = $row["mentioned"];
               $array [$count]["likes"] = $row["likes"];
               $count = $count + 1;
              

          } 
         
          
            return $array;
        } else {
            return false;
        }

    }


	
	
	/**
     * needs username
     * returns notifications of text mood
     */
    public function notifyt($username) {
        
 
     $stmt = $this->conn->prepare("SELECT text_post.ID, text_post.content, text_post.date_, text_post.writer, count(DISTINCT tplikes.UID) as likes, COUNT(DISTINCT text_replies.ID) as replies, block.blocked FROM 
text_post left join tplikes on text_post.ID = tplikes.PID left join text_replies on text_post.ID = text_replies.replyToID left join block on text_post.ID = block.ID
where block.blocked not in (3)
and text_post.readUnread='unread'
and text_post.ID in (
    select text_replies.ID
    from text_replies, text_post
    where text_replies.replyToID = text_post.ID and text_post.writer = ?
    
    
    )
group by text_post.ID
order by text_post.ID DESC
");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
            $result = $stmt->get_result();
         //   $stmt->store_result();
        //    $num = $stmt->num_rows;
            $stmt->close();
        
         $stmt = $this->conn->prepare("SELECT text_post.ID, text_post.content, text_post.date_, text_post.writer, count(DISTINCT tplikes.UID) as likes, COUNT(DISTINCT text_replies.ID) as replies, block.blocked FROM 
text_post left join tplikes on text_post.ID = tplikes.PID left join text_replies on text_post.ID = text_replies.replyToID left join block on text_post.ID = block.ID
where block.blocked not in (3)
and text_post.readUnread='unread'
and text_post.ID in (
    select text_replies.ID
    from text_replies, text_post
    where text_replies.replyToID = text_post.ID and text_post.writer = ?
    
    
    )
group by text_post.ID
order by text_post.ID DESC
");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
          //  $result = $stmt->get_result();
            $stmt->store_result();
            $num = $stmt->num_rows;
            $stmt->close();

  // check for successful 
        if ($num>=1) {
          
           $array = array();
        //   $array ["count"] = result->num_rows;
           $array ["count"] = $num;
             $count = 0;
        while ($row = $result->fetch_assoc()) {
              
               
               $array [$count]["ID"] = $row["ID"];
               $array [$count]["writer"] = $row["writer"];
               $array [$count]["content"] = $row["content"];
               $array [$count]["replies"] = $row["replies"];
               $array [$count]["date_"] = $row["date_"];
                 $array [$count]["b1"] = $row["blocked"];
              // $array [$count]["b2"] = $row["b2"];
			  // $array [$count]["b3"] = $row["b3"];
               $array [$count]["likes"] = $row["likes"];
               $count = $count + 1;
              

          } 
         
          
            return $array;
        } else {
            return false;
        }

    }



	/**
     * needs username
     * returns notifications of text mood
     */
    public function notifya($username) {
        
 
     $stmt = $this->conn->prepare("SELECT audio_post.ID, audio_post.content, audio_post.date_, audio_post.writer, count(DISTINCT aplikes.UID) as likes, COUNT(DISTINCT audio_replies.ID) as replies FROM 
audio_post left join aplikes on audio_post.ID = aplikes.PID left join audio_replies on audio_post.ID = audio_replies.replyToID 
where audio_post.readUnread='unread'
and audio_post.ID in (
    select audio_replies.ID
    from audio_replies, audio_post
    where audio_replies.replyToID = audio_post.ID and audio_post.writer = ?
    
    
    )

group by audio_post.ID
order by audio_post.ID DESC");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
            $result = $stmt->get_result();
         //   $stmt->store_result();
        //    $num = $stmt->num_rows;
            $stmt->close();
        
         $stmt = $this->conn->prepare("SELECT audio_post.ID, audio_post.content, audio_post.date_, audio_post.writer, count(DISTINCT aplikes.UID) as likes, COUNT(DISTINCT audio_replies.ID) as replies FROM 
audio_post left join aplikes on audio_post.ID = aplikes.PID left join audio_replies on audio_post.ID = audio_replies.replyToID 
where audio_post.readUnread='unread'
and audio_post.ID in (
    select audio_replies.ID
    from audio_replies, audio_post
    where audio_replies.replyToID = audio_post.ID and audio_post.writer = ?
    
    
    )

group by audio_post.ID
order by audio_post.ID DESC");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
          //  $result = $stmt->get_result();
            $stmt->store_result();
            $num = $stmt->num_rows;
            $stmt->close();

  // check for successful 
        if ($num>=1) {
          
           $array = array();
        //   $array ["count"] = result->num_rows;
           $array ["count"] = $num;
             $count = 0;
        while ($row = $result->fetch_assoc()) {
              
               
               $array [$count]["ID"] = $row["ID"];
               $array [$count]["writer"] = $row["writer"];
               $array [$count]["content"] = $row["content"];
               $array [$count]["replies"] = $row["replies"];
               $array [$count]["date_"] = $row["date_"];
             
               $array [$count]["likes"] = $row["likes"];
               $count = $count + 1;
              

          } 
         
          
            return $array;
        } else {
            return false;
        }

    }


	
	
	
	
	
	/**
     * needs username
     * returns timeline of text mood
     */
    public function timelinet($username) {
        
 
     $stmt = $this->conn->prepare("SELECT text_post.ID, text_post.content, text_post.date_, text_post.writer, count(DISTINCT tplikes.UID) as likes, COUNT(DISTINCT text_replies.ID) as replies, block.blocked FROM 
text_post left join tplikes on text_post.ID = tplikes.PID left join text_replies on text_post.ID = text_replies.replyToID left join block on text_post.ID = block.ID
where block.blocked not in (?)
and (text_post.ID in (
    SELECT tplikes.PID
    from 
    (
        select count(tplikes.UID), tplikes.PID
        FROM tplikes
        GROUP BY tplikes.PID
        order by count(tplikes.UID)
        LIMIT 100

    ) as t
    
    )
    
or text_post.ID in (
    SELECT text_replies.replyToID
    from 
    (
        select count(text_replies.ID), text_replies.replyToID
        FROM text_replies
        GROUP BY text_replies.replyToID
        order by count(text_replies.ID)
        LIMIT 100

    ) as ts
    
    )
  or text_post.writer IN
    (select following.follows
     FROM following
     where following.ID = ? and following.inMood = 'text'
        
        
        ))
group by text_post.ID
order by text_post.ID DESC


");
            $stmt->bind_param("ss", $username, $username);
            $stmt->execute();

            
            $result = $stmt->get_result();
         //   $stmt->store_result();
        //    $num = $stmt->num_rows;
            $stmt->close();
        
         $stmt = $this->conn->prepare("SELECT text_post.ID, text_post.content, text_post.date_, text_post.writer, count(DISTINCT tplikes.UID) as likes, COUNT(DISTINCT text_replies.ID) as replies, block.blocked FROM 
text_post left join tplikes on text_post.ID = tplikes.PID left join text_replies on text_post.ID = text_replies.replyToID left join block on text_post.ID = block.ID
where block.blocked not in (?)
and (text_post.ID in (
    SELECT tplikes.PID
    from 
    (
        select count(tplikes.UID), tplikes.PID
        FROM tplikes
        GROUP BY tplikes.PID
        order by count(tplikes.UID)
        LIMIT 100

    ) as t
    
    )
    
or text_post.ID in (
    SELECT text_replies.replyToID
    from 
    (
        select count(text_replies.ID), text_replies.replyToID
        FROM text_replies
        GROUP BY text_replies.replyToID
        order by count(text_replies.ID)
        LIMIT 100

    ) as ts
    
    )
  or text_post.writer IN
    (select following.follows
     FROM following
     where following.ID = ? and following.inMood = 'text'
        
        
        ))
group by text_post.ID
order by text_post.ID DESC


");
            $stmt->bind_param("ss", $username, $username);
            $stmt->execute();

            
          //  $result = $stmt->get_result();
            $stmt->store_result();
            $num = $stmt->num_rows;
            $stmt->close();

  // check for successful 
        if ($num>=1) {
          
           $array = array();
        //   $array ["count"] = result->num_rows;
           $array ["count"] = $num;
             $count = 0;
        while ($row = $result->fetch_assoc()) {
              
               
               $array [$count]["ID"] = $row["ID"];
               $array [$count]["writer"] = $row["writer"];
               $array [$count]["content"] = $row["content"];
               $array [$count]["likes"] = $row["likes"];
			   $array [$count]["replies"] = $row["replies"];
			   $array [$count]["b1"] = $row["blocked"];
			   $array [$count]["b2"] = 10;
			   $array [$count]["b3"] = 10;
               $array [$count]["date_"] = $row["date_"];
          
              
               $count = $count + 1;
              

          } 
         
          
            return $array;
        } else {
            return false;
        }

    }

	
	
	
	
	
	
	/**
     * needs username
     * returns timeline of audio mood
     */
    public function timelinea($username) {
        
 
     $stmt = $this->conn->prepare("SELECT audio_post.ID, audio_post.content, audio_post.date_, audio_post.writer, count(DISTINCT aplikes.UID) as likes, COUNT(DISTINCT audio_replies.ID) as replies FROM 
audio_post left join aplikes on audio_post.ID = aplikes.PID left join audio_replies on audio_post.ID = audio_replies.replyToID 
where 
  audio_post.ID in (
    SELECT aplikes.PID
    from 
    (
        select count(aplikes.UID), aplikes.PID
        FROM aplikes
        GROUP BY aplikes.PID
        order by count(aplikes.UID)
        LIMIT 100

    ) as t
    
    )
    
or audio_post.ID in (
    SELECT audio_replies.replyToID
    from 
    (
        select count(audio_replies.ID), audio_replies.replyToID
        FROM audio_replies
        GROUP BY audio_replies.replyToID
        order by count(audio_replies.ID)
        LIMIT 100

    ) as ts
    
    )
  or audio_post.writer IN
    (select following.follows
     FROM following
     where following.ID = ? and following.inMood = 'audio'
        
        
        )
group by audio_post.ID
order by audio_post.ID DESC




");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
            $result = $stmt->get_result();
         //   $stmt->store_result();
        //    $num = $stmt->num_rows;
            $stmt->close();
        
         $stmt = $this->conn->prepare("SELECT audio_post.ID, audio_post.content, audio_post.date_, audio_post.writer, count(aplikes.UID) as likes, COUNT(audio_replies.ID) as replies FROM 
audio_post left join aplikes on audio_post.ID = aplikes.PID left join audio_replies on audio_post.ID = audio_replies.replyToID 
where 
  audio_post.ID in (
    SELECT aplikes.PID
    from 
    (
        select count(aplikes.UID), aplikes.PID
        FROM aplikes
        GROUP BY aplikes.PID
        order by count(aplikes.UID)
        LIMIT 100

    ) as t
    
    )
    
or audio_post.ID in (
    SELECT audio_replies.replyToID
    from 
    (
        select count(audio_replies.ID), audio_replies.replyToID
        FROM audio_replies
        GROUP BY audio_replies.replyToID
        order by count(audio_replies.ID)
        LIMIT 100

    ) as ts
    
    )
  or audio_post.writer IN
    (select following.follows
     FROM following
     where following.ID = ? and following.inMood = 'audio'
        
        
        )
group by aplikes.PID, audio_replies.replyToID
order by audio_post.ID DESC




");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            
          //  $result = $stmt->get_result();
            $stmt->store_result();
            $num = $stmt->num_rows;
            $stmt->close();

  // check for successful 
        if ($num>=1) {
          
           $array = array();
        //   $array ["count"] = result->num_rows;
           $array ["count"] = $num;
             $count = 0;
        while ($row = $result->fetch_assoc()) {
              
               
               $array [$count]["ID"] = $row["ID"];
               $array [$count]["writer"] = $row["writer"];
               $array [$count]["content"] = $row["content"];
               $array [$count]["likes"] = $row["likes"];
			   $array [$count]["replies"] = $row["replies"];
               $array [$count]["date_"] = $row["date_"];
          
              
               $count = $count + 1;
              

          } 
         
          
            return $array;
        } else {
            return false;
        }

    }

	
	
	
	
	
	

/**
     * search
     * returns replies
     */
    public function search($txt, $mood) {

     $txt = "%" .$txt ."%";
        
     
     $stmt = $this->conn->prepare("SELECT * FROM mood_signal WHERE mood = ? and txt LIKE ? ");
            $stmt->bind_param("ss", $mood, $txt);
            $stmt->execute();

            
            $result = $stmt->get_result();
           // $stmt->store_result();
           // $num = $stmt->num_rows;
            $stmt->close();
        
          $stmt = $this->conn->prepare("SELECT * FROM mood_signal WHERE mood = ? and txt LIKE ? ");
            $stmt->bind_param("ss", $mood, $txt);
            $stmt->execute();

            
           // $result = $stmt->get_result();
            $stmt->store_result();
            $num = $stmt->num_rows;
            $stmt->close();
       // echo json_encode($num);

  // check for successful 
        if ($num>=1) {
          
           $array = array();
        //   $array ["count"] = result->num_rows;
           $array ["count"] = $num;
            $count = 0;
        while ($row = $result->fetch_assoc()) {
               
               
               $array [$count]["id"] = $row["id"];
               $array [$count]["writer"] = $row["writer"];
               $array [$count]["txt"] = $row["txt"];
               $array [$count]["mood"] = $row["mood"];
               $array [$count]["created_at"] = $row["created_at"];
               $array [$count]["mentioned"] = $row["mentioned"];
               $array [$count]["likes"] = $row["likes"];
               $count = $count + 1;
              

          } 
         
          // echo json_encode($array);
            return $array;
        } else {
            return false;
        }

    }

}
 
?>