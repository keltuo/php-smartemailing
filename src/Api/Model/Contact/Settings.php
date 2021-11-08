<?php
declare(strict_types=1);

namespace SmartEmailing\Api\Model\Contact;

use JetBrains\PhpStorm\ArrayShape;
use SmartEmailing\Api\Model\AbstractModel;

class Settings extends AbstractModel
{
    /**
     * Existing contact's defaultfields and customfields (including nameday, gender and salution) will be updated ONLY
     * if this is set to true. If false is provided, only contactlist statuses will be updated. Nothing else.
     */
    protected bool $update = true;
    /**
     * If name is provided in Contact data section, automatically generate nameday defaultfield and overwrite existing
     * value if any.
     */
    protected bool  $addNameDays = true;
    /**
     * If name is provided in Contact data section, automatically generate gender defaultfield and overwrite existing
     * value if any.
     */
    protected bool  $addGenders = true;
    /**
     * If name is provided in Contact data section, automatically generate salution defaultfield and overwrite existing
     * value if any.
     */
    protected bool  $addSalutations = true;
    /**
     * If this flag is set to true, all contacts that are unsubscribed in some lists will stay unsubscribed regardless
     * of imported statuses. This is very useful when Import should respect unsubscriptions from previous campaigns and
     * we strongly recommend to keep this turned on.
     */
    protected bool  $preserveUnSubscribed = true;
    /**
     * If this flag is set to true, all contacts with invalid e-mail addresses will be silently skipped and your Import
     * will finish without them. Otherwise it will be terminated with 422 Error.
     */
    protected bool $skipInvalidEmails = false;
    /**
     * If this section is present, opt-in e-mail will be sent to imported contacts based on following settings,
     * excluding blacklisted (sending opt-in e-amil to blacklisted contacts can be forced
     * by setting preserve_unsubscribed=false).
     * Imported data will be written when they click through confirmation link.
     */
    protected ?DoubleOptInSettings $doubleOptInSettings;

    /**
     * @param bool                     $update
     * @param bool                     $addNameDays
     * @param bool                     $addGenders
     * @param bool                     $addSalutations
     * @param bool                     $preserveUnSubscribed
     * @param bool                     $skipInvalidEmails
     * @param DoubleOptInSettings|null $doubleOptInSettings
     */
    public function __construct(
        bool $update = true,
        bool $addNameDays = true,
        bool $addGenders = true,
        bool $addSalutations = true,
        bool $preserveUnSubscribed = true,
        bool $skipInvalidEmails = false,
        ?DoubleOptInSettings $doubleOptInSettings = null
    ) {
        $this->setUpdate($update);
        $this->setAddNameDays($addNameDays);
        $this->setAddGenders($addGenders);
        $this->setAddSalutations($addSalutations);
        $this->setPreserveUnSubscribed($preserveUnSubscribed);
        $this->setSkipInvalidEmails($skipInvalidEmails);
        $this->setDoubleOptInSettings($doubleOptInSettings);
    }

    public function isUpdate(): bool
    {
        return $this->update;
    }

    public function setUpdate(bool $update): Settings
    {
        $this->update = $update;
        return $this;
    }

    public function isAddNameDays(): bool
    {
        return $this->addNameDays;
    }

    public function setAddNameDays(bool $addNameDays): Settings
    {
        $this->addNameDays = $addNameDays;
        return $this;
    }

    public function isAddGenders(): bool
    {
        return $this->addGenders;
    }

    public function setAddGenders(bool $addGenders): Settings
    {
        $this->addGenders = $addGenders;
        return $this;
    }

    public function isAddSalutations(): bool
    {
        return $this->addSalutations;
    }

    public function setAddSalutations(bool $addSalutations): Settings
    {
        $this->addSalutations = $addSalutations;
        return $this;
    }

    public function isPreserveUnSubscribed(): bool
    {
        return $this->preserveUnSubscribed;
    }

    public function setPreserveUnSubscribed(bool $preserveUnSubscribed): Settings
    {
        $this->preserveUnSubscribed = $preserveUnSubscribed;
        return $this;
    }

    public function isSkipInvalidEmails(): bool
    {
        return $this->skipInvalidEmails;
    }

    public function setSkipInvalidEmails(bool $skipInvalidEmails): Settings
    {
        $this->skipInvalidEmails = $skipInvalidEmails;
        return $this;
    }

    public function getDoubleOptInSettings(): ?DoubleOptInSettings
    {
        return $this->doubleOptInSettings;
    }

    public function setDoubleOptInSettings(?DoubleOptInSettings $doubleOptInSettings): Settings
    {
        $this->doubleOptInSettings = $doubleOptInSettings;
        return $this;
    }


    #[ArrayShape(
        [
        'update' => "bool",
        'add_namedays' => "bool",
        'add_genders' => "bool",
        'add_salutions' => "bool",
        'preserve_unsubscribed' => "bool",
        'skip_invalid_emails' => "bool",
        'double_opt_in_settings' => "null|\SmartEmailing\Api\Model\Contact\DoubleOptInSettings"
        ]
    )]
    public function toArray(): array
    {
        return array_filter(
            [
            'update' => $this->isUpdate(),
            'add_namedays' => $this->isAddNameDays(),
            'add_genders' => $this->isAddGenders(),
            'add_salutions' => $this->isAddSalutations(),
            'preserve_unsubscribed' => $this->isPreserveUnSubscribed(),
            'skip_invalid_emails' => $this->isSkipInvalidEmails(),
            'double_opt_in_settings' => $this->getDoubleOptInSettings()
            ], fn ($item) => !is_null($item)
        );
    }
}
