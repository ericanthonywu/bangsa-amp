<?php

class SiteController extends Controller
{
	
	protected function beforeRender($action){
		if(Yii::app()->mobileDetect->isMobile()){
			if(Yii::app()->request->getQuery('browsefrom') == "mobile"){
				return true;
			}
			else{
                // $this->redirect('http://m.bangsaonline.com'.Yii::app()->request->requestUri);
				$this->redirect(Yii::app()->request->hostInfo . Yii::app()->request->baseUrl. '/mobile/');
			}
		}
		else{
			return true;
		}
	}
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	/*public function filters()
	{
		return array(
			array(
				'COutputCache',
				'duration'=>100,
				'varyByParam'=>array('id'),
			),
		);
	} */
	

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        // echo "Index Lasdkfjksdjf"; exit;
		$this->render('index');
	}
	
	public function actionDefault()
	{
        // echo "asdfasdf"; exit;
		$this->layout = 'main-default';
		$this->render('default/index');
		
	}
	
	public function actionOptimize()
	{
		
		$this->layout = 'main-optimize';
		$this->render('optimize/index');
		
	}
	
	public function actionOptimizeardi()
	{
		
		$this->layout = 'main-optimize-ardi';
		$this->render('optimizeardi/index');
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionSitemapxmlnews()
    {
        // cache sitemap 5menit
        $sitemap_cache =Yii::app()->cache->get('sitemapCache');
        if($sitemap_cache===false)
        {
            // lopping news terbaru 50 item
            $news = Yii::app()->db->createCommand(
                "SELECT b.news_id, b.news_title, b.news_slug, b.news_meta_keyword, b.news_modified
                -- , c.category_id, c.category_slug, c.category_name
                FROM module_news b
                WHERE news_status = 1
                -- LEFT JOIN category_relationship cr ON ( cr.post_id = b.news_id ) 
                -- LEFT JOIN  `category` c ON ( cr.category_id = c.category_id ) 
                ORDER BY b.news_id DESC LIMIT 0 , 50"
                )->queryAll();
            Yii::app()->cache->set('sitemapCache', $news, 300);
        }else{
                $news = $sitemap_cache;
        }

        $this->renderPartial('sitemap_news',array('model'=>$news));
        exit;
    }

	public function actionGenerateazzamediaxmlazzamedia()
	{
		$sitemap = new Sitemap('sitemap.xml');
		$loop = 0;
		
		$url = Yii::app()->getBaseUrl(true);
		
		$sitemap->addItem($url.'/indeks', time(), Sitemap::HOURLY);
		
		/* Link from static page */
		$pages = Yii::app()->db->createCommand("SELECT page_id, page_slug, page_modified FROM page ORDER BY page_id ASC")->queryAll();
		foreach($pages as $n=>$page){
			$loop++;
			$menulink = get_link($page['page_slug']);
			$sitemap->addItem(htmlentities($url.$menulink));
		}
		
		// Kanal
		$categories = Yii::app()->db->createCommand("SELECT category_id, category_slug FROM category ORDER BY category_id ASC")->queryAll();
		foreach($categories as $category){
			$loop++;
			$sitemap->addItem(htmlentities($url.'/kanal/'.$category['category_slug']), time(), Sitemap::DAILY, 0.2);
		}
		
		// Tag
		$tags = Yii::app()->db->createCommand("SELECT id, tag_name FROM tag ORDER BY id ASC")->queryAll();
		foreach($tags as $tag){
			$loop++;
			$sitemap->addItem(htmlentities($url.'/tag/'.$tag['tag_name']), time(), Sitemap::DAILY, 0.3);
		}
		
		// Berita
		$news = Yii::app()->db->createCommand("SELECT news_id, news_title, news_slug, UNIX_TIMESTAMP(news_modified) as news_modified FROM module_news ORDER BY news_id DESC")->queryAll();
		foreach($news as $new){
			$loop++;
			$link = get_link($new['news_slug']);
			$sitemap->addItem(htmlentities($url.'/berita/'.$new['news_id'].'/'.$new['news_slug'], ENT_QUOTES), $new['news_modified']);
		}
		
		$sitemap->write();
		$all_sitemap = $sitemap->getSitemapUrls($url.'/');
		
		$index = new Index('sitemap_index.xml');
		
		foreach($all_sitemap as $sitemap){
			$index->addSitemap($sitemap);
		}
		
		$index->write();
	}
	
	
}


class Index
{
    /**
     * @var XMLWriter
     */
    private $writer;

    /**
     * @var string index file path
     */
    private $filePath;

    /**
     * @param string $filePath index file path
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Creates new file
     */
    private function createNewFile()
    {
        $this->writer = new XMLWriter();
        $this->writer->openMemory();
        $this->writer->startDocument('1.0', 'UTF-8');
        $this->writer->setIndent(true);
        $this->writer->startElement('sitemapindex');
        $this->writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
    }

    /**
     * Adds sitemap link to the index file
     *
     * @param string $location URL of the sitemap
     * @param integer $lastModified unix timestamp of sitemap modification time
     * @throws \InvalidArgumentException
     */
    public function addSitemap($location, $lastModified = null)
    {
        if (false === parse_url($location)) {
            throw new \InvalidArgumentException(
                "The location must be a valid URL. You have specified: {$location}."
            );
        }

        if ($this->writer === null) {
            $this->createNewFile();
        }

        $this->writer->startElement('sitemap');
        $this->writer->writeElement('loc', $location);

        if ($lastModified !== null) {
            $this->writer->writeElement('lastmod', date('c', $lastModified));
        }
        $this->writer->endElement();
    }

    /**
     * @return string index file path
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * Finishes writing
     */
    public function write()
    {
        if ($this->writer instanceof XMLWriter) {
            $this->writer->endElement();
            $this->writer->endDocument();
            file_put_contents($this->getFilePath(), $this->writer->flush());
        }
    }
}


class Sitemap
{
    const ALWAYS = 'always';
    const HOURLY = 'hourly';
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';
    const NEVER = 'never';

    /**
     * @var integer Maximum allowed number of URLs in a single file.
     */
    private $maxUrls = 50000;

    /**
     * @var integer number of URLs added
     */
    private $urlsCount = 0;

    /**
     * @var string path to the file to be written
     */
    private $filePath;

    /**
     * @var integer number of files written
     */
    private $fileCount = 0;

    /**
     * @var array path of files written
     */
    private $writtenFilePaths = [];

    /**
     * @var integer number of URLs to be kept in memory before writing it to file
     */
    private $bufferSize = 1000;

    /**
     * @var array valid values for frequency parameter
     */
    private $validFrequencies = [
        self::ALWAYS,
        self::HOURLY,
        self::DAILY,
        self::WEEKLY,
        self::MONTHLY,
        self::YEARLY,
        self::NEVER
    ];


    /**
     * @var XMLWriter
     */
    private $writer;

    /**
     * @param string $filePath path of the file to write to
     * @throws \InvalidArgumentException
     */
    public function __construct($filePath)
    {
        $dir = dirname($filePath);
        if (!is_dir($dir)) {
            throw new \InvalidArgumentException(
                "Please specify valid file path. Directory not exists. You have specified: {$dir}."
            );
        }

        $this->filePath = $filePath;
    }

    /**
     * Creats new file
     */
    private function createNewFile()
    {
        $this->fileCount++;
        $filePath = $this->getCurrentFilePath();
        $this->writtenFilePaths[] = $filePath;
        @unlink($filePath);

        $this->writer = new XMLWriter();
        $this->writer->openMemory();
        $this->writer->startDocument('1.0', 'UTF-8');
        $this->writer->setIndent(true);
        $this->writer->startElement('urlset');
        $this->writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
    }

    /**
     * Writes closing tags to current file
     */
    private function finishFile()
    {
        if ($this->writer !== null) {
            $this->writer->endElement();
            $this->writer->endDocument();
            $this->flush();
        }
    }

    /**
     * Finishes writing
     */
    public function write()
    {
        $this->finishFile();
    }

    /**
     * Flushes buffer into file
     */
    private function flush()
    {
        file_put_contents($this->getCurrentFilePath(), $this->writer->flush(true), FILE_APPEND);
    }

    /**
     * Adds a new item to sitemap
     *
     * @param string $location location item URL
     * @param integer $lastModified last modification timestamp
     * @param float $changeFrequency change frquency. Use one of self:: contants here
     * @param string $priority item's priority (0.0-1.0). Default null is equal to 0.5
     *
     * @throws \InvalidArgumentException
     */
    public function addItem($location, $lastModified = null, $changeFrequency = null, $priority = null)
    {
        if ($this->urlsCount === 0) {
            $this->createNewFile();
        } elseif ($this->urlsCount % $this->maxUrls === 0) {
            $this->finishFile();
            $this->createNewFile();
        }

        if ($this->urlsCount % $this->bufferSize === 0) {
            $this->flush();
        }

        $this->writer->startElement('url');

        if (false === parse_url($location)) {
            throw new \InvalidArgumentException(
                "The location must be a valid URL. You have specified: {$location}."
            );
        }

        $this->writer->writeElement('loc', $location);

        if ($lastModified !== null) {
            $this->writer->writeElement('lastmod', date('c', $lastModified));
        }

        if ($changeFrequency !== null) {
            if (!in_array($changeFrequency, $this->validFrequencies, true)) {
                throw new \InvalidArgumentException(
                    'Please specify valid changeFrequency. Valid values are: '
                    . implode(', ', $this->validFrequencies)
                    . "You have specified: {$changeFrequency}."
                );
            }

            $this->writer->writeElement('changefreq', $changeFrequency);
        }

        if ($priority !== null) {
            if (!is_numeric($priority) || $priority < 0 || $priority > 1) {
                throw new \InvalidArgumentException(
                    "Please specify valid priority. Valid values range from 0.0 to 1.0. You have specified: {$priority}."
                );
            }
            $this->writer->writeElement('priority', $priority);
        }

        $this->writer->endElement();

        $this->urlsCount++;
    }

    /**
     * @return string path of currently opened file
     */
    private function getCurrentFilePath()
    {
        if ($this->fileCount < 2) {
            return $this->filePath;
        }

        $parts = pathinfo($this->filePath);
        return $parts['dirname'] . DIRECTORY_SEPARATOR . $parts['filename'] . '_' . $this->fileCount . '.' . $parts['extension'];
    }

    /**
     * Returns an array of URLs written
     *
     * @param string $baseUrl base URL of all the sitemaps written
     * @return array URLs of sitemaps written
     */
    public function getSitemapUrls($baseUrl)
    {
        $urls = [];
        foreach ($this->writtenFilePaths as $file) {
            $urls[] = $baseUrl . pathinfo($file, PATHINFO_BASENAME);
        }
        return $urls;
    }

    /**
     * Sets maximum number of URLs to write in a single file.
     * Default is 50000.
     * @param integer $number
     */
    public function setMaxUrls($number)
    {
        $this->maxUrls = (int)$number;
    }

    /**
     * Sets number of URLs to be kept in memory before writing it to file.
     * Default is 1000.
     *
     * @param integer $number
     */
    public function setBufferSize($number)
    {
        $this->bufferSize = (int)$number;
    }
}

