<?php
declare(strict_types=1);

namespace SmartEmailing;

use GuzzleHttp\Client;
use JetBrains\PhpStorm\Pure;
use SmartEmailing\Api\Automation;
use SmartEmailing\Api\ContactLists;
use SmartEmailing\Api\Contacts;
use SmartEmailing\Api\CustomCampaigns;
use SmartEmailing\Api\CustomFieldOptions;
use SmartEmailing\Api\CustomFields;
use SmartEmailing\Api\Emails;
use SmartEmailing\Api\Eshops;
use SmartEmailing\Api\Import;
use SmartEmailing\Api\Newsletter;
use SmartEmailing\Api\ProcessingPurposes;
use SmartEmailing\Api\Scoring;
use SmartEmailing\Api\Stats;
use SmartEmailing\Api\Tests;
use SmartEmailing\Api\TransactionalEmails;
use SmartEmailing\Api\WebForms;
use SmartEmailing\Api\Webhooks;

class SmartEmailing
{
    private const BASE_URL = 'https://app.smartemailing.cz';
    private const USER_AGENT = 'sm-php-api-client/1.0.0';
    private const DOCUMENT_TYPE = 'application/json';

    protected string $baseUrl = self::BASE_URL;

    protected Client $client;

    protected static SmartEmailing $instance;

    public function __construct(string $username, string $apiKey, string $baseUrl = null)
    {
        $this->client = new Client(
            [
                'auth' => [$username, $apiKey],
                'base_uri' => $baseUrl ?? $this->baseUrl,
                'headers' => [
                    'Accept' => self::DOCUMENT_TYPE,
                    'User-Agent' => self::USER_AGENT
                ]
            ]
        );
    }

    #[Pure]
    public function automation(): Automation
    {
        return new Automation($this);
    }

    #[Pure]
    public function contactLists(): ContactLists
    {
        return new ContactLists($this);
    }

    #[Pure]
    public function contacts(): Contacts
    {
        return new Contacts($this);
    }

    #[Pure]
    public function customCampaigns(): CustomCampaigns
    {
        return new CustomCampaigns($this);
    }

    #[Pure]
    public function customFieldOptions(): CustomFieldOptions
    {
        return new CustomFieldOptions($this);
    }

    #[Pure]
    public function customFields(): CustomFields
    {
        return new CustomFields($this);
    }

    #[Pure]
    public function emails(): Emails
    {
        return new Emails($this);
    }

    #[Pure]
    public function eshops(): Eshops
    {
        return new Eshops($this);
    }

    #[Pure]
    public function import(): Import
    {
        return new Import($this);
    }

    #[Pure]
    public function newsletter(): Newsletter
    {
        return new Newsletter($this);
    }

    #[Pure]
    public function processingPurposes(): ProcessingPurposes
    {
        return new ProcessingPurposes($this);
    }

    #[Pure]
    public function scoring(): Scoring
    {
        return new Scoring($this);
    }

    #[Pure]
    public function stats(): Stats
    {
        return new Stats($this);
    }

    #[Pure]
    public function tests(): Tests
    {
        return new Tests($this);
    }

    #[Pure]
    public function transactionalEmails(): TransactionalEmails
    {
        return new TransactionalEmails($this);
    }

    #[Pure]
    public function webForms(): WebForms
    {
        return new WebForms($this);
    }

    #[Pure]
    public function webhooks(): Webhooks
    {
        return new Webhooks($this);
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    protected function getBaseUrl(): string
    {
        return $this->baseUrl;
    }
}
