<?php 
	
	// funtion get img 
	// Ukuran berita 	: default , 700, 700x350, 135x75, 340x170, 100x100, 150x150 :: 
	// Ukuran halaman 	: default , 700
	// Ukuran Iklan 	: default (no resize)
	// Tipe::folder 	: berita, iklan, halaman	
	// Width : , Height :
	function get_image($data,$tipe,$ukuran=null,$alt=null,$width=null,$height=null,$class=null){
		if($ukuran){
			$ukuran = '/'.$ukuran;
		}
		// $imglink	 	= 'http://bangsaonline.com'.'/images/uploads/';
		$imglink	 	= 'http://192.168.1.9/bangsaonline'.'/images/uploads/';
		$imgfull_link 	= $imglink.$tipe.$ukuran.'/'.$data;
		
		$img = "<img src='".$imgfull_link."' alt='".$alt."' class='".$class."' />";
		
		return $img;
	}
	
	function get_image_thumb($data,$tipe,$ukuran=null,$alt=null,$width=null,$height=null,$class=null){
		if($ukuran){
			$ukuran = '/'.$ukuran;
		}
		// $imglink	 	= 'https://bangsaonline.com'.'/images/uploads/';
		$imglink	 	= 'http://192.168.1.9/bangsaonline'.'/images/uploads/';
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
	
	// get link, untuk semua link kecuali berita 
	// $slug : ambil slug,id , $tipe : tipe link,berita,kanal,beritafoto,beritavideo,tag 
	function get_link($slug,$tipe=null){
		$transable = "";
		if(Yii::app()->request->getQuery('browsefrom') == "desktop"){
			$transable = "?browsefrom=desktop";
		}
		$link = Yii::app()->createUrl($tipe.'/'.$slug);
		return $link.$transable;
	}
	
	// get link berita 
	// id : ambil id (parameternya), $slug : slug berita , $tipeberita = berita,beritafoto,beritavideo 
	function get_link_berita($tipeberita,$id,$slug){
		$transable = "";
		if(Yii::app()->request->getQuery('browsefrom') == "desktop"){
			$transable = "?browsefrom=desktop";
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

	function get_image_polling($data,$alt=null,$class=null){
		$imglink	 	= 'https://bangsaonline.com'.'/images/uploads/polling';
		// $imglink	 	= 'http://192.168.1.9/bangsaonline'.'/images/uploads/';
		$imgfull_link 	= $imglink.'/'.$data;
		
		$img = "<img src='".$imgfull_link."' alt='".$alt."' class='".$class."' />";
		
		return $img;
	}


?>