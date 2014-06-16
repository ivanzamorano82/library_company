<?php

class m140616_040706_createDB extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
            $sql="-- -----------------------------------------------------
-- Table `tbl_reader`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tbl_reader` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `date_create` DATE NULL ,
  `date_change` DATE NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tbl_book`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tbl_book` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `date_create` DATE NULL ,
  `date_change` DATE NULL ,
  `reader_id` INT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tbl_book_tbl_reader1_idx` (`reader_id` ASC) ,
  CONSTRAINT `fk_tbl_book_tbl_reader1`
    FOREIGN KEY (`reader_id` )
    REFERENCES `tbl_reader` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tbl_author`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tbl_author` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `date_create` DATE NULL ,
  `date_change` DATE NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tbl_book_author`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tbl_book_author` (
  `book_id` INT NOT NULL ,
  `author_id` INT NOT NULL ,
  PRIMARY KEY (`book_id`, `author_id`) ,
  INDEX `fk_tbl_book_has_tbl_author_tbl_author1_idx` (`author_id` ASC) ,
  INDEX `fk_tbl_book_has_tbl_author_tbl_book1_idx` (`book_id` ASC) ,
  CONSTRAINT `fk_tbl_book_has_tbl_author_tbl_book1`
    FOREIGN KEY (`book_id` )
    REFERENCES `tbl_book` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_book_has_tbl_author_tbl_author1`
    FOREIGN KEY (`author_id` )
    REFERENCES `tbl_author` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

";
            $this->execute($sql);
	}

	public function safeDown()
	{
            $this->dropTable('{{book_author}}');
            $this->dropTable('{{author}}');
            $this->dropTable('{{book}}');
            $this->dropTable('{{reader}}');
	}
}