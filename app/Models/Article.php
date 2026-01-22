<?php
// app/Models/Article.php

class Article
{
    /**
     * Find article by ID
     */
    public static function findById($id)
    {
        $pdo = Config::getPDO();

        $stmt = $pdo->prepare("
            SELECT a.*, c.name as club_name, e.title as event_title
            FROM articles a
            LEFT JOIN clubs c ON a.club_id = c.id
            LEFT JOIN events e ON a.event_id = e.id
            WHERE a.id = :id
        ");

        $stmt->execute(['id' => (int)$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get all articles
     */
    public static function getAll($limit = null)
    {
        $pdo = Config::getPDO();

        $sql = "
            SELECT a.*, c.name as club_name
            FROM articles a
            LEFT JOIN clubs c ON a.club_id = c.id
            ORDER BY a.created_at DESC
        ";

        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get articles by club ID
     */
    public static function getByClubId($clubId, $limit = null)
    {
        $pdo = Config::getPDO();

        $sql = "
            SELECT a.*, e.title as event_title
            FROM articles a
            LEFT JOIN events e ON a.event_id = e.id
            WHERE a.club_id = :club_id
            ORDER BY a.created_at DESC
        ";

        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['club_id' => (int)$clubId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Create new article
     */
    public static function create($data)
    {
        $pdo = Config::getPDO();

        $stmt = $pdo->prepare("
            INSERT INTO articles (club_id, event_id, title, content, image_url)
            VALUES (:club_id, :event_id, :title, :content, :image_url)
            RETURNING id
        ");

        $stmt->execute([
            'club_id' => (int)$data['club_id'],
            'event_id' => !empty($data['event_id']) ? (int)$data['event_id'] : null,
            'title' => $data['title'],
            'content' => $data['content'],
            'image_url' => $data['image_url'] ?? null
        ]);

        $row = $stmt->fetch();
        return $row['id'] ?? null;
    }

    /**
     * Update article
     */
    public static function update($id, $data)
    {
        $pdo = Config::getPDO();

        $stmt = $pdo->prepare("
            UPDATE articles 
            SET title = :title, 
                content = :content, 
                image_url = :image_url,
                event_id = :event_id
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => (int)$id,
            'title' => $data['title'],
            'content' => $data['content'],
            'image_url' => $data['image_url'] ?? null,
            'event_id' => !empty($data['event_id']) ? (int)$data['event_id'] : null
        ]);
    }

    /**
     * Delete article
     */
    public static function delete($id)
    {
        $pdo = Config::getPDO();

        $stmt = $pdo->prepare("DELETE FROM articles WHERE id = :id");
        return $stmt->execute(['id' => (int)$id]);
    }

    public static function getArticle($articleId)
    {
        $pdo = Config::getPDO();

        $stmt = $pdo->prepare(
            "select *,event_id as event from articles where id = :article_id"
        );
        $stmt->execute(['article_id' => $articleId]);
        return $stmt->fetch();
    }
}
