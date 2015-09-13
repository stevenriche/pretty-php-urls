# pretty-php-urls
Short PHP script to organize a small web application with user-friendly URLs

Inspired by the way that the CodeIgniter framework handles URLs, this is a short index.php file that helps organize a small web application into a MVC pattern while keeping nice looking URLs.

For instance, instead of using a URL like:
http://www.example.com/index.php?q=my_action&params=my_params

You can use a URL like this:
http://www.example.com/my_controller/my_action/my_params

# How it Works
In the index.php file, you will specify a default folder where your controllers are stored, your default controller file, and your default action in that controller. 
