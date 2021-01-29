# Bjornstad Endrborinn

Derived from the norse word for 'son of', and spawned from my previous framework 'Hoegr' (taken from the norse word for 'conenient'), Bjornstad is a simplistic MVC framework built into it's own dockerized project container for ease-of-use. 

Bjornstad is a learning framework, utilising an advanced routing engine that uses regex to route requests between controllers. Bjornstad is intended to be used to teach the concepts of MVC by providing a bare-bones example on how modern frameworks are constructed.

Play around with the framework, build some small projects, customise and make it your own. It is not recommended to use any version of Bjornstad in a production environment, it is not a battle-tested framework and is likely insecure and unreliable for the needs of enterprise level applications. 

Please note, your project must contain a .env file, to create a valid .env file copy the .env.example, adding in your own configuration values.

## Endrborinn Edition

As a small framework project, Bjornstad has developed into a few iterations, from the incredibly basic and buggy Hoegr, to the slightly more mature Bjornstad2. Bjornstad Endrborinn rebuilds Bjornstad from the ground up, adding more quality of life features, a more familiar file structure and a greater emphasis on object oriented PHP. 

The term Endrborinn comes form the Norse belief in reincarnation. Bjornstad Endrborinn is born anew, still Bjornstad, but from the ashes of the old framework it has risen again to become anew. 

## Dependencies

- [Docker](https://www.docker.com/products/docker-desktop)
- [Composer](https://getcomposer.org/download/)

### Composer Dependencies
- [vlucas/Dotenv](https://github.com/vlucas/phpdotenv)
- [twig/twig](https://twig.symfony.com/)

## Framework Documentation

### Routes

The routing engine allows for routes in the following format <code>{controller}/{action}</code>. The routing engine allows for the passing of variables in any order. 

Routes can be sued as such:

<pre>
    $router->add('/', ['controller' => 'HomeController', 'action' => 'index']);
    $router->add('/posts', ['contorller' => 'PostController', 'action' => 'index']);
    $router->add('/Posts/new', ['controller' => 'Posts', 'action' => 'new']);
    $router->add('{controller}/{action}');
    $router->add('api/{action}/{controller}');
</pre>

Variables can be passed in through the URL.

<pre>
    $router->add('{controller}/{id:\d+}/{action});

    from this URL you can pass in a id:
            posts/123/edit
</pre>

Furthermore, regular expressions can be passe din variables by following the variable
with a colon + the regular expression.

<pre>
    $router->add('{controller}/{id: \d+}/{action});
</pre>

Defining a route with variables will look up the controller and action
passed into the route dynamically:

<pre>
    url: http://localhost:8080/posts/create

    $router->add('{controller}/{action}');

    This will call the create method on the posts controller.
</pre>

####

You can pass values to the route via query strings as normal:

<pre>
    http://localhost:8080/posts/index?page=0&items_per_page=10

    Query string parameters:
    Array
    (
        [page] => 0
        [items_per_page] => 10
    )
</pre>

The Bjornstad routing engine separates the query string parameters passed from the route before string matcing, therefore
you may still declare dynamic routes whilst passing in your query string values. 

### Controllers

Controllers are intended to be created in the <code>Http\Controllers</code> directory. All controllers should extend tha base controller which contains some basic functionality for storing route parameters. Without the extension of this controller you will be unable to access route parameters wihtin your controller. 

You can use the base controller by extending the <code>Controller</code> class. To import the class use the <code>namespace</code>: <code>core\Classes\Controller</code>.

Controllers should be defined in the Http/Controllers directory, however, Bjornstad does allow for the creation of subdirectories as it dynamically calculates namespaces for these controllers. 

#### Action Filters

Bjornstad action filters are functions within a controller.
Action filters allow for method calls before and after ever action
within a controller. This is done through the use of a common <code>Action</code> suffix in the controllers. Defining any method with an action suffix makes 
the method into an action. 

This allows you to run code before and after the action using the provided <code>before()</code>
and <code>after()</code> methods availabled on all Controllers. 

An <code>Action</code> is defined as such:

<pre>
    public function indexAction() 
    {
        echo 'Called: Post Index';
    }
</pre>

we can then define a before and after method which will run before and after any actions, this can be useful for tasks such as validating a user is logged in.

<pre>
    public function before()
    {
        echo "(before) ";
    }

    public function after()
    {
        echo " (after)";
    }
</pre>

Running the indexAction method in this case would output:

<pre>
    (before) Called: Post Index (after)
</pre>

It is important to note that to use actions you need only add the Action 
suffix, Bjornstad does the heavy lifting dealing with Controller/Route mapping
to ensure that a route named <code>home/index</code> will match with the correct action even with the suffix.

Returning false within the before() method will prevent the execution of the originally called method.

<pre>
    public function before()
    {
        return false;
    }
</pre>

### Views

Views are rendered via the <code>View</code> object. We can render views by calling the <code>Render</code> method of this class, please note that this is a static method. 

<pre>
    public function index()
    {
        View::render('Home/welcome.php');
    }
</pre>

Views should be stored in the <code>resources/views</code> directory. Views may also be stored within subdirectories, this must be included in the path provided to the renderer. The renderer looks for views starting in the views folder. 

Variables can be passed into the view through the render method:

<pre>
    public function index()
    {
        View::render('Home/welcome.php', [
            'name' => 'Luke',
            'colors' => ['red', 'green', 'blue']
        ]);
    }
</pre>

These can then be accessed in the view by calling the
variable name e.g. <code>$name</code> or <code> foreach ($colors as $color)</code>.

### Templating

Bjornstad uses the [Twig](https://twig.symfony.com/) templating engine. Twig is utilised through the core <code>View<code> class. Much like rendering a view, you can render a twig template using the <code>renderTemplate()</code> static function.

<pre>
    public function index()
    {
        View::renderTemplate('Home/welcome.php.twig', [
            'name' => 'Luke',
            'colors' => ['red', 'green', 'blue']
        ]);
    }
</pre>

Please note that Bjornstad begins its search for templates in the <code>resources/templates</code>
directory, subdirectories may be used. This separates templates and views into distinct locations.

#### Twig

Echoing Variables:

<pre>
    {{ var }}
    {{ var|escape }}
    {{ var|e }}         {# shortcut to escape a variable #}
</pre>

Twig allows for shorter syntax using common patterns:

<pre>
    {% for user in users %}
        * {{ user.name }}
    {% else %}
        No users have been found.
    {% endfor %}
</pre>

Blocks and template inheritance:

<pre>
    {% extends "layout.html" %}

    {% block content %}
        Content of the page...
    {% endblock %}
</pre>

Automatic output escaping:

<pre>
    {% autoescape "html" %}
        {{ var }}
        {{ var|raw }}     {# var won't be escaped #}
        {{ var|escape }}  {# var won't be doubled-escaped #}
    {% endautoescape %}
</pre>

Sandboxing:

<pre>
    {{ include('page.html', sandboxed = true) }}
</pre>

### Helper Functions

#### Dump and Die

As a quality-of-life feature Bjornstad contains a dump and die method. This can be used anywhere as it is included by the bootstrap.php.

<pre>
    $arr = [1, 2, 3, 4];

    dd($arr);

     Output: 
        array (size=4)
            0 => int 1
            1 => int 2
            2 => int 3
            3 => int 4
</pre>

<br> 

---

# Development Notes

This is a detailed description of the steps taken in developing this framework. This is not only to promote total transparency, but to allow you to learn from this framework as it is intended to be used as a teaching/learning tool. Please note that this framework is not battle-tested and therefore not appropriate for a production environment. 
## Front Controller

Nginx is set up to forward all traffic through to a single entry point. In this case we are routing all traffic from the browser through <code>public/index.php</code> This traffic includes parameters which are passed in through the URI as query strings. These requests are passed from the Front Controller to the router. 

## Router

## Overview

The responsibiltiy of the router is to get the <code>Controller</code> and the <code>Action</code>. The only thing the router should care about is whether or not it can find match for the provided URI in the routing table, to delegate work to the controller and method requested.

## Introduction

The router routes requests recieved from the Front Controller to the corresponding controller and action. An action is the method which is called within the controller. This is achieved by a relatively 'smart' routing table. The routing table is a basic array holding key value pairs. The stored items in this array include the <code>route</code> itself, the <code>controller</code> to call, and the <code>action</code>. If we take a look inside our routes array after adding a few routes to it we get a picture of how our routing table is being stored:

<code>
    <pre>
        array (size=3)
        '' => 
            array (size=2)
            'controller' => string 'HomeController' (length=14)
            'action' => string 'index' (length=5)
        'posts' => 
            array (size=2)
            'contorller' => string 'PostController' (length=14)
            'action' => string 'index' (length=5)
        'posts/new' => 
            array (size=2)
            'controller' => string 'Posts' (length=5)
            'action' => string 'new' (length=3)
    </pre>
</code>

The first key is our route e.g. <code>'posts'</code> which has a value of an array, containing two key-value pairs: our <code>controller</code> and our <code>method</code>. The visual below shows a design table for a basic routing table.

        | Route       | Controller  | Action      |
        | ----------- | ----------- | ----------- | 
        | "/"         | Home        | index       |
        | "/posts"    | Posts       | index       |

The route is passed in from the URl, the router then looks up the route in this routing table (array), if there is a match, the router must then look up the corresponding controller and action. The only responsibility of the router is to get the <code>Controller</code> and <code>Action</code> requested.

### Route Matching

The router match method takes a URL from the query string. This then iterates over the key-value pair array (associative array) of the routing table to find a matching route. If ther eis a route which matches, the parameters for that route are set to be the parameters passed in the query string and true is returned to indicate a match has been found, otherwise we simply return false. In the Front Controller the <code>$_SERVER</code> is accessed for the <code>REQUEST_URI</code>. 

We can check the matching by declaring a few routes and echoing out our parameters in the browser:

<pre>
        $router = new Router;

        $router->add('/', ['controller' => 'HomeController', 'action' => 'index']);
        $router->add('/posts', ['contorller' => 'PostController', 'action' => 'index']);
        $router->add('/posts/new', ['controller' => 'Posts', 'action' => 'new']);

        $url = $_SERVER['REQUEST_URI'];

        if ($router->match($url)) {
            dd($router->getParams());
        } else {
            echo "No route found for URL '$url'";
        }
</pre>

### Advanced Route Matching

Simple string routing is not efficient. Matching a simple string can lead to duplications and a much larger routing table than necessary. Instead, we can use pattern matching, as routes follow a similar pattern. We have our controller, a '/' and our action. If we can get this pattern from the URL then we can pattern-match to determine whether or not the controller and action exists within our routing table. We can do this through the use of Regular Expressions.

In this instance we know every route should consist of a controller and an action:

<pre>
        controller/action
</pre>

In the original version of this routing engine a simple string comparison was performed. In the improved version regex is utilised to get the controller and action from the URI:

<pre>
    if (preg_match($reg_ex, $url))
</pre>

When starting development of this it is a good diea to ignore the routing table initially. Instead, we just assume all our request URL's have the controller/action format. 

We begin our regex by matching the start of our string using '^'. We then want to match any number of any letters from a-z and hyphens. This will match the controller, we then need to match our separator '/' which we escape, finally we match the action in the same way we did the controller:

<pre>
        /^[A-Za-z-]+\/[A-Za-z-]+$/
</pre>

To extract these strings we use preg_match:

<pre>
        $route = "posts/index";

        preg_match($reg_exp, $route, $matches);


        $matches = [
            0 => "posts", 
            1 => "index"
        ];
</pre>

We improve this further through the use of names capture groups:

<pre>
        /^(?P<controller>[A-Za-z-]+)\/(?P<action>[A-Za-z-]+)$/
</pre>

Instead of a numbered array we will now have an assoicative arraay with named items.

<br> 

#### Regex

Regular expressions are expressions used for advanced string matching/extracting. Regex can be used to create intricate rules in which characters can be compared and extracted to an exact pattern. This pattern matching enables complex behaviours such as extracting controller/method names from our routes.

##### Character Matching

Regex patterns are written between two "/".

###### Match Strings

- /abc/ - Matches abc in any string

- ^abc$ - Matches whole string "abc" only

- a+ - Match one or more "a"

- /abc/i - Match abc case insensitive

##### Symbols

- ^ - Match start of string

- $ - Match end of string

- \* - Match zero or more

- \+ \- Match one or more

- \. - Match any single character: letter, number or whitespace

- \ - Escape character

##### Modifiers

- i - Makes case insensitive

##### Character Sets

Character sets are denoted with "[]" this will match one
of any characters within the brackets e.g.[abc] matches a, b, or c nothing else.

Hyphens can be used to specify a character range e.g. [1-5].

We cancombine this with the repetition operators:

- /[a-z0-9 ]+/ - matches any sequence of alphaneumeric
characters and spaces at least one character in length.

#### Meta Characters

Used to match a specific type of character/

- \d - Matches any digit 0 to 9

- \w - Matches any character from a to z, A to Z and 0 to 9

- \s - Matches any whitespace character

#### Functoins

- preg_match($regex, $string, $matches) - matches string to regex

- preg_replace($regex, $replacement, $string) - replace matching string

#### Capture Groups

Capture Groups can be passed to regex functions which allow for it (such as preg_match). Any subpattern in parentheses will be captured as a group.

Names capture groups can be used (?<name>regex) to retrieve items by name from the capture group array.

Capture groups can be referred to using backreferences (\1,\2 etc...)

### Examples


#### Capture Group Backreference
<br>

<pre>
    $regex = '/ab(c)/';

    $replacement = '\lde';

    $string = abc;

    preg_replace($regex, $replacement, $string);

    result: cde
</pre>

#### Named Capture Groups
<br>

<pre>
    /(?<month>[a-zA-Z]+) (?<year>\d+)/
</pre>

#### Replace With Capture Groups

<pre>
    $regex =  '/(\w+) and (\w+)/';

    $replacement = '\1 or \2';

    $string = 'Bill and Ben';

    result: Bill or Ben
</pre>


___

# Resources

- Regex
    - https://www.phpliveregex.com/

- Packagist
    - https://packagist.org/

- PHP 
    - https://www.php.net/docs.php