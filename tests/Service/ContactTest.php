<?php

namespace FondOfPHP\ActiveCampaign\Service;

use FondOfPHP\ActiveCampaign\Transfer\ResponseDummy;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    /**
     * @var null|Contact
     */
    protected $contactService = null;

    /**
     * @var PHPUnit_Framework_MockObject_MockBuilder
     */
    protected $mockHttpClient;

    /**
     * @var PHPUnit_Framework_MockObject_MockBuilder
     */
    protected $mochSerializerBuilder;

    protected $email = 'email@address.com';

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

        $this->contactService = new Contact(
            $this->mockHttpClient,
            'SAMPLE_API_KEY',
            $this->mochSerializerBuilder
        );
    }

    public function testGetByEmailInvalidResponse()
    {
        $this->mockHttpClient->expects($this->once())
            ->method('request')
            ->willReturn(new ResponseDummy(false));

        $contact = $this->contactService->getByEmail($this->email);

        $this->assertNull($contact);
    }

    public function testGetByEmailSubscribe()
    {
        $contactTransfer = new \FondOfPHP\ActiveCampaign\DataTransferObject\Contact();
        $contactTransfer->setEmail($this->email);

        $this->mockHttpClient->expects($this->once())
            ->method('request')
            ->willReturn(new ResponseDummy());

        $this->mochSerializerBuilder
            ->expects($this->once())
            ->method('deserialize')
            ->with()
            ->willReturn($contactTransfer);

        $contact = $this->contactService->getByEmail($this->email);

        $this->assertInstanceOf(\FondOfPHP\ActiveCampaign\DataTransferObject\Contact::class, $contact);
        $this->assertEquals($contactTransfer->getEmail(), $contact->getEmail());
    }

    public function testUpdateEmptyData()
    {
        $contact = $this->contactService->update([]);

        $this->assertEquals(null, $contact);
    }

    public function testUpdateSubscriberInvalidData()
    {
        $contact = $this->contactService->update([
            'id' => 999,
            'email_unvalid' => $this->email
        ]);

        $this->assertNull($contact);
    }

    public function testUpdateNewSubscriber()
    {
        $contactTransfer = new \FondOfPHP\ActiveCampaign\DataTransferObject\Contact();
        $contactTransfer->setId(999);
        $contactTransfer->setEmail($this->email);

        $this->mockHttpClient->expects($this->once())
            ->method('request')
            ->willReturn(new ResponseDummy());

        $this->mochSerializerBuilder
            ->expects($this->once())
            ->method('deserialize')
            ->with()
            ->willReturn($contactTransfer);

        $contact = $this->contactService->update([
            'id' => $contactTransfer->getId(),
            'email' => $contactTransfer->getEmail()
        ]);

        $this->assertInstanceOf(\FondOfPHP\ActiveCampaign\DataTransferObject\Contact::class, $contact);
        $this->assertEquals($contactTransfer->getEmail(), $contact->getEmail());
    }

    public function testUpdateInvalidResponse()
    {
        $this->mockHttpClient->expects($this->once())
            ->method('request')
            ->willReturn(new ResponseDummy(false));

        $contact = $this->contactService->update([
            'id' => 999,
            'email' => $this->email
        ]);

        $this->assertNull($contact);
    }
}
