<?php
/**
 * @package IrisnetAPIClient
 */

use Inc\IrisnetAPIConnector;
use \Irisnet\APIV2\Client\Model\CheckResult;

/**
 * AI wrapper class.
 */
class AI
{
    
    /**
     * Makes the API call to check the image for the specified rules.
     *
     * @param string $file the name (including path) of the image or url of an image that needs to be checked. 
     * @param string $rule the given name of the rule set.
     * @param integer $detail Sets the response details. Use 1 (default) for minimum detail (better API performance), 2 for medium details and 3 for all details.
     * @param integer $licenseId the id of the license key to use. Omit if the next available license key should be used.
     * @throws IrisnetException is thrown in case that the rule name could not be found, if the license id does not exist, 
     * if the license key is not active or out of credits, if the specified filename does not exist 
     * or if the API request fails (will contain the status code and the message returned from the failed API request).
     * @return CheckResult Contains information on the AI result from the source media check. See <a href="https://www.irisnet.de/api/">API page</a> for more information
     */
    public static function checkImage(string $file, string $rule, int $detail = 1, int $licenseId = null) : CheckResult
    {
        return IrisnetAPIConnector::checkImage($file, $rule, $detail, $licenseId);
    }
}
