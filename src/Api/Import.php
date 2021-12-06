<?php
declare(strict_types=1);

namespace SmartEmailing\Api;

use SmartEmailing\Api\Model\Bag\ContactBag;
use SmartEmailing\Api\Model\Import as ImportModel;
use SmartEmailing\Api\Model\Response\ImportResponse;

/**
 * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Import
 * @package SmartEmailing\Api
 */
class Import extends AbstractApi
{
    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Import-Import_contacts
     */
    public function contacts(ImportModel $import): ?ImportResponse
    {
        if (!$import->getContactBag()->isEmpty()) {
            $contacts = $import->getContactBag()->getItems();
            $lastResponse = null;

            foreach (\array_chunk($contacts, $this->chunkLimit) as $contacts) {
                $chunkContactBag = new ContactBag();
                $chunkContactBag->setItems($contacts);
                $chunkImport = new ImportModel($chunkContactBag, $import->getSettings());

                $lastResponse = new ImportResponse($this->post('import', $chunkImport->toArray()));
            }

            return $lastResponse;
        }

        return null;
    }
}
