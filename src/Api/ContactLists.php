<?php
declare(strict_types=1);

namespace SmartEmailing\Api;

use SmartEmailing\Api\Model\ContactList;
use SmartEmailing\Api\Model\Search\ContactLists as ContactListSearch;
use SmartEmailing\Api\Model\NewContactList;
use SmartEmailing\Api\Model\Response\BaseResponse as Response;

/**
 * @see     https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists
 * @package SmartEmailing\Api
 */
class ContactLists extends AbstractApi
{
    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists-Count_added_contacts_in_list
     */
    public function getAddedContacts(int $idContactList): Response
    {
        return new Response(
            $this->get(
                $this->replaceUrlParameters(
                    'contactlists/:id/added-contacts',
                    [
                    'id' => $idContactList
                    ]
                )
            )
        );
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists-Create_new_Contactlist
     */
    public function create(NewContactList $contactList): Response
    {
        return new Response($this->post('contactlists', $contactList->toArray()));
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists-Count_contacts_in_list
     */
    public function getDistribution(int $idContactList): Response
    {
        return new Response(
            $this->get(
                $this->replaceUrlParameters(
                    'contactlists/:id/distribution',
                    [
                    'id' => $idContactList
                    ]
                )
            )
        );
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists-Get_Contactlists
     */
    public function getList(ContactListSearch $search = null): Response
    {
        $search = $search ?? new ContactListSearch();
        return new Response($this->get('contactlists', $search->getAsQuery()));
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists-Get_single_Contactlist
     */
    public function getSingle(int $idContactList, ContactListSearch $search = null): Response
    {
        $search = $search ?? new ContactListSearch();
        return new Response(
            $this->get(
                $this->replaceUrlParameters(
                    'contactlists/:id',
                    [
                    'id' => $idContactList
                    ]
                ),
                $search->getAsQuery()
            )
        );
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists-Truncate_Contactlist
     */
    public function truncate(int $idContactList): Response
    {
        return new Response(
            $this->post(
                $this->replaceUrlParameters(
                    'contactlists/:id/truncate',
                    [
                    'id' => $idContactList
                    ]
                )
            )
        );
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Contactlists-Update_Contactlist
     */
    public function update(int $idContactList, ContactList $contactList): Response
    {
        return new Response(
            $this->put(
                $this->replaceUrlParameters(
                    'contactlists/:id',
                    [
                    'id' => $idContactList
                    ]
                ), $contactList->toArray()
            )
        );
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Contacts_in_lists-Get_all_Contacts_in_list
     */
    public function getAllContacts(int $idContactList): Response
    {
        return new Response(
            $this->get(
                $this->replaceUrlParameters(
                    'contactlists/:id/contacts',
                    [
                    'id' => $idContactList
                    ]
                )
            )
        );
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Contacts_in_lists-Get_confirmed_Contacts_in_list
     */
    public function getAllConfirmedContacts(int $idContactList): Response
    {
        return new Response(
            $this->get(
                $this->replaceUrlParameters(
                    'contactlists/:id/contacts/confirmed',
                    [
                    'id' => $idContactList
                    ]
                )
            )
        );
    }

    /**
     * @see https://app.smartemailing.cz/docs/api/v3/index.html#api-Contacts_in_lists-Get_unsubscribed_Contacts_in_list__including_blacklisted
     */
    public function getAllUnsubscribedContacts(int $idContactList): Response
    {
        return new Response(
            $this->get(
                $this->replaceUrlParameters(
                    'contactlists/:id/contacts/unsubscribed',
                    [
                    'id' => $idContactList
                    ]
                )
            )
        );
    }
}
