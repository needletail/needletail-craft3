<?php

namespace needletail\needletail\models;

use craft\base\Model;
use needletail\needletail\base\ElementInterface;
use needletail\needletail\Needletail;

/**
 * Class BucketModel
 * @package needletail\needletail\models
 * @property ElementInterface $element
 */
class BucketModel extends Model
{
    // Properties
    // =========================================================================

    public $id;
    public $name;
    public $handle;
    public $elementType;
    public $elementData;
    public $fieldMapping;
    public $siteId;
    public $dateCreated;
    public $dateUpdated;
    public $uid;

    // Public Methods
    // =========================================================================

    public function __toString()
    {
        return Craft::t('needletail', $this->name);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'handle'], 'required'],
            [['handle'], 'unique']
        ];
    }

    /**
     * @return ElementInterface
     */
    public function getElement()
    {
        $element = Needletail::$plugin->elements->getRegisteredElement($this->elementType);

        if ($element) {
            $element->bucket = $this;
        }

        return $element;
    }
}