<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            @yield('title', 'Anagrams')
        </title>
    </head>
    <body>

    <p>This is content that is already in master.blade.php, not pulled in from elsewhere.</p>

    <section>
		@yield('content')
	</section>

    </body>
</html>
