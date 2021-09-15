# # INObject

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**in_class** | **string** | The classification of the recognized object. | [optional] 
**in_group** | **string** | The group of the classification. | [optional] 
**in_id** | **string** | The group of the classification. | [optional] 
**color** | **string** | The color of the object, e.g. the color of the hair. Is only available for certain classification objects. See list below:  * _hair_ - black, brown, blonde, grey, red, other | [optional] 
**style** | **string** | The style attribute of the object, e.g. the style of the hair. Is only available for certain classification objects. See list below:  * _hair_ - longHaired, shortHaired | [optional] 
**x0** | **float** | The starting point of the rectangle in the vertical (x) direction. | [optional] 
**y0** | **float** | The starting point of the rectangle in the horizontal (y) direction. | [optional] 
**width** | **float** | The distance from the starting point (y0) to end the rectangle in the horizontal direction. | [optional] 
**height** | **float** | The distance from the starting point (x0) to end the rectangle in the vertical direction. | [optional] 
**probability** | **int** | The probability that the object found matches the classification. | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)


