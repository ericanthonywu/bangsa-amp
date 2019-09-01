<?php 

// CREATE VIEW TableSchema view slide
CREATE VIEW view_slide as SELECT
`b`.`news_id`,
`b`.`news_slug`,
`b`.`news_title`,
`b`.`news_excerpt`,
`b`.`news_date`,
`b`.`news_content`,
`f`.`filename`
FROM `module_news` AS `b` INNER JOIN `files` AS `f` ON(`b`.`news_id`=`f`.`object_id`) 
WHERE `f`.`module_id` ='1' AND
 `b`.`is_headline` = '1' AND 
 `b`.`news_type`='1' AND 
 `b`.`news_status`='1' 
ORDER BY `b`.`news_id` DESC LIMIT 10;

// CREATE VIEW TableSchema view_latest_news
CREATE VIEW view_latest_news as SELECT 
b.*
FROM `module_news` `b`
WHERE b.news_status='1' 
ORDER BY b.news_id DESC;

// CREATE VIEW TableSchema view_files
CREATE VIEW view_files as SELECT 
fls.*
FROM `files` fls
ORDER BY fls.id DESC

// CREATE VIEW TableSchema view_kanal_news
CREATE VIEW view_kanal_news as SELECT 
c.category_id,
c.category_slug,
c.category_name,
cr.post_id,
cr.category_id as category_id2,
b.news_id,
b.news_title,
b.news_content,
b.news_slug,
b.news_type,
b.news_date,
b.news_status,
b.news_penulis,
b.news_wartawan,
b.news_author,
b.news_modified,
b.news_source,
b.news_meta_title,
b.news_meta_keyword,
b.news_meta_desc,
b.click_count,
fls.caption_title,
fls.caption_desc,
fls.module_id,
fls.filename
FROM `category_relationship` cr 
INNER JOIN  `module_news` b ON(cr.post_id=b.news_id) 
INNER JOIN `category` c ON(cr.category_id=c.category_id) 
LEFT JOIN `files` fls ON(fls.object_id=b.news_id)
WHERE b.news_status='1' 
ORDER BY b.news_id DESC

// CREATE VIEW TableSchema view_tag_news
CREATE VIEW view_tag_news as SELECT t.*,tr.* 
FROM tag t 
INNER JOIN tag_relationship tr ON(tr.tagId=t.id)

// CREATE VIEW TableSchema views_other_news
// trouble setting
DROP VIEW IF EXISTS view_other_news;
CREATE VIEW view_other_news as 
SELECT b.news_title, b.news_id, b.news_image, b.news_slug, b.news_type,
fls.caption_title,fls.caption_desc,fls.filename 
FROM module_news b 
INNER JOIN tag_relationship tr ON(tr.post_id=b.news_id) 
LEFT JOIN `files` fls ON(fls.object_id=b.news_id)
WHERE tr.tagId IN(SELECT tagId FROM tag_relationship WHERE post_id = '$this_id') AND b.news_id !='$this_id' AND fls.module_id = '1' GROUP BY b.news_id;

// terpakai
DROP VIEW IF EXISTS view_other_news;
CREATE VIEW view_other_news as 
SELECT b.news_title, b.news_id, b.news_image, b.news_slug, b.news_type, fls.caption_title,fls.caption_desc,fls.filename,tr.tagId
FROM tag_relationship tr
LEFT JOIN module_news b ON(tr.post_id=b.news_id)
LEFT JOIN files fls ON(fls.object_id=b.news_id)
ORDER BY b.news_id DESC;


// CREATE VIEW TableSchema view_hotnews_latest
DROP VIEW IF EXISTS view_hotnews_latest;
CREATE VIEW view_hotnews_latest as SELECT news_id,news_title,news_content,news_slug,news_date 
FROM module_news WHERE news_type='1' AND news_status='1' ORDER BY news_id DESC LIMIT 10;