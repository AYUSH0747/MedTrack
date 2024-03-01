<?php
session_start();

// var_dump($_SESSION);

if(!isset($_SESSION["userid"]) || empty($_SESSION["userid"])) {
    header("location: login.php");
    exit;
    echo "Condition is met";
}

$user = $_SESSION["user"];

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>MedTrack</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <style>
        body {
            background: linear-gradient(to bottom, #ffffff, #f2f5f7); /* Light gradient background */
        }
        
        .card {
    width: 400px;
    height: 300px;
    background-color: #f0f0f0;
    border-radius: 20px;
    margin: 20px;
    display: inline-block;
    transition: transform 0.3s ease;
    cursor: pointer;
  }
 
        .card-img-top {
            height: 200px; /* Set a fixed height for the card images */
            object-fit: cover; /* Ensure the image covers the entire space */
        }
       
        .container{
            padding-top: 4rem;
        }
        
        .card:hover {
            transform: scale(1.05); /* Increase size on hover */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add shadow on hover */
        }
      
        .custom-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;          
        }
     
        
        .card {
            max-width: 300px; /* Set maximum width for the cards */
            margin: 0 10px; /* Add some horizontal margin between cards */
        }
    </style>
    <script>
  function redirectToPage(pageUrl) {
    // Redirect to the specified page
    window.location.href = pageUrl;
  }
  

</script>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <nav class="navbar bg-body-tertiary fixed-top" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="welcome.php">MedTrack</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="history.php">History</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Reports
                        </a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="createReport.php">Add Report</a></li>
                        <li><a class="dropdown-item" href="modifyReport.php">Edit Report</a></li>
                        <li>
                        </li>
                        <li><a class="dropdown-item" href="deleteReport.php">Delete Report</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-danger active" role="button"  aria-pressed="true">Log Out</a>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
        </nav>

        <div class="container mt-5" >
        <div class="row">
            <div class="col-md-3">
                <div class="card" onclick="redirectToPage('./login.php')">
                <img src="https://www.topdoctors.co.uk/files/Image/large/58b0424e-411c-4243-9228-4a0725bbab96.jpg" class="card-img-top rounded-circle" alt="Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Card Title 1</h5>
                        <p class="card-text">Description for Card 1</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" onclick="redirectToPage('./login.php')">
                <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoHCBUVFRgWEhUYGBgSGBERGBgYEhgSEhgYGBUZGRgYGBgcIS4lHB4rHxgYJjgmKy8xNTU1GiQ7QDs0Py40NTEBDAwMEA8QHhISHzQrJCs0NDQ0NDQ0NDQ0MTQ0NDc0NDQ0MTQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NP/AABEIAKgBLAMBIgACEQEDEQH/xAAcAAABBQEBAQAAAAAAAAAAAAADAQIEBQYABwj/xAA8EAACAQMCAwYDBQcEAgMAAAABAgADBBESIQUxQQYiUWFxgRORoTJCUrHBBxRicoLR4SMzkvBTohVDsv/EABoBAAMBAQEBAAAAAAAAAAAAAAABAgQDBQb/xAAqEQACAgEFAAEDAwUBAAAAAAAAAQIRAwQSITFBUSIyYQUTcSOBkbHBFP/aAAwDAQACEQMRAD8A3RO8kUuUjssk05pZA6NB3jliERIA9ORn5ySnKRyd4IA1GSBB0xCAxMaOiiJFMQxZ0bmKTAAbCMqU8jeHxGsIyTz/ALZ2GpCV5jcTIcK7TGidNTYcs9J6jxyhqUzybjFguthjnHJtcoaNxZdoKTjOofOWtLiFM8mE8Rq2VRDmmzY8AY+neXS8i3uJLnYbT2171B94Sq4rxamFPeE8tW6uW+0+IT4Tn7bk+pj3/gKDcXuldiV+csuxjuz7A6R18ZUWlp8Vwi8us9U7OcGVFGB4RRVuwb8NFYL3RmTVECi4GIZBKYggEcBEWPAiKExFxOixAdiIwjpxMAI7LGYhWjMRkigRjmLUbAkN60aQHF8mS0MhURkyVBgHMZEzE1RAMdJyiPV8zmEoBmY0tvHVIwHeAB2bAgKe8dXO0635ReAS6Yj41IQiIBsXEQCPMRQIxyCdiOWMkeRBsIUCNcSbKKy/pZUzybtjRam2sdDvPZqlPMzXG+yJuQQaipn+AuflkQc41TYKMn4eR2N4rnBky9dFXM1tL9k5TdLvJH4qG30faUHaPsvc0FOpNaD79PNRfcY1L7jHnOakinCRlmvwOQgHu2YgDmdgJEbr8poOyXCvi1NRGynb1lJNuiWa7sZwTSAzDc7mek21DAkLhNjoUbS3VZ1fHAkIKccqRwWEVYrGCM4GOcRgEAHCKI3EWIBwnMIgiwAEYgEewiYjJId00ildoe5beDYSkAS2SPd4+mu0YyZMAEQ5jo9VxBloACyRCq+YlRYBDvACTU5QNPnDHcRiDvQQDriJR5R1xGKdoeATKJhhI1uZKEljR2I4idFxEMGBEbaPgqj59JEpqPY4wcnwL8bAkWrfqm5O/nzgbmqekoOJ1Qql3PLvY67fqZjnlk2ehiwRXZov/kBjJOBIXEe0NOkupm6qPmQP1mGqcVqVidHJeo3VQTgZ8PCHo2YfAqd8/wAW6+w/Uzm3Lo24dJGXL6RrbXtPSb76/wDISyHFqR+8PnmZ2hwhMYOn5DEHcdm1O67H+ElD9JS3pDlp9O3VtB+0fCLC8UiroWpju1VGmoD07w+0P4W2kHsf2fFEadSvpONabo/8QlbU4JWDD/UfHgwBPzEu7ezrFQutgoHIHQvyGJ1xZnG7XJwz6CDa2SVet/8ADY00A22/WReL13RCaQBchsZGRsMzJXXDFQZJGfKRuE8XdbhabOSrK4UMxZQ40t1O2yke86LPbpqjnL9M/pucJXSvqujW8C4sapKVAA67jAIBHIjB5Mp2PqD1ltc1giM7ckVmPsMzIvautxqoKTltajHiMnPgNz85c1hUOGuHCqCCKac2IOcMTzH0nTdXZ5ZU1uL3NGsnxQrpURXKqO+MswPwwBl8AKSvMgnBJwDp6TBgGUghgGBByCCMgg9RKbijIzLcKDm2qElXGkBCmlzg77ZD7DkhHUSfw6k1MMrsCpZmT8SgnLAjoNWSPAHG2BBSrsFFvonYnYjhOxLsBuIkeROxABmIx+UMRA1jtGBVXDd6FQZkKu/fk+2OZ08JJartG6MRymNdpAA3MbphAkGXlAIeUjuMGSKIyIKusEAVG2iIN4ykdoeiN4AMriNCwlaNUdIm0lbHVukFtzDq+YlKmAPGFCCZZ5W/tO8caXZwikmdpiHPSc1KS9K2pjWUwFWmx6SUKmOcIKgMTW7tlqTj0jM8QrqmS2wXx2yZkLlql3UCUwTk7AcgPE+A856hdWqVF0uqsp6MAw+shWlnQtsimgUMck7k+mTvjykrGk+XwdlndcLk8/4hRW3PwFOdGC7AfafG59FB0j+rxjLergyPcVDUcuebEsfVjk/nODYM4uVuz6fDhUMSj7XP8mht709ZNW9PjM1TuIdbqWpmaemTfRo1vfHeCuuJEDAlEL2Me7zDeQtGrtoddXLNzMzfFKzKyupw1Ng4PmDkflL344lFxnr57xJ8no4oKnGvD1HspxNamHXGmoit0ypzgj2bKnzKwnGr2hR1MzY5knWVbfprHeX2wfXlPNuwPGTTqmkx5lnQH7JOMOh/mXf1HjiWN7wUvcadZFN31I/w2q1QpIDFuWgKcqTnJK+E1KVxs+M1WF4srj54WL9qab0alJCFdD8WkQmEJzlkIG2eu5zvkjbEndl+LfFp4GxXLaCe8BsCBnnpOB44Kk7tIzPYWyPTRBUyrK7uA7EYyRnG3Q6VGeuNszra4/eLfRSpurUj/o1KaFirE/f5AA9QT3geh3kSVrjsjFcHz/g0ouifEEe0n0rnPOZNbuqmEuE0PpBIyGX1U9Rz/XEn2nE15k8uQ8ZyWSUWapYozjaRo/iCKHHjKhOJBpJS5U9Z2Wdmd4KJ0jXLbSM1wBureojnq6hO+PIpOvTjPE48+FLct35ZWJ2lVeHvS1sBtNT6OKJ8RVjljsTkMHUaRd5IdcmO+HGnQFXa3w5HYw9Rsyvvbf7ywllVyMGXXoEugZJt5HpjEkW5wCT03ifQIZWO4HjJKASp/edTlunIekkLdAdZ5+TLb/BshjpfktFE5kPQ/PlAUrgHrJKODJ4YO0IKn4hiOBEdjPORKwK7jdeviP8AEb4BUyZpBkatbkbr8uh9PCDF4MZka44sqg7/AFxFKUaKjCV8DjdsBy5cx1mX41xZhqOdlBPPEsrXiHxC/oP1/wATOcSoa6iJz+I6J/ycD9Zyb3JI1QqErMvw+7LKCTzAkxqsg8Ts/wB3uKtLGAjuEH8BOU/9SI9H2kyjTo+qxZIzhGS9SJqVIX4kgI8JrknRpMkNUjTUkdqkYXjKUUSDWkS+bUJxeMY5jQnSKJmZWDKSGVgykcwQcgiek2yPVpBWbQayI53IUMRhX/kOMHwx4qZhTZl6iqg3ZgvznuI4OpoJTOA1JFRW54IAznxGRymvErR8p+rNKa+eTH8E4X8e2ek/+9bVHZCw3ywxoYncqWUg+0seyN38NzTbYHTsfwsx0H+l2KE9dSHpEuKle2qajSO4VGcDWrDUNGNxltiBzO+/KTrHhhqOatRApfUdOdxrzrBxtg5+p5dG5JNfJ5axyavw0N5YpVXTUQMOmdiPQjcTN3nZRlJag+f4HOD7MP1E0tHUFAL6iBjUQNRx1ONs+0IWPj9IS2S+5DhKcOmYC4o3FL7dJ8eIGtfmuZEp8a6Z+s9INXxHymX7V8HR1+JSTvr9oKuGce3MicJ4Y1cWacedt1JFVQvcnOZcUbvI5zFUamk4yQRzBGCPbpLS2uvOck2jtKNlzdKSwPnLmzXCiUtrWzzlzQqjAnoYtQmtsuzz8uBxdonII8wanaIXnY4jwuICpXGeci8Q4gEXnM291UY5GcGWo2S2aBTqHrI2jQ0LaHbEmC1DEZjugG0xkbSJxK40jQP6v0EsristNDjnyHmfCZ1zzJOSdzMeoy8bUd8MLe5gaNYjIJ9JAub1kOenXrg+PpHXwV/H2OD6iUF3VqJzGseZw/v0Mx0bUy7HGmRwc9xtj5Hp7TRWHFdXWeU172oxCqNC9TkM3pywBLvhNGuuAKm2M5KgkctgY6oOz0qpxPTI9fjw+czr1m04ZixHU4yflKq5rEAn2HqeUW6TBRiu0XlheOVYs+oFn0gDSAmo6R5nGN5W39ySTkwln3EHpKy5fWwT8R39P8/3hQ2+S64HkIWP3zq9un0knglH4l0h6U9VQ+wwv/sRI4cImJfdjqKBXfUpdzpxkagq+I8z+Ql4lckRldRbKL9pPBshblBuuEqY8PuMfyz/ACiYei+090urZXRkcZVwVYcsg+fT1njfH+DPa1SjbqcsjdGTO3uORHT0IJ6Z4c7j0f0rV3H9qT5XX8FeTgx4qSOXhUTMzNHvxyKhSczsxQhjxTgW8iBxuY5xJXCuGvcVFSmM5O56AdSZSi3wjhkzRjFyk+DQ/s/4P8Sr8dx3aW4zyL9Plzmt45xeojinSAH4nI1HkD3Ry6y24Vw5KFNaaclG58T1MDxjhXxRlMBx47Bh4EjkfP8A6Ne1xhS7Pkc2pjmzucuukZynULMpquzEEt3jkDboOQl7SvVAGDKRuCXA5U/fWh/Mys4tWe3GKysCw1DGGz6EHH1meUZrk6XjfCZtUv1Md+9iea2PbG35VHNNvBwQPZhlfrLeh2it22SvTY+C1EJ+QMVyXZO2DdI2fxQesR222Myb8Y09ffpFXimoggnPiInMpY2i7rWiVcirTVsZAJG49DzHtKa57MhTqoOR/A5yPZuY98yQnEmxzkmlfgyeGP6o9EGxsKg+0MY95ZFCsIlwDDMNQjVCk2wllV1ID4Er8o25qYEDYKVDqfxah7j/ABErDUcT08LuKZ52RVJoqqlFqr+UuLfh6hQMQtvQCiSdU6OXwQkQbVcdN4d3x1xIta9VdhufLl85Be4Zjkn+0XYDeK3W4HIAZ9c9fyHtKx6+Y/jVTdD4qV91Y5+jLKtas87MnvZuxVtQaq0q7veTGPnK+7BkI62Z6/qYyB6f4h+C9oDSISrkpyDAZZR4EdV+o/JlajqPkP8ApkKla62LAbDYe0ZPNmwq8doac/EX03Lf8cZ+krKHHqLv3yUCk41LsfPIzj3lOvDyeklW/CfERUilbLXiHaJAuml326AZC+7Y/LMqrfitfOdC7775Jlpa8HXmRLa24enhBlRRWW17UfZxjyAl9YUDtjIjbazTmBzlxbIBJqztaSD0riso7tRvc6h9ZWdoLitWplHCOOasUw6t4qRy8PMS2+IseiI2xlNyqrJhsUt1cnllamVOHGDv6H0jbetg4M9JvOC0XBDAEGZbiXZJ13otqH4W5j0b+8nn09PHqoviRWBxA17oDYRr2tRNnpuP6cj5jaabsz2PW4UVaj4XJGkDv5H4ui/WVGG50i8mphjjuk+DNWFpUruFpjGTuxOFA8z/ANM9c7M8HS3p4TvM32nxgnyHgJR8b4ctBB8FAopkNtzPiSepl5wK8DoD4gTbDCoq/TwNXr5Z3tXC/wBl3mJriAzsSzCLrlfxnhqXNMo/qrdVbxEmuwUEnkASZnLzjTOGFPKgd3P3jnr5SJuKXJcIybtHmPGuyNd6j01Qal21Fu55bjfkfCLw/wDZlXBDGuqnkQEZgQemSwno1mgAlnRcTJufS6Njim7a5MJYdhLhD/uoR4FGwfqZY1OyFyO9TdP5SzY9jpyPfM2AuMTnvRj7Qk7Y+l75vowdW2uqP+7RcgfeT/UX17uSB6gQlnfq3JvrNqlzmRrzh1CqcuilvxDuv/yGDJcfge75RUUa3nJ9OvCUeE01+yT7nMS4tcDIhQnJXwNqXhAJzJdl3gG8QD8xmZq/qlQczVWmNCD+FP8A8ia9LJ8oy6lLhhomqECxmiaTKZzXiMLgmEddoNVlgR+MqTQLD/6mWp/Se4w/9gf6ZRK4PKat6OtHT/yJUT3KnH1mBt6+w9pj1Efqs16d8NFuzSBctnYdZ3x8xpfG/WZ6NICvQzhF5tzPgOslU7QKAoEfYrjLNzb6DoJKRxnMnkOAKW+0kpQE5XEU1wI6Ybkg6rjaOappUnrEtqT1WC01JJ8BsPMnpNBZdlxj/WfPI6U6HzYzpHFJ9ESyxj2UlKrpAHhjMliqTy+gzNXbcJoJ9mmvqw1t8zLBFA5AD0GJ0/Y+WcnqvhGHWhWb7KOf6GxCJwy5zkI3vgfmZtjGM0f7ESf/AEy8Ml+63P8A42z7f3jGqVE/3EZfVTj5zXKMwypE9PHxlx1cvUjEvXVxvLLslTINQj7B0jyyMzQNaIdyik+aqT+UeFAGAAAOgGB8oQxOLuwy6rfHakV/FrYOhHiJlOztYpUemfunb0m1uNwZgeLE0bhX6E6TNS6MTPQKZyISQeHV9SCTYmigdzT1oynkwImLrcNq02K6GYE5DKpYEe03EaRIlFSLhkcTIW9pcAZ+G2PMYPy5xXuWT7alf5gV/Oa4TIdrb9aqmkiayCQWOyjmCMdZxlhildnaGaUnVA34iPxD5yIbr036zztf2dVmPdqKB5qf7zRJ2UukVdDrqCgHDMuSBzxODivGaIuXqr+5rad+BFPEfCYt6d/S+1SLjrjBPtj+0VOOldqlN0P8SMB88SWhm3p3xzzkkXYImUs79X+yZaLU2iAPxW2DISOgl+h2HkAJkbu5IUgnY7H0mitrgMiMOTKp+k16X0y6jwsRUInPcbyH8Qn5x3xBNdGUqkJO0elOCLxwciMAwbSQfDeef8btfg13QfZJ1r/K24+XL2m515lL2rtNaJVA3p9xvHQx7p9myP6pyyxtHXDLazL03MMXgURicL18N5e2PZ9mGajFfIDJmdQcujS5pdlZ8U7Qqu3IAn0GZqbPhlFPuaj4t3j8uQk5tOO6APQATosHyc3m+DJU7Oq+4QgY67fnJFtZj7xyfDpLr4pkFwAx89/nKWOKFvbLTs/W0VQOS1Bo8s8xNbMJSJBBHQg/Kbqi+pQw+8AZZyl3Y4GEQwRiq0ZIYmMAirvCqskDlWOjgJxk2A0wbQjCBdo0AKoZmu0nD9aHHPmJoWOY25pBlIlrgkznZLiGpNLfaTun2muWecOxtrnPJKhx5AzfWVcMoMJIESSZ0SdmSAhmNuaOiq6t+IkE9QdwZssyLeWSVBh15ciNmHoZE47lR2xz2soKVwohal4DjErO1NulpS+MS7oGRGAUF11NpDcwCMkSlsON0KhxTqqW5aSdD/8ABsE+o2mSUJR7NcckZGtSup5zmRD0EphcCKbjzkWVwW4oJ0A+QldflV5SK9yw5GRmuAftQbCkVvEbrYjyM0vZirrtlHWmWT2+0PoZjuJuN8dTLzsRc990/EoceqnB+jfSacH0sz5VcWaeo+kb+Uh/HMs6iBlwfWV70N5tMgFROJkNLg4nLc4isdE0RWVXBRx3XBRvHB8PMc/aQjck8oSm56wfIIi2/D0okgDJH3vHzEnUqkfdLqQOBuuFPoeR/T3EhK8EkkdLst1VTGPS8DAUasPqJ5RkkerTkS4pbgyzbcQFVMiTRSYFEmn4JVymn8H5TN0BLPgtXS+PxbQaFI0LCMMIYNoiQtFpIBkNDH/FxE0BJJjC8ALkRxOYqAc1SAd4xyYglJAPUR2IgjxADM9qeFa0OOY3B85C7JcYJGh9np90iay5QMCJ53x+1e2qivTBx98DqPGNEs9LV8x2ZR8C4otVAQc5AlyDE1QDpxjdUQwKKftTYfvFrXpdXp1Av82MqfmBPnw1Cj0qwH2SjkHxU4YH5GfSzz597T2Hwq1xSxtTqM6/yP3xjy7xHtIkvQTL8CtQcgt3Hw6jOpMHoM8vaWlC61AHkeo6SLbH94saVQbvSUK3idPdb8oG2cHE4ZIJM1wlaLNrkyPUqAnMY5kZ2nPaU5A7s5k3s9X0XNNjyLaD6ONP5kSvO5naiCCOYII9Rylp0Kr4PVFODvA1FGYqvrCuOThX9mGf1jzS85uMJlw0IlOdOiQB1oQq0Ys6MCRQUbqeTAqfeVjoVJB5gkH2nToiohKTQ9N8RZ0ZRKSoDB5706dEIEy4b1haL6WDeBiTpXgGsRwygjqAY1jOnTmIZgwFVzOnQJAL6yXQreMSdGyiVsY3ROnRAcYuZ06AAWaVvFbMVEIInTo0JmDtqz2NbS2fhudvBSf0nothfK6gg5zOnR/JJLEXVOnSRiO08m/adZaa6VQNqyGk38ybr9CflOnRP7R+lX2F4iE10n+yTq+exl1e8IZGL0hqRt8DmIk6LapLk6xbT4IbM3VWHqDAO86dODR3GAxAZ06Sxo3XCOI6LekKgzlDgj8OohfoBLNOIUyM6wPI84s6a10jJL7mf//Z" class="card-img-top rounded-circle" alt="Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Card Title 2</h5>
                        <p class="card-text">Description for Card 2</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" onclick="redirectToPage('page3.html')">
                <img src="image.jpg" class="card-img-top rounded-circle" alt="Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Card Title 3</h5>
                        <p class="card-text">Description for Card 3</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5" >
        <div class="row">
            <div class="col-md-3">
                <div class="card" onclick="redirectToPage('page3.html')">
                <img src="image.jpg" class="card-img-top rounded-circle" alt="Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Card Title 4</h5>
                        <p class="card-text">Description for Card 4</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" onclick="redirectToPage('page3.html')">
                <img src="image.jpg" class="card-img-top rounded-circle" alt="Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Card Title 5</h5>
                        <p class="card-text">Description for Card 5</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" onclick="redirectToPage('page3.html')">
                <img src="image.jpg" class="card-img-top rounded-circle" alt="Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Card Title 6</h5>
                        <p class="card-text">Description for Card 6</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5" >
        <div class="row">
            <div class="col-md-3">
                <div class="card" onclick="redirectToPage('page3.html')">
                <img src="image.jpg" class="card-img-top rounded-circle" alt="Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Card Title 7</h5>
                        <p class="card-text">Description for Card 7</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" onclick="redirectToPage('page3.html')">
                <img src="image.jpg" class="card-img-top rounded-circle" alt="Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Card Title 8</h5>
                        <p class="card-text">Description for Card 8</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" onclick="redirectToPage('page3.html')">
                <img src="image.jpg" class="card-img-top rounded-circle" alt="Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Card Title 9</h5>
                        <p class="card-text">Description for Card 9</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
   


    </body>
</html>