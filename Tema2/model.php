<?php
require_once 'idiorm.php';
require_once 'paris.php';
ORM::configure('sqlite:db/db.sqlite');

/* This enables the use of Table instead of PwTable all over the place. */
Model::$auto_prefix_models = 'Pw';

class PwUser extends Model {
	public static $_id_column = 'usr_id';

	public function articles() {
		return $this->has_many('Article', 'art_author');
	}
}

class PwCategory extends Model {
	public static $_id_column = 'cat_id';

	public function articles() {
		return $this->has_many_through('Article', null,
				'artc_cat_id', 'artc_art_id');
	}
}

class PwArticle extends Model {
	public static $_id_column = 'art_id';
	
	public function categories() {
		return $this->has_many_through('Category', null,
				'artc_art_id', 'artc_cat_id');
	}

	public function author() {
		return $this->belongs_to('User', 'art_author');
	}
}

class PwArticleCategory extends Model {

}

/*
 * This contains associations between the table names and their corresponding models.
 */
$db_tables = array("pw_user" => "User", "pw_category" => "Category", "pw_article" => "Article",
		"pw_article_category" => "ArticleCategory");

?>