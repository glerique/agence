<?php

namespace App\test\Picture;

use App\Entity\Chalet;
use App\Entity\Picture;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

class TestPicture extends TestCase
{

    private $Picture;

    public function setUp(): void
    {
        $this->picture = new Picture();
    }

    public function testGetId()
    {
        $this->assertEquals(null, $this->picture->getId());
    }

    public function testGetSetUrl()
    {
        $this->picture->setUrl('Test url');
        $this->assertEquals('Test url', $this->picture->getUrl());
    }

    public function testGetSetCaption()
    {
        $this->picture->setCaption('Test caption');
        $this->assertEquals('Test caption', $this->picture->getCaption());
    }

    public function testGetSetChalet()
    {
        $this->picture->setChalet(new Chalet);
        $this->assertInstanceOf(Chalet::class, $this->picture->getChalet());
    }
}
