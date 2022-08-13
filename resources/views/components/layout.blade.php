<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome CDN -->
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>System Dashboard</title>
</head>
<body>
    
    <nav class="row left">
        <div class="topnav">
            <img src="img/default-img-light.png" alt="">
            <ul>
                <a href="/dashboard"><li><i class="fa-solid fa-house"></i> Dashboard</li></a>
                <a href="/map"><li><i class="fa-solid fa-map"></i> Map</li></a>
                <a href="#"><li><i class="fa-solid fa-user-group"></i> Responders</li></a>
                <a href="#"><li><i class="fa-solid fa-circle-exclamation"></i> Emergencies</li></a>
                <a href="#"><li><i class="fa-solid fa-gear"></i> Settings</li></a>
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-right-from-bracket"></i> 
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
            <button class="btn btn-pdf">Download PDF</button>
    </nav>

    {{$slot}}
</body>
</html>