<?php
/**
 * IrisNet
 *
 * PHP version 5
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Irisnet API
 *
 * Artificial Intelligence (AI) for image- and video-processing in realtime. This is an interactive documentation meant to give a place were you can quickly look up the endpoints and their schemas, while also giving you the option to try things out yourself.  Listed below you'll see the available endpoints of the API that can be expanded by clicking on it. Each expanded endpoint lists the request parameter (if available) and the request body (if available). The request body can list some example bodies and the schema, explaining each model in detail. Additionally you'll find a 'Try it out' button where you can type in your custom parameters and custom body and execute that against the API. The responses section in the expanded endpoint lists the possible responses with their corresponding status codes. If you've executed an API call it will also show you the response from the server.  Underneath the endpoints you'll find the model schemas. These are the models used for the requests and responses.By clicking on the right arrow you can expand the model and it will show you a description of the model and the model parameters. For nested models you can keep clicking the right arrow to reveal further details on it.
 *
 * The version of the OpenAPI document: v1
 * 
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 4.3.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * IrisNet Class Doc Comment
 *
 * @category Class
 * @description Contains information on the AI result from the source media check.
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class IrisNet implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'IrisNet';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'rules_broken' => 'int',
        'help_suggested' => 'int',
        'getn_classes' => 'int',
        'getn_objects' => 'int',
        'in_rule' => '\OpenAPI\Client\Model\INRule[]',
        'in_object' => '\OpenAPI\Client\Model\INObject[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'rules_broken' => 'int32',
        'help_suggested' => 'int32',
        'getn_classes' => 'int32',
        'getn_objects' => 'int32',
        'in_rule' => null,
        'in_object' => null
    ];

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
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'rules_broken' => 'rulesBroken',
        'help_suggested' => 'helpSuggested',
        'getn_classes' => 'getnClasses',
        'getn_objects' => 'getnObjects',
        'in_rule' => 'inRule',
        'in_object' => 'inObject'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'rules_broken' => 'setRulesBroken',
        'help_suggested' => 'setHelpSuggested',
        'getn_classes' => 'setGetnClasses',
        'getn_objects' => 'setGetnObjects',
        'in_rule' => 'setInRule',
        'in_object' => 'setInObject'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'rules_broken' => 'getRulesBroken',
        'help_suggested' => 'getHelpSuggested',
        'getn_classes' => 'getGetnClasses',
        'getn_objects' => 'getGetnObjects',
        'in_rule' => 'getInRule',
        'in_object' => 'getInObject'
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
        $this->container['rules_broken'] = isset($data['rules_broken']) ? $data['rules_broken'] : null;
        $this->container['help_suggested'] = isset($data['help_suggested']) ? $data['help_suggested'] : null;
        $this->container['getn_classes'] = isset($data['getn_classes']) ? $data['getn_classes'] : null;
        $this->container['getn_objects'] = isset($data['getn_objects']) ? $data['getn_objects'] : null;
        $this->container['in_rule'] = isset($data['in_rule']) ? $data['in_rule'] : null;
        $this->container['in_object'] = isset($data['in_object']) ? $data['in_object'] : null;
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
     * Gets rules_broken
     *
     * @return int|null
     */
    public function getRulesBroken()
    {
        return $this->container['rules_broken'];
    }

    /**
     * Sets rules_broken
     *
     * @param int|null $rules_broken The amount of broken rules that are contained in the source media.
     *
     * @return $this
     */
    public function setRulesBroken($rules_broken)
    {
        $this->container['rules_broken'] = $rules_broken;

        return $this;
    }

    /**
     * Gets help_suggested
     *
     * @return int|null
     */
    public function getHelpSuggested()
    {
        return $this->container['help_suggested'];
    }

    /**
     * Sets help_suggested
     *
     * @param int|null $help_suggested In cases where the AI is uncertain, this attribute is set (1), indication that it could be useful to double check the source media by a human.
     *
     * @return $this
     */
    public function setHelpSuggested($help_suggested)
    {
        $this->container['help_suggested'] = $help_suggested;

        return $this;
    }

    /**
     * Gets getn_classes
     *
     * @return int|null
     */
    public function getGetnClasses()
    {
        return $this->container['getn_classes'];
    }

    /**
     * Sets getn_classes
     *
     * @param int|null $getn_classes The amount of classification objects that were checked against on the source media. This does not mean that all of the classifications were found.
     *
     * @return $this
     */
    public function setGetnClasses($getn_classes)
    {
        $this->container['getn_classes'] = $getn_classes;

        return $this;
    }

    /**
     * Gets getn_objects
     *
     * @return int|null
     */
    public function getGetnObjects()
    {
        return $this->container['getn_objects'];
    }

    /**
     * Sets getn_objects
     *
     * @param int|null $getn_objects The amount of objects that were recognized on the source image.
     *
     * @return $this
     */
    public function setGetnObjects($getn_objects)
    {
        $this->container['getn_objects'] = $getn_objects;

        return $this;
    }

    /**
     * Gets in_rule
     *
     * @return \OpenAPI\Client\Model\INRule[]|null
     */
    public function getInRule()
    {
        return $this->container['in_rule'];
    }

    /**
     * Sets in_rule
     *
     * @param \OpenAPI\Client\Model\INRule[]|null $in_rule This list contains one rule per classification. Rules for classification objects that were not found, are omitted.
     *
     * @return $this
     */
    public function setInRule($in_rule)
    {
        $this->container['in_rule'] = $in_rule;

        return $this;
    }

    /**
     * Gets in_object
     *
     * @return \OpenAPI\Client\Model\INObject[]|null
     */
    public function getInObject()
    {
        return $this->container['in_object'];
    }

    /**
     * Sets in_object
     *
     * @param \OpenAPI\Client\Model\INObject[]|null $in_object A list of all instances of the classification objects found on the source image.
     *
     * @return $this
     */
    public function setInObject($in_object)
    {
        $this->container['in_object'] = $in_object;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
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
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
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


