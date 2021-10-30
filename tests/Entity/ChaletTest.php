<?php

namespace App\tests\Entity;

use App\Entity\Chalet;
use App\Entity\Picture;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

class ChaletTest extends TestCase
{
    private $chalet;

    public function setUp(): void
    {
        $this->chalet = new Chalet();
    }

    public function testGetId()
    {
        $this->assertEquals(null, $this->chalet->getId());
    }

    public function testGetSetName()
    {
        $this->chalet->setName('Test name');
        $this->assertEquals('Test name', $this->chalet->getName());
    }

    public function testGetSetslug()
    {
        $this->chalet->setSlug('test-slug');
        $this->assertEquals('test-slug', $this->chalet->getSlug());
    }

    public function testGetSetDescription()
    {
        $this->chalet->setDescription('Test description');
        $this->assertEquals('Test description', $this->chalet->getDescription());
    }

    public function testGetSetCoverImage()
    {
        $this->chalet->setCoverImage('test.jpg');
        $this->assertEquals('test.jpg', $this->chalet->getCoverImage());
    }

    public function testGetSetBedrooms()
    {
        $this->chalet->setBedrooms('5');
        $this->assertEquals('5', $this->chalet->getBedrooms());
    }

    public function testGetSetBathrooms()
    {
        $this->chalet->setBathrooms('5');
        $this->assertEquals('5', $this->chalet->getBathrooms());
    }

    public function testGetSetPrice()
    {
        $this->chalet->setPrice('10000');
        $this->assertEquals('10000', $this->chalet->getPrice());
    }

    public function testGetAddPictures()
    {
        $this->assertInstanceOf(Chalet::class, $this->chalet->AddPicture(new Picture()));
        $this->assertInstanceOf(ArrayCollection::class, $this->chalet->getPictures());
        $this->assertContainsOnlyInstancesOf(Picture::class, $this->chalet->getPictures());
    }

    public function testRemovePicture()
    {


        $this->assertInstanceOf(Chalet::class, $this->chalet->removePicture(new Picture()));
        $this->assertEmpty($this->chalet->getPictures());


        $picture = new Picture();
        $this->chalet->addPicture($picture);
        $this->chalet->removePicture($picture);
        $this->assertEmpty($this->chalet->getPictures());
        $this->assertInstanceOf(Chalet::class, $this->chalet->removePicture(new Picture()));
    }
}
