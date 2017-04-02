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

            <p>This is content that is already in master.blade.php, not pulled in from elsewhere.</p>

            <section>
                @yield('content')
	        </section>
        </div>
    </body>
</html>
