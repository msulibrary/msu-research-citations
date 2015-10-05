-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (x86_64)

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `msu_research_citations`
--

-- --------------------------------------------------------

--
-- Table structure for table `affiliations`
--

CREATE TABLE IF NOT EXISTS `affiliations` (
  `affiliation_key` int(10) NOT NULL AUTO_INCREMENT,
  `author_key` int(10) NOT NULL,
  `name_affiliation_msuCollege` varchar(255) NOT NULL COMMENT 'element_subelement_local-element - author msu college affiliation',
  `name_affiliation_msuDepartment` varchar(255) NOT NULL COMMENT 'element_subelement_local-element - author msu department affiliation',
  `name_affiliation_otherAffiliation` varchar(255) NOT NULL COMMENT 'element_subelement_local-element - author non msu affiliation',
  UNIQUE KEY `affiliation_key` (`affiliation_key`),
  KEY `author_key` (`author_key`),
  FULLTEXT KEY `name_affiliation_msuCollege` (`name_affiliation_msuCollege`),
  FULLTEXT KEY `name_affiliation_msuDepartment` (`name_affiliation_msuDepartment`),
  FULLTEXT KEY `name_affiliation_otherInstitution` (`name_affiliation_otherAffiliation`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_key` int(10) NOT NULL AUTO_INCREMENT,
  `recordInfo_recordIdentifier` int(10) NOT NULL,
  `name_namePart` varchar(255) NOT NULL,
  PRIMARY KEY (`author_key`),
  KEY `recordInfo_recordIdentifier` (`recordInfo_recordIdentifier`),
  FULLTEXT KEY `name_namePart` (`name_namePart`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

CREATE TABLE IF NOT EXISTS `feeds` (
  `relatedItem_originInfo_feed_identifier` int(10) NOT NULL AUTO_INCREMENT COMMENT 'element_subelement_subelement_subelement - newsfeed id',
  `relatedItem_originInfo_feed_publisher` varchar(255) DEFAULT NULL COMMENT 'element_subelement_subelement_subelement - newsfeed publisher',
  `relatedItem_originInfo_feed_url` text COMMENT 'element_subelement_subelement_subelement - newsfeed url',
  PRIMARY KEY (`relatedItem_originInfo_feed_identifier`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mods`
--

CREATE TABLE IF NOT EXISTS `mods` (
  `recordInfo_recordIdentifier` int(10) NOT NULL AUTO_INCREMENT COMMENT 'element_subelement - record id',
  `titleInfo_title` varchar(300) NOT NULL DEFAULT '' COMMENT 'element_subelement - article title',
  `abstract` text NOT NULL COMMENT 'element - article abstract',
  `extension` varchar(255) NOT NULL DEFAULT '' COMMENT 'element - article published comma-delimited content keywords',
  `originInfo_dateIssued` varchar(30) NOT NULL DEFAULT '' COMMENT 'element_subelement - date article published',
  `relatedItem_identifier` varchar(255) NOT NULL DEFAULT '' COMMENT 'element_subelement - original article doi',
  `relatedItem_identifier_isbn` varchar(255) DEFAULT NULL,
  `relatedItem_identifier_pmcid` varchar(255) DEFAULT NULL,
  `relatedItem_location_holdingSimple_copyInformation_note` varchar(255) NOT NULL DEFAULT '' COMMENT ' element_subelement_subelement_subelement_subelement - scholarworks doi',
  `relatedItem_relatedItem_location_holdingSimple_url` varchar(255) NOT NULL DEFAULT '' COMMENT 'associated dataset location',
  `relatedItem_titleInfo_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'element_subelement_subelement - periodical title',
  `relatedItem_part_detail_volume` varchar(255) NOT NULL DEFAULT '' COMMENT 'element_subelement_subelement_subelement - periodical volume',
  `relatedItem_part_detail_number` varchar(255) NOT NULL DEFAULT '' COMMENT 'element_subelement_subelement_subelement - periodical number',
  `relatedItem_part_extent_start` varchar(10) NOT NULL COMMENT 'element_subelement_subelement_subelement - article first page number',
  `relatedItem_part_extent_end` varchar(10) NOT NULL COMMENT 'element_subelement_subelement_subelement - article end page number',
  `relatedItem_part_text` varchar(255) NOT NULL DEFAULT '' COMMENT 'element_subelement_subelement - original article published type',
  `relatedItem_extension1` varchar(255) NOT NULL DEFAULT '' COMMENT 'element_subelement - google scholar category',
  `relatedItem_extension2` varchar(255) NOT NULL DEFAULT '' COMMENT 'element_subelement - google scholar category',
  `relatedItem_extension3` varchar(255) NOT NULL DEFAULT '' COMMENT 'element_subelement - google scholar category',
  `relatedItem_accessCondition` varchar(255) NOT NULL DEFAULT '' COMMENT 'element_subelement - article publisher copyright conditions',
  `relatedItem_note_grantor` varchar(255) NOT NULL DEFAULT '' COMMENT 'element_subelement_local-element - semicolon-seperated grantors',
  `relatedItem_originInfo_dateOther` varchar(30) NOT NULL DEFAULT '' COMMENT 'element_subelement_subelement - msu library customized date',
  `relatedItem_originInfo_publisher` varchar(255) NOT NULL DEFAULT '' COMMENT 'element_subelement_subelement - newsfeed publisher url',
  `relatedItem_originInfo_dateCreated` varchar(255) NOT NULL DEFAULT '' COMMENT 'element_subelement_subelement - newsfeed published date',
  `relatedItem_physicalDescription_hash` varchar(40) DEFAULT NULL COMMENT 'local - sha1 hash of title',
  `originInfo_publisher` varchar(255) NOT NULL DEFAULT 'Montana State University Library' COMMENT 'element_subelement - database publisher',
  `accessCondition` varchar(255) NOT NULL DEFAULT 'Attribution Non-Commercial Share Alike Creative Commons ' COMMENT 'element - database copyright conditions',
  `recordInfo_languageOfCataloging` varchar(5) NOT NULL DEFAULT 'en' COMMENT 'element_subelement - language of record',
  `recordInfo_recordContentSource` varchar(10) NOT NULL DEFAULT 'MZF' COMMENT 'element_subelement - oclc institution id',
  `recordInfo_recordCreationDate` date NOT NULL DEFAULT '0000-00-00' COMMENT 'element_subelement - date record created',
  `recordInfo_recordModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'element_subelement - date record modified',
  `status` varchar(10) CHARACTER SET ucs2 NOT NULL DEFAULT 'r' COMMENT 'local-element - record activity status',
  PRIMARY KEY (`recordInfo_recordIdentifier`),
  FULLTEXT KEY `title` (`titleInfo_title`),
  FULLTEXT KEY `keywords` (`titleInfo_title`,`relatedItem_titleInfo_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
