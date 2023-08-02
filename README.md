## Laravel Security Tips


### Deploy App & App Environment
- Remember to set the **APP_ENV=production** and **APP_DEBUG=false** in .env file 
- If it's set to **APP_ENV=local** and **APP_DEBUG=true**
  - Errors will appear to user 
  - then he can make a source dive in your project
  - and get cookie of user and login to your application
  - if you have packages like telescope it will be accessible to all users
![img.png](images/img.png)


### Missing Authorization

- we must protect route as well as view
  - so we must use Gate or Policy

- Gate: is defined in AuthServiceProvider boot method 
![img_4.png](images/img_4.png)

- Policy: is a separate file connected to controller actions
![img_3.png](images/img_3.png)

- We use policy in controller method or controller construct or route
![img_5.png](images/img_5.png)
![img_6.png](images/img_6.png)
![img_7.png](images/img_7.png)


### Validation

Don't depend on request all properties , it may pass an additional field which not in a form but in a fillable prop
but, depend on validation method 
![img_8.png](images/img_8.png)



### SQL Injection (sqli)

you must prevent sql injection: which is attack your database query and modify it
![img_14.png](images/img_14.png)

by passing parameter to query not but a word in a query directly
or use where not whereRaw
![img_15.png](images/img_15.png)


### Escaping (Avoid cross site scripting)
 
- this vulnerability make attackers bass a payload in url and inject JS Code and modify pages
- to prevent it 
    - not to use {!! !!} field because it put the field value as user pass 
    - Instead of it use {{}} 
    - or when you want to but html code use new HtmlString(e($value)); for make html object and escape characters
![img_21.png](images/img_21.png) 

### Markdown Security Concern (Avoid cross site scripting)

- this vulnerability make attackers bass a payload in url and inject JS Code and modify pages
- Attackers may pass js code for example on image methods in markdown 

![img_16.png](images/img_16.png)
![img_22.png](images/img_22.png)

- To prevent it
    - use escape parameter to convert html in markdown
    - or strip ro remove entire html
![img_18.png](images/img_18.png)

      
### Sensitive data

in API and SPA
- use hidden property in Model class, to be not to send in api data
- and use select method in query
- or use resource class 
![img_23.png](images/img_23.png)
![img_24.png](images/img_24.png)

### Rate Limitation

- It's limit requests in the same time to prevent from DOS attack,
which attackers use scripts to try random (email, password) many times
- To prevent it
  -  limit login attempts to number for example 5 for the same ip make this script take a long time
  -  We can use throttle:api middleware
  

### Type Juggling

- with "==" in php7 and below there is a vulnerable
![img_20.png](images/img_20.png)

### The Only Cryptography Secure Random Function
- don't use 
  - md5 of slug value because you can reverse it easily 
    - time() because you can know it from created_at prperty 
    - uniqid() because it's not secure
- but use rand() or random_int() instead (Str::random(40) in laravel)
![img_25.png](images/img_25.png)

### Deserialization Attack and solution

don't use serilize
