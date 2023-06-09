<h1>Project Installation</h1>
<h3>Technical Requirements</h3>
<ul>
    <li>Docker</li>
</ul>

<h3>Running the Project</h3>
<pre class="notranslate">
    <code>
    $ docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php82-composer:latest \
        composer install --ignore-platform-reqs
    $ ./vendor/bin/sail up -d
    </code>
</pre>

<h3>Creating Tables</h3>
After configuring the necessary database settings, let's create our database tables so that the project can work.
<pre class="notranslate">
<code>$ ./vendor/bin/sail artisan migrate</code>
</pre>

<h3>Adding Dummy Data</h3>
Let's fill the tables created in our database with dummy data.
<pre class="notranslate">
<code>$ ./vendor/bin/sail db:seed</code>
</pre>

<h3>Running the Frontend</h3>
<pre class="notranslate">
<code>$ ./vendor/bin/sail npm run dev</code>
</pre>
