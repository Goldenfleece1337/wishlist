<!DOCTYPE html>
<html lang="en">
<head>
 
    <link rel="stylesheet" href=" {{ asset('/css/style.css') }}"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  @yield('link')



    <title>Wishlist</title>
</head>
<body>

    <nav role="navigation">
        <div id="menuToggle">
     
          <input type="checkbox" />
          
      
          <span></span>
          <span></span>
          <span></span>
          
        
          <ul id="menu">
            <a href="list"><li>Home</li></a>
            <a href="about"><li>About</li></a>
           
          </ul>
        </div>
      </nav>
      @yield('content')

      
</body>
</html>

