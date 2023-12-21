<?php

use PHPUnit\Framework\TestCase;
use Seven\Article;

class ArticleTest extends TestCase
{
    protected $article;

    protected function setUp(): void
    {
        $this->article = new Article;
    }

    public function testTitleIsEmptyByDefault()
    {
        $this->assertEmpty($this->article->title);
    }

    public function testSlugIsEmptyWithNoTitle()
    {
        $this->assertEmpty($this->article->getSlug());
    }

    /*
    public function testSlugHasSpacesReplacedByUnderscores()
    {
        $this->article->setTitle("An example article");

        $this->assertEquals($this->article->getSlug(), "An_example_article");
    }

    public function testSlugHasWhitespacesReplacedBySingleUnderscores()
    {
        $this->article->setTitle("An                example         article");
        $this->assertEquals($this->article->getSlug(), "An_example_article");
    }

    public function testSlugDoesNotStartOrEndWithAnUnderscore()
    {
        $this->article->setTitle("     An    example  \n article   ");
        $this->assertEquals($this->article->getSlug(), "An_example_article");
    }

    public function testSlugDoesNotHaveAnyNonWordCharacters()
    {
        $this->article->setTitle("     Read!    thi!s  \n no!!!w   ");
        $this->assertEquals($this->article->getSlug(), "Read_this_now");
    }
    */

    public static function titleProvider()
    {
        return array(
            "Slug Has Spaces Replaced By Underscores" =>
            array("An example article",
                "An_example_article"),
            "Slug Has Spaces Whitespaces By Single Underscore" =>
            array("An                example         article",
                "An_example_article"),
            "Slug Does Not Start Or End With An Underscore" =>
            array("     An    example  \n article   ",
                "An_example_article"),
            "Slug Does Not Have Any Non Word Characters" =>
            array("     Read!    thi!s  \n no!!!w   ",
                "Read_this_now")
        );
    }

    /**
     * @dataProvider titleProvider
     */
    public function testSlug($title, $slug)
    {
        $this->article->setTitle($title);
        $this->assertEquals($this->article->getSlug(), $slug);
    }
}