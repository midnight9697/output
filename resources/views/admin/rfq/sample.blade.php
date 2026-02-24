<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sticky Footer Layout</title>

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Full viewport height */
    font-family: Arial, sans-serif;
  }

  header {
    background: #333;
    color: white;
    padding: 20px;
    text-align: center;
  }

  main {
    flex: 1; /* Pushes footer down */
    padding: 40px 20px; /* Top & bottom spacing */
    background: #f4f4f4;
  }

  footer {
    position:fixed;
    bottom:0;
    background: #333;
    color: white;
    text-align: center;
    padding: 20px;
  }
</style>
</head>
<body>

<header>
  Header
</header>

<main>
  <h1>Page Content</h1>
    @for ($x = 0; $x < 200; $x++)
        <p>
            This area will expand if content grows.
            If content is small, footer stays at bottom.
        </p>
    @endfor
</main>

<footer>
  <h1>
    Footer
  </h1>
</footer>

</body>
</html>