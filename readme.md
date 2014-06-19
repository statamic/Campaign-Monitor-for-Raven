# Campaign Monitor for Raven
This add-on will allow you to add subscribers to your Campaign Monitor list when using a Raven form.

## Usage

Enter your API Key and List ID into the config file.

Add a subscription trigger field to your raven form. Be sure to add it to the allowed fields in Raven's config.  
This addon will monitor your Raven submissions for the trigger field and try to subscribe your user if the appropriate value is set.

By default, the trigger field is `subscribe` and the value is `yes`.   
You can change it in your config file using `trigger_field` and `trigger_value` respectively.

Campaign Monitor requires an email and name field.  
By default these are `email` and `name`. You can change them with `email_field` and `name_field` respectively.