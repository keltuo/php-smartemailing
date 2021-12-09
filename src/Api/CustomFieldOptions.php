<?php
declare(strict_types=1);

namespace SmartEmailing\Api;

use SmartEmailing\Api\Model\CustomFieldOption;
use SmartEmailing\Api\Model\Response\BaseResponse as Response;
use SmartEmailing\Api\Model\Search\CustomFieldOptions as SearchCustomFieldOptions;
use SmartEmailing\Api\Model\Search\SingleCustomFieldOptions as SearchSingleCustomFieldOptions;

/**
 * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfield_Options
 * @package SmartEmailing\Api
 */
class CustomFieldOptions extends AbstractApi
{
    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfield_Options-Create_new_Customfield_option
     */
    public function create(CustomFieldOption $customField): Response
    {
        return new Response($this->post('customfield-options', $customField->toArray()));
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfield_Options-Delete_Customfield_option
     */
    public function remove(int $idCustomFieldOption): Response
    {
        return new Response(
            $this->delete(
                $this->replaceUrlParameters(
                    'customfield-options/:id',
                    [
                    'id' => $idCustomFieldOption,
                    ]
                )
            )
        );
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfield_Options-Get_Customfield_options
     */
    public function getList(?SearchCustomFieldOptions $search = null): Response
    {
        $search ??= new SearchCustomFieldOptions();
        return new Response($this->get('customfield-options', $search->getAsQuery()));
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfield_Options-Get_single_Customfield_option
     */
    public function getSingle(int $idCustomFieldOption, ?SearchSingleCustomFieldOptions $search = null): Response
    {
        $search ??= new SearchSingleCustomFieldOptions();
        return new Response(
            $this->get(
                $this->replaceUrlParameters(
                    'customfield-options/:id',
                    [
                    'id' => $idCustomFieldOption,
                    ]
                ),
                $search->getAsQuery()
            )
        );
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Customfield_Options-Update_Customfield_option
     */
    public function update(int $idCustomFieldOption, CustomFieldOption $customFieldOption): Response
    {
        return new Response(
            $this->patch(
                $this->replaceUrlParameters(
                    'customfield-options/:id',
                    [
                    'id' => $idCustomFieldOption,
                    ]
                ),
                $customFieldOption->toArray()
            )
        );
    }
}
