<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Contact;

use JetBrains\PhpStorm\Pure;
use SmartEmailing\Api\Model\AbstractModel;
use SmartEmailing\Api\Model\Bag\AbstractBag;
use SmartEmailing\Api\Model\Bag\ContactListBag;
use SmartEmailing\Api\Model\Bag\CustomFieldBag;
use SmartEmailing\Api\Model\Bag\PurposeBag;
use SmartEmailing\Api\Model\ModelInterface;
use SmartEmailing\Exception\AllowedTypeException;
use SmartEmailing\Util\Helpers;

class Contact extends AbstractModel implements ModelInterface
{
    /**
     * E-mail address of imported contact. This is the only required field.
     */
    protected string $emailAddress;
    /**
     * First name
     */
    protected ?string $name = null;

    protected ?string $surname = null;
    /**
     * Titles before name
     */
    protected ?string  $titlesBefore = null;
    /**
     * Titles after name
     */
    protected ?string  $titlesAfter = null;

    protected ?string  $salutation = null;

    protected ?string  $company = null;

    protected ?string  $street = null;

    protected ?string  $town = null;

    protected ?string  $postalCode = null;

    protected ?string  $country = null;

    protected ?string  $cellphone = null;

    protected ?string  $phone = null;

    protected ?string  $language = null;
    /**
     * Custom notes
     */
    protected ?string  $notes = null;
    /**
     * Allowed values: "M,F,NULL"
     */
    protected ?string  $gender = null;
    /**
     * 0 if Contact is OK, 1 if Contact does not want to receive any of your e-mails anymore. This flag will stop
     * further campaigns. Be careful, setting this value to 1 will also un-subscribe contact from all lists. It is
     * recommended not to send this parameter at all if you do not know what you are doing.
     */
    protected ?int $blacklisted = null;
    /**
     * Date of Contact's nameday in YYYY-MM-DD 00:00:00 format
     */
    protected ?string  $nameDay = null;
    /**
     * Date of Contact's birthday in YYYY-MM-DD 00:00:00 format
     */
    protected ?string  $birthday = null;
    /**
     * Contact lists presence of imported contacts. Any contact list presence unlisted in imported data will be
     * untouched. Unsubscribed contacts will stay unsubscribed if settings.preserve_unsubscribed=1
     */
    protected ContactListBag  $contactListBag;
    /**
     * Custom fields belonging to contact Custom fields unlisted in imported data will be untouched.
     */
    protected CustomFieldBag $customFieldBag;
    /**
     * Processing purposes assigned to contact.
     * Every purpose may be assigned multiple times for different time intervals.
     * Exact duplicities will be silently skipped.
     */
    protected PurposeBag $purposeBag;

    /**
     * @param string $emailAddress
     */
    public function __construct(string $emailAddress)
    {
        $this->setEmailAddress($emailAddress);
        $this->setContactListBag(new ContactListBag());
        $this->setCustomFieldBag(new CustomFieldBag());
        $this->setPurposeBag(new PurposeBag());
    }

    #[Pure] public function getIdentifier(): string
    {
        return $this->getEmailAddress();
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function getTitlesBefore(): ?string
    {
        return $this->titlesBefore;
    }

    public function getTitlesAfter(): ?string
    {
        return $this->titlesAfter;
    }

    public function getSalutation(): ?string
    {
        return $this->salutation;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getCellphone(): ?string
    {
        return $this->cellphone;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function getBlacklisted(): ?int
    {
        return $this->blacklisted;
    }

    public function getNameDay(): ?string
    {
        return $this->nameDay;
    }

    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    public function getContactListBag(): ContactListBag
    {
        return $this->contactListBag;
    }

    public function getCustomFieldBag(): CustomFieldBag
    {
        return $this->customFieldBag;
    }

    public function getPurposeBag(): PurposeBag
    {
        return $this->purposeBag;
    }

    public function setEmailAddress(string $emailAddress): Contact
    {
        Helpers::validateEmail($emailAddress);
        $this->emailAddress = $emailAddress;
        return $this;
    }

    public function setName(?string $name): Contact
    {
        $this->name = $name;
        return $this;
    }

    public function setSurname(?string $surname): Contact
    {
        $this->surname = $surname;
        return $this;
    }

    public function setTitlesBefore(?string $titlesBefore): Contact
    {
        $this->titlesBefore = $titlesBefore;
        return $this;
    }

    public function setTitlesAfter(?string $titlesAfter): Contact
    {
        $this->titlesAfter = $titlesAfter;
        return $this;
    }

    public function setSalutation(?string $salutation): Contact
    {
        $this->salutation = $salutation;
        return $this;
    }

    public function setCompany(?string $company): Contact
    {
        $this->company = $company;
        return $this;
    }

    public function setStreet(?string $street): Contact
    {
        $this->street = $street;
        return $this;
    }

    public function setTown(?string $town): Contact
    {
        $this->town = $town;
        return $this;
    }

    public function setPostalCode(?string $postalCode): Contact
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function setCountry(?string $country): Contact
    {
        $this->country = $country;
        return $this;
    }

    public function setCellphone(?string $cellphone): Contact
    {
        $this->cellphone = $cellphone;
        return $this;
    }


    public function setPhone(?string $phone): Contact
    {
        $this->phone = $phone;
        return $this;
    }

    public function setLanguage(?string $language): Contact
    {
        $this->language = $language;
        return $this;
    }


    public function setNotes(?string $notes): Contact
    {
        $this->notes = $notes;
        return $this;
    }

    public function setContactListBag(ContactListBag $contactListBag): Contact
    {
        $this->contactListBag = $contactListBag;
        return $this;
    }

    public function setCustomFieldBag(CustomFieldBag $customFieldBag): Contact
    {
        $this->customFieldBag = $customFieldBag;
        return $this;
    }

    public function setPurposeBag(PurposeBag $purposeBag): Contact
    {
        $this->purposeBag = $purposeBag;
        return $this;
    }

    public function setGender(string $gender): Contact
    {
        AllowedTypeException::check(
            $gender, [
            'M', 'F', null
            ]
        );

        $this->gender = $gender;
        return $this;
    }

    /**
     * 0 (false) if Contact is OK, 1 (true) if Contact does not want to receive any of your e-mails anymore. This flag
     * will stop further campaigns. Be careful, setting this value to 1 will also un-subscribe contact from all lists.
     * It is recommended not to send this parameter at all if you do not know what you are doing.
     */
    public function setBlacklisted(bool $blacklisted = true): Contact
    {
        $this->blacklisted = intval($blacklisted);
        return $this;
    }

    /**
     * Date of Contact's birthday in YYYY-MM-DD 00:00:00 or different format
     */
    public function setNameDay(string $nameDay): Contact
    {
        $this->nameDay = Helpers::formatDate($nameDay);
        return $this;
    }

    /**
     * Date of Contact's birthday in YYYY-MM-DD 00:00:00 format  or different format
     */
    public function setBirthday(string $birthday): Contact
    {
        $this->birthday = Helpers::formatDate($birthday);
        return $this;
    }

    public function toArray(): array
    {
        return array_filter(
            [
            'emailaddress' => $this->getEmailAddress(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'titlesbefore' => $this->getTitlesBefore(),
            'titlesafter' => $this->getTitlesAfter(),
            'salution' => $this->getSalutation(),
            'company' => $this->getCompany(),
            'street' => $this->getStreet(),
            'town' => $this->getTown(),
            'postalcode' => $this->getPostalCode(),
            'country' => $this->getCountry(),
            'cellphone' => $this->getCellphone(),
            'phone' => $this->getPhone(),
            'language' => $this->getLanguage(),
            'notes' => $this->getNotes(),
            'gender' => $this->getGender(),
            'blacklisted' => $this->getBlacklisted(),
            'nameday' => $this->getNameDay(),
            'birthday' => $this->getBirthday(),
            'contactlists' => $this->getContactListBag(),
            'customfields' => $this->getCustomFieldBag(),
            'purposes' => $this->getPurposeBag()
            ], fn ($item) => (
            (!is_object($item) && !empty($item))
            || (is_object($item) && is_a($item, AbstractBag::class) && !$item->isEmpty())
            )
        );
    }
}
