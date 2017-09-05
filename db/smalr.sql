SET time_zone = "+05:30";

CREATE TABLE IF NOT EXISTS 'urlBank' (
	'id' int(11) NOT NULL AUTO_INCREMENT,
	'url' varchar(1000) DEFAULT NULL,
	'shortcode' varchar(20) DEFAULT NULL,
	'timestamp' timestamp DEFAULT NULL,
	PRIMARY KEY (id)
);

