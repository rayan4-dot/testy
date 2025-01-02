<?php
namespace app\Modules;

use PDO;

class ArticleManager {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAllArticles() {
        $query = "SELECT 
                    articles.id, 
                    articles.title, 
                    users.username AS author_name, 
                    categories.name AS category_name, 
                    GROUP_CONCAT(tags.name) AS tags,
                    views, 
                    created_at
                  FROM articles
                  JOIN categories ON articles.category_id = categories.id
                  JOIN users ON articles.author_id = users.id
                  JOIN article_tags ON articles.id = article_tags.article_id
                  JOIN tags ON article_tags.tag_id = tags.id
                  GROUP BY articles.id";

        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }

    public function getCategoryStats() {
        $query = "SELECT 
                    COUNT(*) AS article_count, 
                    categories.name AS category_name 
                  FROM articles 
                  JOIN categories ON articles.category_id = categories.id 
                  GROUP BY category_name";

        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }

    public function getTopUsers() {
        $query = "SELECT 
                    users.id, 
                    username, 
                    COUNT(articles.id) AS article_count, 
                    SUM(articles.views) AS total_views 
                  FROM users 
                  JOIN articles ON users.id = articles.author_id 
                  GROUP BY users.id 
                  ORDER BY article_count DESC 
                  LIMIT 3";

        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }

    public function getTopArticles() {
        $query = "SELECT 
                    articles.id, 
                    created_at, 
                    title, 
                    users.username AS author_name, 
                    views 
                  FROM articles 
                  JOIN users ON articles.author_id = users.id 
                  ORDER BY views DESC 
                  LIMIT 3";

        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();
    }

    public function getTableCount($tableName) {
        $query = "SELECT COUNT(*) AS count FROM {$tableName}";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchColumn();
    }
}
?>
