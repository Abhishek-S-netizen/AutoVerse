<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        #loader {
            position: fixed;
            width: 100%;
            height: 100vh;
            background: rgba(23,23,23,0.3);
            backdrop-filter: blur(20px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            font-family: Audiowide;

            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease;
        }

        .car-loader {
            font-size: 50px;
            color: white;
            animation: drive 1.2s infinite linear;
        }

        @keyframes drive {
            0% { transform: translateX(-30px); }
            50% { transform: translateX(30px); }
            100% { transform: translateX(-30px); }
        }

        .text-loader {
            margin-top: 10px;
            color: white;
        }
    </style>
</head>
<body>
    <div id="loader">
        <i class="fa-solid fa-car-side car-loader"></i>
        <p class="text-loader">Loading...</p>
    </div>

    <script>
        let loader = document.getElementById("loader");
        let links = document.querySelectorAll("a[href]");

        setTimeout(() => {          
            loader.style.visibility = "visible";
            loader.style.opacity = "1";
        },1000)

        /* links.forEach((link) => {
            link.addEventListener("click", function(e) {
                let url = this.href;
                e.preventDefault(); //Prevents from immediately navigating to the next page

                loader.style.visibility = "visible";
                loader.style.opacity = "1";

                setTimeout(() => {
                    wind.location = url;
                },300);
            });
        }); */

        window.addEventListener("load", function () {
            loader.style.opacity = 0;
            
            setTimeout(() => {
                loader.style.display = "none";
            },500);
        });
    </script>
</body>
</html>