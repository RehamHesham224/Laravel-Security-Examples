## Laravel Security Tips


### Deploy App & App Environment
- Remember to set the **APP_ENV=production** and **APP_DEBUG=false** in .env file 
- If it's set to **APP_ENV=local** and **APP_DEBUG=true**
  - Errors will appear to user 
  - then he can make a source dive in your project
  - and get cookie of user and login to your application
  - if you have packages like telescope it will be accessible to all users
![img.png](img.png)


### Missing Authorization

- we must protect route as well as view
  - so we must use Gate or Policy

- Gate: is defined in AuthServiceProvider boot method 
![img_4.png](img_4.png)

- Policy: is a separate file connected to controller actions
![img_3.png](img_3.png)

- We use policy in controller method or controller construct or route
![img_5.png](img_5.png)
![img_6.png](img_6.png)
![img_7.png](img_7.png)


### Validation

Don't depend on request all properties , it may pass an additional field which not in a form but in a fillable prop
but, depend on validation method 
![img_8.png](img_8.png)

you can use general Rule in AuthServiceProvider boot method
![img_13.png](img_13.png)
![img_9.png](img_9.png)
this rule give you same conditions as above but one message
![img_10.png](img_10.png)
![img_11.png](img_11.png)


### SQL Injection (sqli)

you must prevent sql injection: which is attack your database query and modify it
![img_14.png](img_14.png)

by passing parameter to query not but a word in a query directly
or use where not whereRaw
![img_15.png](img_15.png)


### Escaping (cross site scripting)
 
- this vulnerability make attackers bass a payload in url and inject JS Code and modify pages
- to prevent it 
    - not to use {!! !!} field because it put the field value as user pass 
    - Instead of it use {{}} 
    - or when you want to but html code use new HtmlString(e($value)); for make html object and escape characters
  

### Markdown Security Concern (cross site scripting)

- this vulnerability make attackers bass a payload in url and inject JS Code and modify pages
- Attackers may pass js code for example on image methods in markdown 

![img_16.png](img_16.png)

- To prevent it
    - use escape parameter to convert html in markdown
    - or strip ro remove entire html
![img_18.png](img_18.png)
  

      
### Sensitive data

in API and SPA
use hidden property in Model class, to be not to send in api data
and use select method in query
or use resource class


### Rate Limitation

- It's limit requests in the same time to prevent from DOS attack,
which attackers use scripts to try random (email, password) many times
- To prevent it
  -  limit login attempts to number for example 5 for the same ip make this script take a long time
  -  We can use throttle:api middleware
  

### Type Juggling

- with "==" in php7 and below there is a vulnerable
![img_20.png](img_20.png)

### The Only Cryptography Secure Random Function
- don't use 
  - md5 of slug value because you can reverse it easily 
    - time() because you can know it from created_at prperty 
    - uniqid() because it's not secure
- but use rand() or random_int() instead (Str::random(40) in laravel)


### Deserialization Attack and solution

don't use serilize
