***Question & Answer***

- Say, the content site got hacked, therefore when fetching the content URL for
  content parsing it can keep redirecting, how to solve this scenario?
 - Answer: 
      -  unvalidated user inputs, especially URL query strings.To minimize the risk of unwanted redirects,
      - avoid user-controllable data in URLs where possible and carefully sanitize it when it must be used.
      - Http all responses carefully check.
 
 - Say, the content site got hacked, therefore when fetching the content URL for
   content parsing it can inject virus / malware / adware. how to guard this?
  - Answer: 
    -   prevent SQL Injection by using PDO or mysqli php extension for safe query parsing 
        CSRF token use for uncontroller user data and also request custom validation with using regular expression
    -   using image or processing library for uploaded virus.
    -   using some speacial method in php like mysql_real_escape_string, htmlentities(), htmlspecialchars(), strip_tags() and 		   addslashes()
    -   avoid using shell script run command internally like  exec(), shell_exec(), system()
  
  
  - Say, that URL can contain NSFW contents, how to flag NSFW? so that those
    don't get included in the suggestion system we may develop in future?
   - Answer: 
   	- using image processing library