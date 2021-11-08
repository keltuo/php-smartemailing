<?php
declare(strict_types=1);

namespace SmartEmailing\Api;


use SmartEmailing\Api\Model\Response\BaseResponse as Response;

/**
 * @see     https://app.smartemailing.cz/docs/api/v3/index.html#api-Scoring
 * @package SmartEmailing\Api
 */
class Scoring extends AbstractApi
{
    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Scoring-Scoring_result_history
     */
    public function resultHistory(array $filter = []): Response
    {
        return new Response($this->get('scoring-result-changes', $filter));
    }
}
