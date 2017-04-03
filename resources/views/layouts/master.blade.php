<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            @yield('title', 'Anagrams')
        </title>
        <link type="text/css" rel="stylesheet" href="/css/styles.css">
    </head>
    <body>
        <div class="container">

            <section>
                @yield('content')
	        </section>

            <section>
                @yield('content2')
	        </section>

        </div>
    </body>
</html>
