<?php
declare(strict_types=1);

namespace SmartEmailing\Api;


use SmartEmailing\Api\Model\Response\BaseResponse as Response;

/**
 * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Web_Forms
 * @package SmartEmailing\Api
 */
class WebForms extends AbstractApi
{
    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Web_Forms-Get_all_Web_Form_ids_and_names
     */
    public function getList(): Response
    {
        return new Response($this->get('web-forms'));
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Web_Forms-Get_single_Web_Form_structure
     */
    public function getSingle(int $idWebForm): Response
    {
        return new Response($this->get(
            $this->replaceUrlParameters(
                'web-form-structure/:id',
                [
                    'id' => $idWebForm
                ]
            )
        ));
    }
}
