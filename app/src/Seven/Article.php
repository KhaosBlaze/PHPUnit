<?php

namespace Seven;

/**
 * Article class
 */
class Article
{
    /**
     * Article Title
     * @var string
     */
    public $title;

    /**
     * Article Slug
     * @var string
     */
    private $slug;

    /**
     * Set Article Title
     * 
     * @param string $title Article Title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
        $slug = $title;
        $slug = trim($slug);
        $slug = preg_replace('/\s+/', '_', $slug);
        $slug = preg_replace('/[^\w]/', '', $slug);
        $this->slug = $slug;
    }

    /**
     * Get Article Slug
     * 
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}