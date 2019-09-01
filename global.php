<?php
	// funtion get img
	// Ukuran berita 	: default , 700, 700x350, 135x75, 340x170, 100x100, 150x150 ::
	// Ukuran halaman 	: default , 700
	// Ukuran Iklan 	: default (no resize)
	// Tipe::folder 	: berita, iklan, halaman
	// Width : , Height :

	// function get_image($data,$tipe,$ukuran=null,$alt=null,$width=null,$height=null,$class=null){

	// 	if($ukuran){
	// 		$ukuran = '/'.$ukuran;
	// 	}
	// 	$imglink	 	= YiiBase::getPathOfAlias('webroot').'/images/uploads/';
	// 	$imgfull_link 	= $imglink.$tipe.$ukuran.'/'.$data;

	// 	if(!file_exists($imgfull_link)){
 //            $imgfull_link = YiiBase::app()->request->baseUrl .'/images/uploads/image-not-found.png';
	// 		$class = 'img-responsive';
 //        }else{
 //            $imgfull_link = YiiBase::app()->request->baseUrl .'/images/uploads/'. $tipe.$ukuran.'/'.$data;
 //        }

	// 	$img = "<img src='".$imgfull_link."' alt='".$alt."' class='".$class."' title='".$alt."' width='".$width."' height='".$height."' />";

	// 	return $img;
	// }

	function get_image($data,$tipe,$ukuran=null,$alt=null,$width=null,$height=null,$class=null){
		if($ukuran){
			$ukuran = '/'.$ukuran;
		}
		// $imglink	 	= Yii::app()->request->baseUrl.'/images/uploads/';
        $imglink	 	= 'https://bangsaonline.com/images/uploads/';
		$imgfull_link 	= $imglink.$tipe.$ukuran.'/'.$data;

		$img = "<img src='".$imgfull_link."' alt='".$alt."' class='".$class."' title='".$alt."' width='".$width."' height='".$height."' />";

		return $img;
	}

	function get_image_thumb($data,$tipe,$ukuran=null,$alt=null,$width=null,$height=null,$class=null){
		if($ukuran){
			$ukuran = '/'.$ukuran;
		}
		$imglink	 	= Yii::app()->getBaseUrl(true).'/images/uploads/';
		$imgfull_link 	= $imglink.$tipe.$ukuran.'/'.$data;

		return $imgfull_link;
	}

	// shorten string
	// $data : ambil data, $kata : panjang string
	function get_excerpt($data,$kata){
		$count = strlen($data);
		if($count > $kata){
			$end = '...';
		}else{
			$end = '';
		}

		$isi = strip_tags($data);
		$isi = substr($isi,0,$kata);
		$isi_potong = substr($isi,0,strrpos($isi," "));

		return $isi.$end;
	}

	function excerpt_special($text, $kata) {
		if ( !empty($text) ) {

			$text = str_replace(']]>', ']]&gt;', $text);

			$allowed_tags = '<small>,<strong>,<em>,<b>,<i>'; /*** MODIFY THIS. Add the allowed HTML tags separated by a comma.***/
			$twopart_tags = '<small>,<strong>,<em>,<b>,<i>'; /*** MODIFY THIS. Add the twopart HTML tags separated by a comma.***/
			/* turn tag list into one big search pattern */
			$search_patterns = "/" . str_replace(",","|",str_replace(">", "[^>]*>",$twopart_tags)) . '/';

			$text = strip_tags($text, $allowed_tags);

			$excerpt_word_count = $kata; /*** MODIFY THIS. change the excerpt word count to any integer you like.***/

			$excerpt_end = '...'; /*** MODIFY THIS. change the excerpt endind to something else.***/

			$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_word_count + 1, PREG_SPLIT_NO_EMPTY);
			if ( count($words) > $excerpt_word_count ) {
				array_pop($words);
				$text = implode(' ', $words);
				$text = $text . $excerpt_end;
			} else {
				$text = implode(' ', $words);
			};


			/* if fragment ends in open tag, trim off */
			preg_replace ("/<[^>]*$/", "", $text);

			/* search for tags in excerpt */
			preg_match_all ($search_patterns, $text, $matches);
			/* if any tags found, check for matching pairs */
			$tagstack = array ("");
			$tagsfound = $matches[0];
			while ( count ($tagsfound) > 0) {
				$tagmatch = array_shift($tagsfound);
				/* if it's a closing tag, hooray; but if it's not, then look for the closer */
				if ( !strpos($tagmatch,"</") && !strpos ($tagmatch,"/>") ) {
					preg_match("/\pL+/",$tagmatch, $tagwords);
					$endtag = "</" . $tagwords[0] . ">";
					/* if this tag was not closed, put the closing tag on the stack */
					if (!in_array($endtag, $tagsfound) ) {
						array_push($tagstack,$endtag);
					};
				};
			};

			/* if any unbalanced tags were found, add the closing tags */
			while (count ($tagstack) > 1) {
				$text = $text . array_pop($tagstack);
			}

			return $text;
		}
	}

	// get link, untuk semua link kecuali berita
	// $slug : ambil slug,id , $tipe : tipe link,berita,kanal,beritafoto,beritavideo,tag
	function get_link($slug,$tipe=null){
		$transable = "";
		if(Yii::app()->request->getQuery('browsefrom') == "mobile"){
			$transable = "?browsefrom=mobile";
		}
		$link = Yii::app()->createUrl($tipe.'/'.$slug);
		return $link.$transable;
	}

	// get link berita
	// id : ambil id (parameternya), $slug : slug berita , $tipeberita = berita,beritafoto,beritavideo
	function get_link_berita($tipeberita,$id,$slug){
		$transable = "";
		if(Yii::app()->request->getQuery('browsefrom') == "mobile"){
			$transable = "?browsefrom=mobile";
		}
		$link = Yii::app()->createUrl($tipeberita.'/'.$id.'/'.$slug);
		return $link.$transable;
	}


	// get time
	// $data : ambil data waktu
	// $format : format , ex : dd MMMM yyyy | HH:MM , HH:MM
	// $locale : yes / no , jika yes tampilkan wib , jika no tidak tampilkan
	function get_time($data,$format,$locale=null){
		if($data && $locale && $locale=='yes' ){
			$locale = " WIB";
		}else{
			$locale ="";
		}
		$time =  Yii::app()->dateFormatter->formatDateTime($data, "full", "short").$locale;

		return $time;
	}

	//***** DEFINE VARIABLE *****//
	$keyword_default = "jatim,jatim timur";
?>
