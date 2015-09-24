# pretty-php-urls
Short PHP script to organize a small web application with user-friendly URLs

Inspired by the way that the CodeIgniter framework handles URLs, this is a short index.php file that helps organize a small web application into a MVC pattern while keeping nice looking URLs.
This is ideal for very small projects where you don't need or want a full framework, but you would still like to have nice control over your URLs.

For instance, instead of using a URL like:

> http://www.example.com/index.php?q=my_action&params=my_params

You can use a URL like this:

> http://www.example.com/my_controller/my_action/my_params

# Set-up
The only necessary files are the *index.php* and *.htaccess* files. The other folders and files are just used as an example to show how the *index.php* file routes URLs.

At the top of the index.php file, you will need to set four parameters:

1) **$base_uri**: If you are not setting up your application in the root of the site, put the file path here. 
e.g. if your application home is at *http://www.example.com/my_app/*, then **$base_uri** = '*my_app*'.
If your application home is at *http://www.example.com/*, then **$base_uri** = '' .

2) **$controller_path**: The file path to where your controller files are stored, in relation to *index.php*. See the included folders for an example.

3) **$default_controller**: The name of the controller you want to be used if none is specified in the URL.

4) **$default_function**: The name of the default method you want to be used if none is specified in the URL. 
**It is recommended that you have a method with this name in each controller, unless you want the user to receive errors when they enter a controller but no method in the URL**

Additionally, in the *.htaccess* file, there are two items you will need to enter.

1) If you are not setting up your application in the root of the site, you will need to enter the folder path from the root to *index.php* in the '**RewriteBase**' line at the top of the file.

2) Replace the example URL with your own in the first **RewriteCond** and **RewriteRule** lines. This automatically forces a '*www*' into your URL, even when the user forgets it. This helps keep accurate page hits for search rankings, and prevents some odd behavior where some browsers may not load relative linked files if a '*www*' is not included.

Note that *.htaccess* files are by default set to hidden on many platforms, so you may have to set your computer to be able to edit hidden files.

# How it works
The URLs are configured so that *index.php* will search for the correct controllers and methods based on the URL, then serve that to the user.

If the following URL is entered: *http://www.example.com/section1/section2/section3/section4*

First, *index.php* will look for a controller called '*section1*'. If found, it will grab that controller.
If a '*section1*' controller is found, then it will look for a '*section2*' method. 
If a '*section2*' method is found, then '*section3*' and '*section4*' are passed as parameters in **$this->_params**.

If a '*section1*' controller is not found, it will grab the default controller (listed in the config in *index.php*).
It will then look for a method called '*section1*', and if found, it will call that method with '*section2*', '*section3*', and '*section4*' as parameters.

If a method called '*section1*' is not found either, it will call the default method in the default controller (also listed in the config in *index.php*).
In this case, it would pass four parameters to that method ('*section1*', '*section2*', '*section3*', and '*section4*').

Finally, if a '*section1*' controller is found but a '*section2*' method is not found, it will serve the default controller from '*section1*' with three parameters passed ('*section2*', '*section3*', and '*section4*').

This set-up allows for lots of ease in setting up the names of your controllers and methods to make easy-to-understand and user-friendly URLs.

Additionally, each controller is passed a **_base_url** variable that contains the root URL of the application. This is very useful for dynamically listing absolute URLs for images, CSS files, and JS files.
If you were to move your application to a different address, you will only need to change the config options above and all of your addresses would update themselves.

