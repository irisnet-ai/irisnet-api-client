<?php
/**
 * BrokenRule
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  Irisnet\APIV2\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Irisnet API
 *
 * Artificial Intelligence (AI) for image- and video-processing in real-time. This is an interactive documentation where you can quickly look up the endpoints and their schemas, while having the opportunity to try things out for yourself.  In the list below, you can see the available endpoints of the API, which can be expanded by clicking on them. Each expanded endpoint lists the request parameters (if available) and the request body (if available). The request body can list some example bodies and the schema, explaining each model in detail.  Additionally you'll find a 'Try it out' button that allows you to enter your custom parameters and custom body and execute that against the API. <b>Be sure to enter your license key to authorize the requests before using this documentation interactively.</b>  The responses section in the expanded endpoint lists the possible responses with their corresponding status codes. If you've executed an API call it will also show you the response from the server.  Underneath the endpoints you'll find the model schemas. These are the models used for the requests and responses. If you click on the right arrow, you can expand the model and get a description of the model and the model parameters. For nested models, you can keep clicking the right arrow for further details.  Clicking the link below the title at the top of this page opens the [OpenAPI specification](https://swagger.io/specification/) (OAS3) in JSON format. The OAS3 Spec allows the generation of clients in many programming languages. There are several free client generators available that can be used to get started easily.
 *
 * The version of the OpenAPI document: v2
 * Contact: info@irisnet.de
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 7.0.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Irisnet\APIV2\Client\Model;

use \ArrayAccess;
use \Irisnet\APIV2\Client\ObjectSerializer;

/**
 * BrokenRule Class Doc Comment
 *
 * @category Class
 * @description Describes what and why a rule was broken according the the applied during the configuration.
 * @package  Irisnet\APIV2\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class BrokenRule implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'BrokenRule';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'classification' => 'string',
        'group' => 'string',
        'found' => 'int',
        'min' => 'int',
        'max' => 'int',
        'severity' => 'int',
        'duration' => 'float'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'classification' => null,
        'group' => null,
        'found' => 'int32',
        'min' => 'int32',
        'max' => 'int32',
        'severity' => 'int32',
        'duration' => 'float'
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'classification' => false,
		'group' => false,
		'found' => false,
		'min' => false,
		'max' => false,
		'severity' => false,
		'duration' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'classification' => 'classification',
        'group' => 'group',
        'found' => 'found',
        'min' => 'min',
        'max' => 'max',
        'severity' => 'severity',
        'duration' => 'duration'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'classification' => 'setClassification',
        'group' => 'setGroup',
        'found' => 'setFound',
        'min' => 'setMin',
        'max' => 'setMax',
        'severity' => 'setSeverity',
        'duration' => 'setDuration'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'classification' => 'getClassification',
        'group' => 'getGroup',
        'found' => 'getFound',
        'min' => 'getMin',
        'max' => 'getMax',
        'severity' => 'getSeverity',
        'duration' => 'getDuration'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('classification', $data ?? [], null);
        $this->setIfExists('group', $data ?? [], null);
        $this->setIfExists('found', $data ?? [], null);
        $this->setIfExists('min', $data ?? [], null);
        $this->setIfExists('max', $data ?? [], null);
        $this->setIfExists('severity', $data ?? [], null);
        $this->setIfExists('duration', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets classification
     *
     * @return string|null
     */
    public function getClassification()
    {
        return $this->container['classification'];
    }

    /**
     * Sets classification
     *
     * @param string|null $classification The classification of the recognized object.
     *
     * @return self
     */
    public function setClassification($classification)
    {
        if (is_null($classification)) {
            throw new \InvalidArgumentException('non-nullable classification cannot be null');
        }
        $this->container['classification'] = $classification;

        return $this;
    }

    /**
     * Gets group
     *
     * @return string|null
     */
    public function getGroup()
    {
        return $this->container['group'];
    }

    /**
     * Sets group
     *
     * @param string|null $group The group of the classification.
     *
     * @return self
     */
    public function setGroup($group)
    {
        if (is_null($group)) {
            throw new \InvalidArgumentException('non-nullable group cannot be null');
        }
        $this->container['group'] = $group;

        return $this;
    }

    /**
     * Gets found
     *
     * @return int|null
     */
    public function getFound()
    {
        return $this->container['found'];
    }

    /**
     * Sets found
     *
     * @param int|null $found The count of how many instances of the classification object were found.
     *
     * @return self
     */
    public function setFound($found)
    {
        if (is_null($found)) {
            throw new \InvalidArgumentException('non-nullable found cannot be null');
        }
        $this->container['found'] = $found;

        return $this;
    }

    /**
     * Gets min
     *
     * @return int|null
     */
    public function getMin()
    {
        return $this->container['min'];
    }

    /**
     * Sets min
     *
     * @param int|null $min The minimum allowed instances of the classification object.
     *
     * @return self
     */
    public function setMin($min)
    {
        if (is_null($min)) {
            throw new \InvalidArgumentException('non-nullable min cannot be null');
        }
        $this->container['min'] = $min;

        return $this;
    }

    /**
     * Gets max
     *
     * @return int|null
     */
    public function getMax()
    {
        return $this->container['max'];
    }

    /**
     * Sets max
     *
     * @param int|null $max The maximum allowed instances of the classification object.
     *
     * @return self
     */
    public function setMax($max)
    {
        if (is_null($max)) {
            throw new \InvalidArgumentException('non-nullable max cannot be null');
        }
        $this->container['max'] = $max;

        return $this;
    }

    /**
     * Gets severity
     *
     * @return int|null
     */
    public function getSeverity()
    {
        return $this->container['severity'];
    }

    /**
     * Sets severity
     *
     * @param int|null $severity The severity of the classification object set while configuring the AI.
     *
     * @return self
     */
    public function setSeverity($severity)
    {
        if (is_null($severity)) {
            throw new \InvalidArgumentException('non-nullable severity cannot be null');
        }
        $this->container['severity'] = $severity;

        return $this;
    }

    /**
     * Gets duration
     *
     * @return float|null
     */
    public function getDuration()
    {
        return $this->container['duration'];
    }

    /**
     * Sets duration
     *
     * @param float|null $duration The overall duration of the found classification. Not available for still images.
     *
     * @return self
     */
    public function setDuration($duration)
    {
        if (is_null($duration)) {
            throw new \InvalidArgumentException('non-nullable duration cannot be null');
        }
        $this->container['duration'] = $duration;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}

