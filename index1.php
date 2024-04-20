<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Collection</title>
    <link rel="icon" href="/downloads/pacific.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-BVc+92Q+ebI+ouITXt4kX+vbKHYNFNBXL+3h+EGv0p5QIwR4JtvuIUnP6mxjZyDcICtj5htC8RqkxiKz8+JGEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Loading Overlay CSS */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            z-index: 10000;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
            /* Apply a blur effect */
            opacity: 1;
            transition: opacity 0.5s ease;
            /* Smooth transition */
        }


        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Other CSS styles... */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            /* padding-right: 65px; */
            /* padding-bottom: 50px; */
        }

        header {
            background-color: #46BEC9;
            color: #fff;
            padding: 10px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            display: flex;
            align-items: center;
        }

        header .logo img {
            width: 50px;
            margin-right: 10px;
        }

        header h1 {
            font-size: 20px;
            margin: 0;
        }

        .container-fluid {
            padding-top: 75px;
            /* Remove default padding */
        }

        .container-fluid.fill {
            height: 100%;
            /* padding-top: 150px; */
            /* Adjust as needed */
        }

        .col-lg-8 {
            /* Get full (height - header - footer) */
            height: calc(100vh - 75px - 50px);
            /* Adjust based on header height */
            overflow-y: auto;
            /* Enable vertical scrolling if needed */
            padding-bottom: 10px;
        }

        .col-lg-4 {
            /* Get full (height - header - footer) */
            height: calc(100vh - 75px - 50px);
            /* Adjust based on header height */
            overflow-y: auto;
            /* Enable vertical scrolling if needed */
            padding-bottom: 10px;
        }

        /* Style for scrollbar in col-lg-8 */
        .col-lg-8::-webkit-scrollbar {
            width: 15px;
            /* Width of the scrollbar */
        }

        .col-lg-8::-webkit-scrollbar-thumb {
            background-color: #46BEC9;
            /* Color of the scrollbar thumb */
            border-radius: 4px;
            /* Radius of the scrollbar thumb */
        }

        /* Style for scrollbar in col-lg-4 */
        .col-lg-4::-webkit-scrollbar {
            width: 15px;
            /* Width of the scrollbar */
        }

        .col-lg-4::-webkit-scrollbar-thumb {
            background-color: #46BEC9;
            /* Color of the scrollbar thumb */
            border-radius: 4px;
            /* Radius of the scrollbar thumb */
        }



        .video-list-container {
            padding: 10px;
            /* Adjust the padding as needed */
        }

        .search-sort {
            display: flex;
            align-items: center;
        }

        .search-box,
        #sortOrder {
            height: 33px;
            /* Adjust the height as needed */
            border-radius: 7px;
        }

        #sortOrder {
            margin-right: 10px;
            /* Adjust the margin between the combobox and the search box */
        }

        .search-box input[type="text"],
        .search-box button {
            padding: 5px;
            height: 100%;
            /* Set the height to 100% to match the height of the combobox */
        }

        .search-box button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .sorting {
            display: flex;
            align-items: center;
        }

        .sorting select {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-right: 10px;
        }

        .sorting button {
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #f9f9f9;
            cursor: pointer;
        }

        .search-box input[type="text"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .search-box button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .video-container {
            max-width: 100%;
            box-sizing: border-box;
            overflow-x: hidden;
            scrollbar-width: thin;
            /* For Firefox */
            scrollbar-color: transparent transparent;
            /* For Firefox */
        }

        /* Webkit (Safari, Chrome, etc.) */
        .video-container::-webkit-scrollbar {
            width: 10px;
            /* Set width of the scrollbar */
        }

        /* Track */
        .video-container::-webkit-scrollbar-track {
            background: transparent;
            /* Background color of the track */
        }

        /* Handle */
        .video-container::-webkit-scrollbar-thumb {
            background: #888;
            /* Color of the handle */
            border-radius: 10px;
            /* Border radius of the handle */
        }

        /* Handle on hover */
        .video-container::-webkit-scrollbar-thumb:hover {
            background: #555;
            /* Color of the handle on hover */
        }


        .video-header {
            background-color: #46BEC9;
            color: #fff;
            padding: 10px;
            font-size: medium;
            text-align: center;
            border-radius: 8px;
        }

        .video-title {
            cursor: pointer;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .video-item {
            display: flex;
            align-items: flex-start;
            padding: 5px;

        }

        .video-item video {
            max-width: 50%;
            height: auto;
            border-radius: 10px;
        }

        .video-info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .video-title {
            font-weight: bold;
            margin-bottom: 5px;
            padding-left: 5px;
        }

        .video-description {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-box-orient: vertical;
            transition: -webkit-line-clamp 0.5s;
            /* Add transition for smooth effect */
        }

        .video-description:hover {
            -webkit-line-clamp: initial;
            /* Show full text on hover */
        }

        .responsive-video {
            width: 100%;
            height: auto;
        }

        .group-title {
            padding: 100px 0px 0px 0px;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 80px;
            text-align: center;
        }

        .group-images {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .group {
            margin-bottom: 20px;
        }

        .image-title {
            background-color: #46BEC9;
            color: #fff;
            padding: 15px;
            box-sizing: border-box;
            text-align: center;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .download-link {
            text-align: center;
            margin-top: 5px;
            padding: 10px 20px;
            position: absolute;
            /* Position the download button */
            bottom: 0;
            /* Align the download button to the bottom */
            left: 0;
            /* Align the download button to the left */
            width: 100%;
            /* Ensure the download button spans the full width */
        }

        .download-btn {
            background-color: #46BEC9;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .download-btn:hover {
            background-color: #46EEE0;
        }

        /* CSS styles for centering the message */
        .no-results-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Make the container cover the entire viewport height */
        }

        .no-results-message {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        .floating-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding-bottom: 40px;
            /* padding-right: 5px; */
        }

        .floating-button {
            display: block;
            margin-bottom: 10px;
            background-color: #ffffff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            text-align: center;
            line-height: 40px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .floating-button:hover {
            transform: scale(1.3);
            /* Increase size on hover */
        }

        .floating-button img {
            width: 30px;
            height: 30px;
        }

        .card img {
            width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            transition: transform 0.3s ease;
            /* Add transition for smooth zoom effect */
            transform-origin: center center;
        }

        .card:hover img {
            transform: scale(1.1);
            /* Zoom effect on hover */
        }

        .card .image-title {
            /* overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis; */
        }

        .gallery {
            column-gap: 15px;
            padding-top: 10px;
        }

        .card {
            width: calc(33.33% - 10px);
            height: 250px;
            /* Set the height of the card */
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        /* Responsive adjustments for column count */
        @media only screen and (max-width: 576px) {
            .card {
                width: calc(100% - 10px);
            }

            .gallery {
                column-count: 1;
                /* Adjust the number of columns for smaller screens */
            }

            .col-lg-8 {
                padding-right: 50px;
            }
        }

        @media only screen and (min-width: 577px) and (max-width: 768px) {
            .card {
                width: calc(100% - 10px);
                /* Adjusted width calculation */
            }

            .gallery {
                column-count: 2;
                /* Adjust the number of columns for medium screens */
            }

            .col-lg-8 {
                padding-right: 50px;
            }
        }

        @media only screen and (min-width: 769px) and (max-width: 992px) {
            .card {
                width: calc(100% - 10px);
                /* Adjusted width calculation */
            }

            .gallery {
                column-count: 3;
                /* Adjust the number of columns for large screens */
            }

            .col-lg-8 {
                padding-right: 50px;
            }
        }

        @media only screen and (min-width: 993px) {
            .card {
                width: calc(100% - 5px);
                /* Adjusted width calculation */
            }

            .gallery {
                column-count: 4;
                /* Adjust the number of columns for extra-large screens */
            }
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #46BEC9;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            z-index: 1000;
            display: none;
            /* Initially hide the footer */
            animation: slideInUp 0.5s ease-out;
            /* Animation when footer becomes visible */
            height: 45px;

        }

        /* Keyframes for slide-in animation */
        @keyframes slideInUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <header>
        <a href="/vathana/downloads/" style="text-decoration: none; color: inherit;">
            <div class="logo">
                <img src="/vathana/downloads/pacific.png" alt="Pacific Logo" width="50">
                <h1>Pacific Free Software</h1>
            </div>
        </a>
        <div class="search-sort">
            <select id="sortOrder" onchange="sortProductCards()">
                <option value="asc">Sort A-Z</option>
                <option value="desc">Sort Z-A</option>
            </select>
            <div class="search-box">
                <form id="search-form">
                    <input type="text" id="search-bar" placeholder="Search...">
                    <button type="button" id="search-button">Search</button>
                </form>
            </div>
        </div>
    </header>
    <div class="container-fluid fill">
        <div class="row">
            <!-- Left Column: Container for Cards -->
            <div class="col-lg-8" style="overflow-y: auto; max-height: 100vh;">
                <div class="gallery">
                    <?php
                    // Define the main directory where your files are stored
                    $mainDirectory = "/var/www/html/vathana/downloads"; // Change this to your directory path
                    // Function to format file size
                    function formatBytes($bytes, $precision = 2)
                    {
                        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
                        $bytes = max($bytes, 0);
                        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
                        $pow = min($pow, count($units) - 1);
                        $bytes /= (1 << (10 * $pow));
                        return round($bytes, $precision) . ' ' . $units[$pow];
                    }
                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $searchQuery = $_GET['search'];
                        // Display cards matching the search query
                        $files = scandir($mainDirectory);
                        foreach ($files as $file) {
                            // Exclude directories and files with image extensions
                            if (!is_dir("$mainDirectory/$file") && !preg_match("/\.(jpg|jpeg|png|php)$/i", $file)) {
                                $fileName = pathinfo($file, PATHINFO_FILENAME);
                                if (stripos($fileName, $searchQuery) !== false) {
                                    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                    $relativePath = "/vathana/downloads/$file"; // Adjust this based on your file URL structure
                                    // Calculate file size
                                    $fileSize = filesize("$mainDirectory/$file");
                                    $formattedFileSize = formatBytes($fileSize);
                                    echo "<div class='card'>";
                                    echo "<div class='image-title'>$fileName ($formattedFileSize)</div>";
                                    echo "<img src='/vathana/downloads/$fileName.jpg' alt='$fileName'>"; // Change the default image path
                                    echo "<div class='download-link'><a class='download-btn' href='#' onclick='showModal(\"$fileName\", \"$relativePath\", event)'>Download</a></div>";
                                    echo "</div>";
                                }
                            }
                        }
                        // If no results found for the search query
                        if (empty($imageFiles)) {
                            echo '<div class="no-results-container">';
                            echo '<p class="no-results-message">No results found.</p>';
                            echo '</div>';
                        }
                    } else {
                        // Display all cards in the gallery if no search query provided
                        $files = scandir($mainDirectory);
                        foreach ($files as $file) {
                            // Exclude directories and files with image extensions
                            if (!is_dir("$mainDirectory/$file") && !preg_match("/\.(jpg|jpeg|png|php)$/i", $file)) {
                                $fileName = pathinfo($file, PATHINFO_FILENAME);
                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                $relativePath = "/vathana/downloads/$file"; // Adjust this based on your file URL structure
                                // Calculate file size
                                $fileSize = filesize("$mainDirectory/$file");
                                $formattedFileSize = formatBytes($fileSize);
                                echo "<div class='card'>";
                                echo "<div class='image-title'>$fileName ($formattedFileSize)</div>";
                                echo "<img src='/vathana/downloads/$fileName.jpg' alt='$fileName'>"; // Change the default image path
                                echo "<div class='download-link'><a class='download-btn' href='#' onclick='showModal(\"$fileName\", \"$relativePath\", event)'>Download</a></div>";
                                echo "</div>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- Right Column: Container for Video -->
            <div class="col-lg-4" style="position: relative; overflow-y: auto; max-height: 100vh;">
                <h1 class="video-header" style="position: sticky; top: 0; z-index: 1;">VIDEOS TUTORIAL</h1>
                <div class="video-container">
                    <div id="videoListContainer" class="container-fluid video-list-container">
                        <!-- Video list will be dynamically populated here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to download <span id="fileName"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmDownloadBtn">Download</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright and Address -->
    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> Pacific Computer. All rights reserved.</p>
    </footer>
    <div class="floating-buttons">
        <a href="https://pacificsystems.computer//" target="_blank" class="floating-button">
            <img src="/vathana/downloads/pacific.png" width="30">
        </a>
        <a href="https://www.youtube.com/@pacificcomputer6108/" target="_blank" class="floating-button">
            <img src="https://img.icons8.com/color/48/000000/youtube-play.png" alt="YouTube" width="30">
        </a>
        <a href="https://www.facebook.com/pacificsystems/" target="_blank" class="floating-button">
            <img src="https://img.icons8.com/fluent/48/000000/facebook-new.png" alt="Facebook" width="30">
        </a>
        <a href="https://www.google.com/maps/place/Pacific+Computer/@11.5477111,104.9186694,21z/data=!4m14!1m7!3m6!1s0x31095123b96912af:0x5e05e2bbd59281b5!2sPacific+Computer!8m2!3d11.5478113!4d104.9188484!16s%2Fg%2F12hn9198h!3m5!1s0x31095123b96912af:0x5e05e2bbd59281b5!8m2!3d11.5478113!4d104.9188484!16s%2Fg%2F12hn9198h?entry=ttu" target="Pacific Computer" class="floating-button">
            <img src="https://img.icons8.com/fluent/48/000000/google-maps-new.png" alt="Map" width="30">
        </a>
        <!-- <a class="floating-button" id="scrollTopBtn" onclick="scrollToTop()">
            <img src="https://img.icons8.com/fluent/48/000000/up.png" alt="Scroll to Top" width="30">
        </a> -->
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchForm = document.getElementById('search-form');
            const searchButton = document.getElementById('search-button');

            // Prevent form submission on button click
            searchButton.addEventListener('click', function(event) {
                event.preventDefault();
                performSearch();
            });

            // Function to perform the search
            function performSearch() {
                const searchQuery = document.getElementById('search-bar').value.toLowerCase();
                const cards = document.querySelectorAll('.card');
                cards.forEach(function(card) {
                    const cardName = card.querySelector('.image-title').textContent.toLowerCase();
                    if (cardName.includes(searchQuery)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
        });
    </script>
    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var downloadLink; // Global variable to store download link
        // Function to show modal
        function showModal(fileName, link, e) {
            // Prevent scrolling to the top when the download button is clicked
            e.preventDefault();
            // Prevent scrolling when modal is open
            $('body').css('overflow-y', 'scroll');
            $('#fileName').text(fileName);
            downloadLink = link; // Store download link
            $('#confirmationModal').modal('show');
        }
        // Function to handle download when confirmed
        function downloadFile() {
            window.location.href = downloadLink; // Start the download
            closeModal(); // Close the modal
        }
        // Function to close modal
        function closeModal() {
            // Restore scrolling when modal is closed
            $('body').css('overflow-y', 'auto');
            $('#confirmationModal').modal('hide');
        }
        // Add event listener to the confirm download button
        $('#confirmDownloadBtn').on('click', downloadFile);

        function sortProductCards() {
            var selectBox = document.getElementById("sortOrder");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var cardsContainer = document.querySelector(".gallery");
            var cards = cardsContainer.querySelectorAll(".card");

            // Convert NodeList to Array for easier manipulation
            var cardsArray = Array.prototype.slice.call(cards);

            // Sort cards based on selected value
            if (selectedValue === "asc") {
                cardsArray.sort(function(a, b) {
                    var textA = a.querySelector(".image-title").textContent.trim().toLowerCase();
                    var textB = b.querySelector(".image-title").textContent.trim().toLowerCase();
                    return textA.localeCompare(textB);
                });
            } else if (selectedValue === "desc") {
                cardsArray.sort(function(a, b) {
                    var textA = a.querySelector(".image-title").textContent.trim().toLowerCase();
                    var textB = b.querySelector(".image-title").textContent.trim().toLowerCase();
                    return textB.localeCompare(textA);
                });
            }

            // Append sorted cards back to the container
            cardsArray.forEach(function(card) {
                cardsContainer.appendChild(card);
            });
        }

        // Automatically trigger sorting when the page loads
        sortProductCards();

        // Automatically trigger sorting when the selection changes
        var selectBox = document.getElementById("sortOrder");
        selectBox.addEventListener("change", sortProductCards);
    </script>

    <!-- Your other HTML content here -->

    <script>
        // Function to scroll smoothly to the top of the page
        function scrollToTop() {
            const c = document.documentElement.scrollTop || document.body.scrollTop;
            if (c > 0) {
                window.requestAnimationFrame(scrollToTop);
                window.scrollTo(0, c - c / 8);
            }
        }
    </script>

    <script>
        // Function to scroll smoothly to the top of the page
        function scrollToTop() {
            const c = document.documentElement.scrollTop || document.body.scrollTop;
            if (c > 0) {
                window.requestAnimationFrame(scrollToTop);
                window.scrollTo(0, c - c / 8);
            }
        }

        // Function to check if the page has been scrolled
        function checkScroll() {
            var scrollTopBtn = document.getElementById('scrollTopBtn');
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                scrollTopBtn.style.display = "block";
            } else {
                scrollTopBtn.style.display = "none";
            }
        }

        // Add event listener for scroll event
        window.addEventListener('scroll', checkScroll);
    </script>

    <script>
        // Function to check if user has scrolled to the bottom
        function isBottom() {
            return window.innerHeight + window.scrollY >= document.body.offsetHeight;
        }

        // Function to toggle the visibility of the footer
        function toggleFooter() {
            var footer = document.querySelector('.footer');
            if (isBottom()) {
                footer.style.display = 'block';
            } else {
                footer.style.display = 'none';
            }
        }

        // Add event listener to scroll event
        window.addEventListener('scroll', function() {
            toggleFooter();
        });

        // Initially hide the footer
        toggleFooter();
    </script>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // JavaScript to hide the loading overlay once the page has loaded
        $(window).on('load', function() {
            $('#overlay').fadeOut(1000); // Smooth fade-out animation
        });
    </script>

    <script>
        // Fetch data from the API
        fetch('https://app.pacific.com.kh/ard/api/videos/api/get_videos.php')
            .then(response => response.json())
            .then(data => {
                const videoListContainer = document.getElementById('videoListContainer');
                // Loop through each video object in the data
                data.forEach(video => {
                    // Create a video item container
                    const videoItem = document.createElement('div');
                    videoItem.classList.add('video-item');

                    // Create video element
                    const videoElement = document.createElement('video');
                    videoElement.src = video.url;
                    videoElement.controls = true;
                    videoItem.appendChild(videoElement);

                    // Create a container for title and description
                    const infoContainer = document.createElement('div');
                    infoContainer.classList.add('video-info');

                    // Create video title
                    const videoTitle = document.createElement('div');
                    videoTitle.classList.add('video-title');
                    videoTitle.textContent = video.title;
                    infoContainer.appendChild(videoTitle);

                    // Create video description
                    const videoDescription = document.createElement('div');
                    videoDescription.classList.add('video-description');
                    videoDescription.textContent = video.description;
                    infoContainer.appendChild(videoDescription);

                    // Append the info container to the video item
                    videoItem.appendChild(infoContainer);

                    // Append the video item to the container
                    videoListContainer.appendChild(videoItem);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });



        // Function to toggle collapse state
        function toggleCollapse(id, videoUrl) {
            const video = document.getElementById(id);
            const isCollapsed = video.classList.contains('show');
            $('.collapse').collapse('hide'); // Hide all other collapsed videos
            if (isCollapsed) {
                $('#' + id).collapse('hide'); // Collapse the video if it's currently expanded
            } else {
                $('#' + id).collapse('show'); // Expand the video if it's currently collapsed
            }
            adjustLayout(); // Adjust layout after collapsing or expanding the video
        }

        // Function to pause video when collapse event occurs
        function pauseVideo(id) {
            const video = document.getElementById(id).querySelector('video');
            if (video) {
                video.pause();
            }
        }

        // Function to adjust layout when a video is expanded
        function adjustLayout() {
            const collapsedVideos = document.querySelectorAll('.collapse.show');
            collapsedVideos.forEach(collapsedVideo => {
                collapsedVideo.nextElementSibling.style.marginTop = collapsedVideo.clientHeight + 'px';
            });
        }

        // Add event listener to the collapse events of the videos
        $('.collapse').on('shown.bs.collapse', function() {
            adjustLayout(); // Adjust layout when a video is shown
        });
        $('.collapse').on('hidden.bs.collapse', function() {
            adjustLayout(); // Adjust layout when a video is hidden
        });
    </script>


</body>

</html>