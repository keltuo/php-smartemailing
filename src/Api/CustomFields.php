<?php
declare(strict_types=1);

namespace SmartEmailing\Api;

use SmartEmailing\Api\Model\CustomField;
use SmartEmailing\Api\Model\Response\BaseResponse as Response;
use SmartEmailing\Api\Model\Search\ContactCustomFields as SearchContactCustomFields;
use SmartEmailing\Api\Model\Search\CustomFields as SearchCustomField;
use SmartEmailing\Api\Model\Search\SingleCustomFields as SearchSingleCustomField;

/**
 * @see     https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfields
 * @package SmartEmailing\Api
 */
class CustomFields extends AbstractApi
{
    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfields-Create_new_Customfield
     */
    public function create(CustomField $customField): Response
    {
        return new Response($this->post('customfields', $customField->toArray()));
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfields-Delete_Customfield
     */
    public function remove(int $idCustomField): Response
    {
        return new Response(
            $this->delete(
                $this->replaceUrlParameters(
                    'customfields/:id',
                    [
                    'id' => $idCustomField
                    ]
                )
            )
        );
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfields-Get_Customfield_values
     */
    public function getContactCustomFields(SearchContactCustomFields $search = null): Response
    {
        $search = $search ?? new SearchContactCustomFields();
        return new Response($this->get('contact-customfields', $search->getAsQuery()));
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfields-Get_Customfields
     */
    public function getList(SearchCustomField $search = null): Response
    {
        $search = $search ?? new SearchCustomField();
        return new Response($this->get('customfields', $search->getAsQuery()));
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfields-Get_single_Customfield
     */
    public function getSingle(int $idCustomField, SearchSingleCustomField $search = null): Response
    {
        $search = $search ?? new SearchSingleCustomField();
        return new Response(
            $this->get(
                $this->replaceUrlParameters(
                    'customfields/:id',
                    [
                    'id' => $idCustomField
                    ]
                ),
                $search->getAsQuery()
            )
        );
    }
}
