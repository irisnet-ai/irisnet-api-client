# # INObject

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**in_class** | **string** | The classification of the object, that the element refers to. Default parameter values are defined per classification object. The following list contains the default values for &#39;min&#39;, &#39;max&#39; and &#39;drawMode&#39; in order. * _face_ _(-1, -1, 0)_ - Classification for human faces. * _child_ _(-1, -1, 0)_ - Recognizes children&#39;s faces. Overwrites classification parameters of face. * _adult_ _(-1, -1, 0)_ - Recognizes faces of adults that are not considered seniors. Overwrites classification parameters of face. * _senior_ _(-1, -1, 0)_ - Recognizes faces of seniors. Overwrites classification parameters of face. * _hand_ _(-1, -1, 0)_ - Classification for recognizing hands. * _breast_ _(0, 0, 2)_ - Object that recognizes female breasts. * _vulva_ _(0, 0, 2)_ - Object that recognizes vulvae. * _penis_ _(0, 0, 2)_ - Object that recognizes penises. * _vagina_ _(0, 0, 2)_ - Object that recognizes vaginae. * _buttocks_ _(0, 0, 2)_ - Object that recognizes buttocks. * _anus_ _(0, 0, 2)_ - Object that recognizes ani. * _illegalSymbols_ _(0, 0, 1)_ - Classification for symbols that are not permitted in Germany. | [optional] 
**y0** | **float** | The starting point of the rectangle in the horizontal (y) direction. | [optional] 
**x0** | **float** | The starting point of the rectangle in the vertical (x) direction. | [optional] 
**width** | **float** | The distance from the starting point (y0) to end the rectangle in the horizontal direction. | [optional] 
**height** | **float** | The distance from the starting point (x0) to end the rectangle in the vertical direction. | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)


