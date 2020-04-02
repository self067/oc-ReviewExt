--
-- Table structure for table `oc_review_images`
--

DROP TABLE IF EXISTS `oc_review_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_review_images` (
  `review_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL, 
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`review_image_id`),
  KEY `review_id` (`review_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
