<?php 
header("Content-type: text/xml");

$baseUrl = Yii::app()->request->hostInfo . Yii::app()->request->baseUrl;
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <?php /*
    <url>
        <loc>https://www.merdeka.com/peristiwa/fakta-unik-dalam-angka-kunjungan-raja-salman-ke-indonesia.html</loc>
        <news:news>
            <news:publication>
                <news:name>Merdeka.com</news:name>
                <news:language>id</news:language>
            </news:publication>
            <news:publication_date>2017-03-13T07:15:00+07:00</news:publication_date>
            <news:title>Fakta unik dalam angka kunjungan Raja Salman ke Indonesia</news:title>
            <news:keywords>fakta, unik, dalam, angka, kunjungan, raja, salman, ke, indonesia, di, antaranya, 2500, personel, tni, polrijumlah, personel, tni, dan, polri, yang, mengamankan, liburan, raja, salman, di, bali, sedikitnya, ada, 2500, personel, jumlah, ini, masih, ditambah, para, pecalang, dan, 16, mobil, boks, oleh, oleh, dari, bali</news:keywords>
            <news:geo_locations>Jakarta Indonesia</news:geo_locations>
        </news:news>
        <image:image>
            <image:loc>https://cdns.klimg.com/merdeka.com/i/w/news/2017/03/12/821589/540x270/fakta-unik-dalam-angka-kunjungan-raja-salman-ke-indonesia.jpg</image:loc>
            <image:caption>Jokowi dan Raja Salman kehujanan di Istana Bogor. ©facebook.com/Joko Widodo</image:caption>
            <image:title>Fakta unik dalam angka kunjungan Raja Salman ke Indonesia</image:title>
        </image:image>
    </url>
    */ ?>
    <?php foreach ($model as $key => $value): ?>
    <url>
      <loc><?php //echo $baseUrl ?>http://www.bangsaonline.com/berita/<?php echo $value['news_id'] ?>/<?php echo $value['news_slug'] ?></loc>
      <news:news>
        <news:publication>
          <news:name>Bangsaonline.com</news:name>
          <news:language>id</news:language>
        </news:publication>
        <news:publication_date><?php echo date('c', strtotime($value['news_modified'])); ?></news:publication_date>
        <news:title><?php echo htmlspecialchars($value['news_title']) ?></news:title>
        <news:keywords><?php echo ($value['news_meta_keyword'] != '')? htmlspecialchars($value['news_meta_keyword']) : 'Portal Berita Harian Bangsa Online - Cepat Lugas dan Akurat'; ?></news:keywords>
      </news:news>
    </url>
    <?php endforeach ?>
</urlset>