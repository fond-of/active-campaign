<?php

namespace FondOfBags\ActiveCampaign\Service;

use FondOfPHP\ActiveCampaign\Service\MailingList;
use FondOfPHP\ActiveCampaign\Transfer\ResponseDummy;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class MailingListTest extends TestCase
{
    /**
     * @var null|MailingList
     */
    protected $mailingListService = null;

    /**
     * @var PHPUnit_Framework_MockObject_MockBuilder
     */
    protected $mockHttpClient;

    /**
     * @var PHPUnit_Framework_MockObject_MockBuilder
     */
    protected $mochSerializerBuilder;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->mockHttpClient = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mochSerializerBuilder = $this->getMockBuilder(SerializerBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['deserialize'])
            ->getMock();

        $this->mailingListService = new MailingList(
            $this->mockHttpClient,
            'HOST_ADDRESS',
            $this->mochSerializerBuilder
        );
    }

    /**
     * @test
     */
    public function testGetAllSuccess()
    {
        $list = [
            new \FondOfPHP\ActiveCampaign\DataTransferObject\MailingList(),
            new \FondOfPHP\ActiveCampaign\DataTransferObject\MailingList(),
            new \FondOfPHP\ActiveCampaign\DataTransferObject\MailingList(),
        ];

        $this->mockHttpClient->expects($this->once())
            ->method('request')
            ->willReturn(new ResponseDummy());

        $this->mochSerializerBuilder
            ->expects($this->once())
            ->method('deserialize')
            ->with()
            ->willReturn($list);

        $mailingLists = $this->mailingListService->getAll();

        $this->assertEquals(3, count($mailingLists));
    }

    public function testGetAllInvalidResponse()
    {
        $this->mockHttpClient->expects($this->once())
            ->method('request')
            ->willReturn(new ResponseDummy(false));

        $mailingLists = $this->mailingListService->getAll();

        $this->assertNull($mailingLists);
    }

    public function testGetByIdsSuccess()
    {
        $transfer = new \FondOfPHP\ActiveCampaign\DataTransferObject\MailingList();

        $list = [
            clone($transfer)
                ->setId(20)
                ->setName('SAMPLE #20'),
            clone($transfer)
                ->setId(21)
                ->setName('SAMPLE #21'),
        ];

        $this->mockHttpClient->expects($this->once())
            ->method('request')
            ->willReturn(new ResponseDummy());

        $this->mochSerializerBuilder
            ->expects($this->once())
            ->method('deserialize')
            ->with()
            ->willReturn($list);

        $mailingLists = $this->mailingListService->getByIds(array(20, 21));

        $this->assertEquals(2, count($mailingLists));
        $this->assertEquals(20, $mailingLists[0]->getId());
        $this->assertEquals(21, $mailingLists[1]->getId());
    }

    public function testGetByIdsInvalidResponse()
    {
        $this->mockHttpClient->expects($this->once())
            ->method('request')
            ->willReturn(new ResponseDummy(false));

        $mailingLists = $this->mailingListService->getByIds(array(20, 21));

        $this->assertNull($mailingLists);
    }
}
