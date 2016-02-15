<?php
class Helper {

   /****** This function gets the current active link and assigns the class of "act" to it ***/
    public static function getActive($page = null){
        if(!empty($page)){
            if(is_array($page)){
                $error = array();
                foreach($page as $key => $value){
                    if(Url::getParams($key) != $value){
                        array_push($error,$key);
                    }
                }
                return empty($error) ? " class=\"act\"" : null;
            }
        }
        return $page == Url::currentPage() ? " class=\"act\"" : null;
    }
	
	public static function encodeHTML($string, $case = 2) {
		switch($case) {
			case 1:
			return htmlentities($string, ENT_NOQUOTES, 'UTF-8', false);
			break;			
			case 2:
			$pattern = '<([a-zA-Z0-9\.\, "\'_\/\-\+~=;:\(\)?&#%![\]@]+)>';
			// put text only, devided with html tags into array
			$textMatches = preg_split('/' . $pattern . '/', $string);
			// array for sanitised output
			$textSanitised = array();			
			foreach($textMatches as $key => $value) {
				$textSanitised[$key] = htmlentities(html_entity_decode($value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
			}			
			foreach($textMatches as $key => $value) {
				$string = str_replace($value, $textSanitised[$key], $string);
			}			
			return $string;			
			break;
		}
	}

    public static function getImgSize($imagePath,$case){
        //case 0 => width , case 1=> height case 2=>type case 3 => attributes
        if(is_file($imagePath)){
            $size = getimagesize($imagePath); //getimagesize() returns array upto 7 elements
            return $size[$case];             // 0 ,1 width and height 2 , 3 for type and attributes
        }
    }


    public static function shortenString($string, $len = 150) {
        if (strlen($string) > $len) {
            $string = trim(substr($string, 0, $len));
            $string = substr($string, 0, strrpos($string, " "))."&hellip;";
        } else {
            $string .= "&hellip;";
        }
        return $string;
    }

    public static function shortenDesc($desc,$len = 150){
        if(strlen($desc) > $len){
            $desc = trim(substr($desc, 0, $len));
            $desc = substr($desc,0 ,strrpos($desc, " ")); // strrpos() gets the last occurrence of the string
            $desc.= '&hellip;';
        }
        else{
            $desc.= "&hellip;";
        }
        return $desc;
    }
	
}