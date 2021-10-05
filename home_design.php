<!DOCTYPE html>
<html>
<head>
    <title>Snopes</title>

    <style type="text/css">
     #topbar {
                
      width:1000px;
      margin: 10px;
      height: 100px;
              
        }
            
    body {
        margin: 0;
        padding: 0;
        }

    #logo {

            width: 170px;
            height: 100px;
            margin: 0px;
            float: left;
        }

    form {
        background-color: #39B54A;
        width: 750px;
        height: 44px;
        border-radius: 15px;
        display:flex;
        flex-direction:row;
        align-items:center;
        float: left;
      }

      

    input {
        all: unset;
        font: 16px system-ui;
        color: #fff;
        height: 100%;
        width: 100%;
        padding: 6px 10px;
      }

      ::placeholder {
        color: #fff;
        opacity: 0.7; 
      }

      svg {
        color: #fff;
        fill: currentColor;
        width: 24px;
        height: 24px;
        padding: 10px;
      }

      button {
        all: unset;
        cursor: pointer;
        width: 44px;
        height: 44px;
      }

      .below-bar {
        
        width:1000px;
        height: 100px;
        margin: 10px 40px;

      }
            
    </style>
      

</head>
<body>
            <div id="topbar">

            <img src="true_logo.png" id = "logo">

            <form role="search" id="form">
      <input type="search" id="query" name="q" placeholder="Search..." aria-label="Search through site content">
      <button>
        <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
      </button>
    </form>
    <script>
      const f = document.getElementById('form');
      const q = document.getElementById('query');
      const google = 'https://www.google.com/search?q=site%3A+';
      const site = '-';

      function submitted(event) {
        event.preventDefault();
        const url = google + site + '+' + q.value;
        const win = window.open(url, '_blank');
        win.focus();
      }

      f.addEventListener('submit', submitted);

  </script>
                
            </div>

            <hr>

            <div id="second-bar">

                <span class = below-bar> Sign In </span>
                

             </div>   
</body>
</html>