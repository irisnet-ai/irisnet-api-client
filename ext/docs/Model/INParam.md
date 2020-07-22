# # INParam

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**in_class** | **string** | The classification of the object, that the element refers to. Default parameter values are defined per classification object. The following list contains the default values for &#39;min&#39;, &#39;max&#39; and &#39;drawMode&#39; in order. * _face_ _(0, 3, 0)_ - Classification for human faces. * _child_ _(0, 0, 1)_ - Recognizes children&#39;s faces. Overwrites classification parameters of face. * _adult_ _(0, -1, 1)_ - Recognizes faces of adults that are not considered seniors. Overwrites classification parameters of face. * _senior_ _(0, -1, 1)_ - Recognizes faces of seniors. Overwrites classification parameters of face. * _hand_ _(0, -1, 0)_ - Classification for recognizing hands. * _breast_ _(0, 0, 2)_ - Object that recognizes female breasts. * _vulva_ _(0, 0, 2)_ - Object that recognizes vulvae. * _penis_ _(0, 0, 2)_ - Object that recognizes penises. * _vagina_ _(0, 0, 2)_ - Object that recognizes vaginae. * _buttocks_ _(0, 0, 2)_ - Object that recognizes buttocks. * _anus_ _(0, 0, 2)_ - Object that recognizes ani. * _illegalSymbols_ _(0, 0, 1)_ - Classification for symbols that are not permitted in Germany. | [optional] 
**min** | **int** | The minimum amount of objects allowed on the source media. Setting the value to -1 will cause the AI to ignore this rule. | [optional] 
**max** | **int** | The maximum amount of objects allowed on the source media. Setting the value to -1 will cause the AI to ignore this rule. | [optional] 
**draw_mode** | **int** | The draw mode that will be used for the output media. &#39;0&#39; will draw nothing, &#39;1&#39; will draw a frame with class name surrounding the object, &#39;2&#39; will draw a filled rectangle that will mask the object and &#39;3&#39; will blur the object. | [optional] 
**grey** | **int** | A grey scale color to use for frame or masking. &#39;0&#39; will represent black, while the maximum &#39;255&#39; will be white. | [optional] [default to 127]

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)


