# # Summary

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**status** | **string** | A simple status string that can be either _accept_ or _reject_. | [optional]
**broken_rules_count** | **int** | The amount of broken rules that are contained in the source media. | [optional]
**help_suggested** | **int** | In cases where the AI is uncertain, this attribute is set (1), indication that it could be useful to double check the source media by a human. | [optional]
**severity** | **int** | The highest severity value found amongst the broken rules. | [optional]
**credits_consumed** | **int** | The amount of credits that was consumed for the check. | [optional]
**tags** | **string[]** | A list of classification names that were found. | [optional]
**reject_tags** | **string[]** | A list of classification names that caused a rule to be broken. | [optional]
**reject_reasons** | **string[]** | The names of the classification groups that caused a rule to be broken. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
